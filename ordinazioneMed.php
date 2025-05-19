<?php
// public/ordinazioneMed.php
require __DIR__ . '/config.php';
$page_title = 'Ordinazioni - MEDLINE';
include __DIR__ . '/header.php';

// Protezione: solo utenti loggati
if (!isset($_SESSION['user_id'])) {
    redirect('login.php');
}




// 1) Assicura voci in Medicinali
$mysqli->query("
  INSERT IGNORE INTO Medicinali (IDMedicinale, Nome, Prezzo, Scadenza) VALUES
    (1, 'Tachipirina',  3.50, '2026-12-31'),
    (2, 'Moment Act',   4.20, '2026-12-31'),
    (3, 'Xanax',        8.75, '2027-06-30')
");

// 2) Assicura Visa e MasterCard in Pagamenti
$mysqli->query("
  INSERT IGNORE INTO Pagamenti (IDPagamento, Metodo) VALUES
    (1, 'Visa'),
    (2, 'MasterCard')
");

// 3) Recupera medicinali da DB
$meds = [];
$res = $mysqli->query("SELECT IDMedicinale, Nome FROM Medicinali");
while ($row = $res->fetch_assoc()) {
    $meds[(int)$row['IDMedicinale']] = [
        'name'       => $row['Nome'],
        'requires_rx'=> ($row['Nome'] === 'Xanax')
    ];
}

// 4) Recupera metodi di pagamento
$payments = [];
$res = $mysqli->query("SELECT IDPagamento, Metodo FROM Pagamenti WHERE IDPagamento IN (1,2)");
while ($row = $res->fetch_assoc()) {
    $payments[(int)$row['IDPagamento']] = $row['Metodo'];
}

// 5) Inizializza carrello in sessione
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$errors       = [];
$selected     = null;
$codPagamento = null;
$quantity     = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // A) Raccogli dati dal form
    $selected     = intval($_POST['medicinale']  ?? 0);
    $quantity     = max(1, intval($_POST['quantity'] ?? 1));
    $indirizzo    = trim($_POST['indirizzo']     ?? '');
    $citta        = trim($_POST['citta']         ?? '');
    $provincia    = trim($_POST['provincia']     ?? '');
    $cap          = trim($_POST['cap']           ?? '');
    $telefono     = trim($_POST['telefono']      ?? '');
    $priorita     = ($_POST['consegna'] ?? '0') === '1' ? 1 : 0;
    $codPagamento = intval($_POST['pagamento']   ?? 0);

    // B) Validazioni
    if (!isset($meds[$selected])) {
        $errors[] = 'Seleziona un medicinale valido.';
    }
    if (!isset($payments[$codPagamento])) {
        $errors[] = 'Seleziona un metodo di pagamento valido.';
    }
    if (!$indirizzo || !$citta || !$provincia || !$cap || !$telefono) {
        $errors[] = 'Compila tutti i campi di indirizzo, città, provincia, CAP e telefono.';
    }
    if (empty($errors) && $meds[$selected]['requires_rx']) {
        if (!isset($_FILES['ricetta']) || $_FILES['ricetta']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Prescrizione obbligatoria per questo medicinale.';
        }
    }

    if (empty($errors)) {
        // C) Gestione Città
        $stmt = $mysqli->prepare("SELECT IDCitta FROM Citta WHERE Nome=? AND CAP=?");
        $stmt->bind_param('ss', $citta, $cap);
        $stmt->execute();
        $stmt->bind_result($codCitta);
        if (!$stmt->fetch()) {
            $stmt->close();
            $stmt = $mysqli->prepare("INSERT INTO Citta (Nome, CAP) VALUES (?,?)");
            $stmt->bind_param('ss', $citta, $cap);
            $stmt->execute();
            $codCitta = $mysqli->insert_id;
        }
        $stmt->close();

        // D) Gestione Provincia
        $stmt = $mysqli->prepare("SELECT IDProvincia FROM Province WHERE Nome=? AND CODCitta=?");
        $stmt->bind_param('si', $provincia, $codCitta);
        $stmt->execute();
        $stmt->bind_result($codProvincia);
        if (!$stmt->fetch()) {
            $stmt->close();
            $stmt = $mysqli->prepare("INSERT INTO Province (Nome, CODCitta) VALUES (?,?)");
            $stmt->bind_param('si', $provincia, $codCitta);
            $stmt->execute();
            $codProvincia = $mysqli->insert_id;
        }
        $stmt->close();

        // E) Inserimento Ordine (+ dettaglio)
        if ($meds[$selected]['requires_rx']) {
            // carica prescrizione
            $ext  = pathinfo($_FILES['ricetta']['name'], PATHINFO_EXTENSION);
            $dest = __DIR__ . '../ricette/' . uniqid() . ".$ext";
            move_uploaded_file($_FILES['ricetta']['tmp_name'], $dest);

            // Prescrizione
            $stmt = $mysqli->prepare(
              "INSERT INTO Prescrizioni (Data, File, CODUtenti)
               VALUES (NOW(),?,?)"
            );
            $stmt->bind_param('si', $dest, $_SESSION['user_id']);
            $stmt->execute();
            $codPrescrizione = $mysqli->insert_id;
            $stmt->close();

            // OrdiniP
            $stmt = $mysqli->prepare(
              "INSERT INTO OrdiniP
                (Data, Indirizzo, CODProvince, Telefono, Priorita, Stato, CODPrescrizioni, CODPagamento)
               VALUES (NOW(),?,?,?,?, 'in preparazione',?,?)"
            );
            $stmt->bind_param(
              'sisiii',
              $indirizzo,
              $codProvincia,
              $telefono,
              $priorita,
              $codPrescrizione,
              $codPagamento
            );
            $stmt->execute();
            $orderId = $mysqli->insert_id;
            $stmt->close();

            // Dettaglio OrdiniP
            $stmt = $mysqli->prepare(
              "INSERT INTO OrdiniPMedicinali (IDOrdineP, IDMedicinale, Quantita)
               VALUES (?,?,?)"
            );
            $stmt->bind_param('iii', $orderId, $selected, $quantity);
            $stmt->execute();
            $stmt->close();

        } else {
            // Ordini
            $stmt = $mysqli->prepare(
              "INSERT INTO Ordini
                (Data, Indirizzo, CODProvince, Telefono, Priorita, Stato, CODUtenti, CODPagamento)
               VALUES (NOW(),?,?,?,?, 'in preparazione',?,?)"
            );
            $stmt->bind_param(
              'sisiii',
              $indirizzo,
              $codProvincia,
              $telefono,
              $priorita,
              $_SESSION['user_id'],
              $codPagamento
            );
            $stmt->execute();
            $orderId = $mysqli->insert_id;
            $stmt->close();

            // Dettaglio Ordini
            $stmt = $mysqli->prepare(
              "INSERT INTO OrdiniMedicinali (IDOrdine, IDMedicinale, Quantita)
               VALUES (?,?,?)"
            );
            $stmt->bind_param('iii', $orderId, $selected, $quantity);
            $stmt->execute();
            $stmt->close();
        }

        // F) Aggiorna carrello in sessione
        $_SESSION['cart'][$selected] = ($_SESSION['cart'][$selected] ?? 0) + $quantity;

        header('Location: dashboard.php');
        exit;
    }
}
?>

<style>
  .form-section { background: #f9f9f9; padding: 40px 20px; }
  .form-box     { background: #e5e5e5; padding: 30px; border-radius: 10px; }
  .btn-warning  { background: #fbbf24; border: none; color: white; }
  .btn-warning:hover { background: #f59e0b; }
  .payment-icons img { height: 30px; margin-right: 10px; }
</style>

<div class="form-section">
  <div class="container text-center">
    <h2 class="fw-bold mb-3">ORDINA I TUOI MEDICINALI IN POCHI PASSI</h2>
  </div>
  <div class="container mt-5">
    <div class="row justify-content-center"><div class="col-lg-8">
      <div class="form-box">
        <?php if ($errors): ?>
          <div class="alert alert-danger"><ul class="mb-0">
            <?php foreach ($errors as $e): ?>
              <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
          </ul></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
          <div class="mb-3" id="rx-field" style="display:none;">
            <label class="fw-bold">Prescrizione (solo Xanax):</label>
            <input type="file" name="ricetta" class="form-control">
          </div>

          <div class="mb-3">
            <label class="fw-bold">Medicinale:</label>
            <select name="medicinale" id="medicinale" class="form-select" required>
              <option value="">Seleziona...</option>
              <?php foreach ($meds as $id => $m): ?>
                <option value="<?= $id ?>" <?= $selected === $id ? 'selected' : '' ?>>
                  <?= htmlspecialchars($m['name']) ?><?= $m['requires_rx']?' (Rx)':'' ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Quantità:</label>
            <input type="number" name="quantity" class="form-control" value="<?= $quantity ?>" min="1" required>
          </div>

          <div class="mb-3">
            <input type="text" name="indirizzo" class="form-control" placeholder="Indirizzo" required>
          </div>
          <div class="row g-3 mb-3">
            <div class="col-md-6"><input type="text" name="citta"     class="form-control" placeholder="Città"     required></div>
            <div class="col-md-6"><input type="text" name="provincia" class="form-control" placeholder="Provincia" required></div>
          </div>
          <div class="row g-3 mb-3">
            <div class="col-md-6"><input type="text" name="cap"      class="form-control" placeholder="CAP"      required></div>
            <div class="col-md-6"><input type="text" name="telefono" class="form-control" placeholder="Telefono" required></div>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Pagamento:</label>
            <select name="pagamento" class="form-select" required>
              <option value="">Seleziona...</option>
              <?php foreach ($payments as $pid => $method): ?>
                <option value="<?= $pid ?>" <?= $codPagamento === $pid ? 'selected':'' ?>>
                  <?= htmlspecialchars($method) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-check"><input type="radio" name="consegna" value="1" class="form-check-input"> Consegna con priorità</label><br>
            <label class="form-check"><input type="radio" name="consegna" value="0" class="form-check-input" checked> Consegna standard</label>
          </div>

          <div class="payment-icons mb-3">
            <img src="immagini/visa.png" alt="Visa">
            <img src="immagini/mastercard.png" alt="MasterCard">
            <img src="immagini/paypal.png" alt="PayPal">
          </div>

          <button type="submit" class="btn btn-warning w-100">Invia Ordine</button>
        </form>
      </div>
    </div></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// mostra/nasconde prescrizione solo per Xanax (ID=3)
const medSel = document.getElementById('medicinale'),
      rxDiv  = document.getElementById('rx-field');
medSel.addEventListener('change', ()=> rxDiv.style.display = medSel.value==='3' ? 'block':'none');
window.addEventListener('DOMContentLoaded', ()=> rxDiv.style.display = medSel.value==='3' ? 'block':'none');
</script>

<div style="padding-bottom: 350px;"></div>

<?php include __DIR__ . '/footer.php'; ?>
