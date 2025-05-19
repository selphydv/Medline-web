<?php
require __DIR__.'../config.php';
include __DIR__.'../header.php';
$page_title = 'Login - MEDLINE';


// Array per eventuali messaggi di errore

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // 1. Leggi dal form
$nome        = $_POST['nome'];
$cognome     = $_POST['cognome'];
$email       = $_POST['email'];
$password    = $_POST['password'];
$telefono    = $_POST['telefono'];
$dataNascita = $_POST['dataNascita'];
$cf          = $_POST['cf'];
$indirizzo   = $_POST['indirizzo'];
$citta       = $_POST['citta'];
$cap         = $_POST['cap'];
$provincia   = $_POST['provincia'];

// 2. Ottieni o crea la Città
$stmt = $mysqli->prepare(
  "SELECT IDCitta 
     FROM Citta 
    WHERE Nome = ? AND CAP = ?"
);
$stmt->bind_param('ss', $citta, $cap);
$stmt->execute();
$stmt->bind_result($codCitta);

if (!$stmt->fetch()) {
  // non esiste → inserisci
  $stmt->close();
  $stmt = $mysqli->prepare(
    "INSERT INTO Citta (Nome, CAP) VALUES (?, ?)"
  );
  $stmt->bind_param('ss', $citta, $cap);
  $stmt->execute();
  $codCitta = $mysqli->insert_id;
}
$stmt->close();

// 3. Ottieni o crea la Provincia
$stmt = $mysqli->prepare(
  "SELECT IDProvincia 
     FROM Province 
    WHERE Nome = ? AND CODCitta = ?"
);
$stmt->bind_param('si', $provincia, $codCitta);
$stmt->execute();
$stmt->bind_result($codProvincia);

if (!$stmt->fetch()) {
  $stmt->close();
  $stmt = $mysqli->prepare(
    "INSERT INTO Province (Nome, CODCitta) VALUES (?, ?)"
  );
  $stmt->bind_param('si', $provincia, $codCitta);
  $stmt->execute();
  $codProvincia = $mysqli->insert_id;
}
$stmt->close();

// 4. Hash della password
$pwHash = hash('sha256', $password);

// 5. Inserisci l’utente
$stmt = $mysqli->prepare("
  INSERT INTO Utenti 
    (Nome, Cognome, Email, Password, Telefono, DataNascita, CF, Abbonato, Indirizzo, CODProvince)
  VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?, ?)
");
$stmt->bind_param(
  'ssssssssi',
  $nome,
  $cognome,
  $email,
  $pwHash,
  $telefono,
  $dataNascita,
  $cf,
  $indirizzo,
  $codProvincia
);


    if ($stmt->execute()) {
        header('Location: login.php?registered=1');
    } else {
        echo 'Errore inserimento utente: ' . htmlspecialchars($stmt->error);
    } 
  
  }



?>

 
  <style>
    body { font-family: Arial, sans-serif; color: #333; background-color: #777; }
   
    /* Signup Card */
    .signup-wrapper { position: relative; max-width: 500px; margin: 4rem auto; }
    .offset-card {
      position: absolute;
      top: 20px;
      left: 20px;
      width: 100%;
      height: 100%;
      background-color: #FFA500;
      border-radius: 8px;
      z-index: 1;
    }
    .signup-card {
      position: relative;
      z-index: 2;
      padding: 2rem;
      border-radius: 8px;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .signup-card h2 { color: #FFA500; margin-bottom: 0.25rem; }
    .signup-card p.subtitle { margin-bottom: 1.5rem; color: #666; }
    .signup-card .form-control {
      border: 1px solid #FFA500;
    }
    .signup-card .form-check-label a { text-decoration: underline; }
    .signup-card .btn-register {
      background-color: #FFA500;
      border: none;
    }
   
  </style>


  <!-- Sign Up Form -->
  <div class="signup-wrapper">
    <div class="offset-card"></div>
    <div class="signup-card">
      <h2 class="text-center">Sign Up</h2>
      <p class="subtitle text-center">Registra un account</p>
      <form method="POST">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="visually-hidden" for="nome">Nome</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
            </div>
          </div>
          <div class="col-md-6">
            <label class="visually-hidden" for="cognome">Cognome</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <input type="text" class="form-control" id="cognome" name="cognome" placeholder="Cognome" required>
            </div>
          </div>
          <div class="col-12">
            <label class="visually-hidden" for="email">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-envelope"></i></span>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
          </div>
          <div class="col-12">
            <label class="visually-hidden" for="password">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
          </div>
          <div class="col-12">
            <label class="visually-hidden" for="telefono">Telefono</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-telephone"></i></span>
              <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
            </div>
          </div>
          <div class="col-md-6">
            <label class="visually-hidden" for="dataNascita">Data di Nascita</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-calendar"></i></span>
              <input type="date" class="form-control" id="dataNascita" name="dataNascita" placeholder="Data di Nascita">
            </div>
          </div>
          <div class="col-md-6">
            <label class="visually-hidden" for="cf">Codice Fiscale</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
              <input type="text" class="form-control" id="cf" name="cf" placeholder="CF">
            </div>
          </div>
          <div class="col-12">
            <label class="visually-hidden" for="indirizzo">Indirizzo</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
              <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="Indirizzo">
            </div>
          </div>
          <div class="col-12">
            <label class="visually-hidden" for="provincia">Provincia</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
              <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia">
            </div>
          </div>
          <div class="col-12">
            <label class="visually-hidden" for="citta">Citta</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
              <input type="text" class="form-control" id="citta" name="citta" placeholder="Citta">
            </div>
          </div>
          <div class="col-12">
            <label class="visually-hidden" for="CAP">CAP</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
              <input type="text" class="form-control" id="CAP" name="cap" placeholder="CAP">
            </div>
          </div>
          <div class="col-12 form-check">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label" for="terms">Accetto i <a href="#">Termini e Condizioni</a></label>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-register w-100">Registrati</button>
          </div>
          <div class="col-12 text-center">
            <small>Hai già un account? <a href="#">Accedi</a></small>
          </div>
        </div>
      </form>
    </div>
  </div>

  <di style="padding-bottom:300px"></div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <?php include __DIR__.'../footer.php'; ?>
