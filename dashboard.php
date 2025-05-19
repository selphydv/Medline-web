<?php
// public/cart.php
require __DIR__.'../config.php';
if(!isset($_SESSION['user_id'])) redirect('login.php');
$page_title = 'Carrello - MEDLINE';
include __DIR__.'../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['qty'])) {
    header('Content-Type: application/json; charset=UTF-8');

    $id  = intval($_POST['id']);
    $qty = intval($_POST['qty']);

    if ($id <= 0) {
        echo json_encode(['success'=>false,'msg'=>'ID invalido']);
        exit;
    }
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if ($qty <= 0) {
        unset($_SESSION['cart'][$id]);
    } else {
        $_SESSION['cart'][$id] = $qty;
    }

    // ricalcola totali
    $prices = [1=>39.99,2=>15.99,3=>29.99];
    $totalQty = 0; $payable = 0;
    foreach ($_SESSION['cart'] as $mid=>$q) {
        $totalQty += $q;
        $payable  += ($prices[$mid] ?? 0) * $q;
    }
    $shipping   = ($totalQty>0 && ($payable+5.99)<=80) ? 5.99 : 0;
    $orderTotal = $payable + $shipping;

    echo json_encode([
      'success'    => true,
      'totalQty'   => $totalQty,
      'payable'    => number_format($payable,2,',','').'€',
      'shipping'   => number_format($shipping,2,',','').'€',
      'orderTotal' => number_format($orderTotal,2,',','').'€'
    ]);
    exit;
}

// --- 2) GET: prepara i dati per il rendering iniziale ---
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$meds_info = [
    1 => ['name'=>'Tachipirina', 'price'=>39.99, 'img'=>'/img/tachipirina.jpg'],
    2 => ['name'=>'Moment Act',  'price'=>15.99, 'img'=>'/img/momentact.jpg'],
    3 => ['name'=>'Xanax',       'price'=>29.99, 'img'=>'/img/xanax.jpg'],
];

// Calcola totali iniziali
$prices    = [1=>39.99,2=>15.99,3=>29.99];
$totalQty  = 0; $payable = 0;
foreach ($_SESSION['cart'] as $mid=>$q) {
    $totalQty += $q;
    $payable  += ($prices[$mid] ?? 0) * $q;
}
$shipping   = ($totalQty>0 && ($payable+5.99)<=80) ? 5.99 : 0;
$orderTotal = $payable + $shipping;


?>
<style>
  .cart-container { margin:40px auto; max-width:1100px; display:flex;flex-direction:column;align-items:center }
  .cart-table{width:100%;border-collapse:collapse;margin-bottom:30px}
  .cart-table th,.cart-table td{padding:12px 8px;text-align:left;vertical-align:middle}
  .cart-table th{font-weight:bold;border-bottom:2px solid #ccc}
  .cart-table td img{max-width:80px;margin-right:8px;vertical-align:middle}
  .quantity-control{display:flex;align-items:center}
  .quantity-control button{border:none;background:#ddd;padding:4px 10px;cursor:pointer;font-size:1rem}
  .quantity-control input{width:40px;text-align:center;border:1px solid #ccc;margin:0 5px;border-radius:4px}
  .order-summary{background:#fff;padding:20px;box-shadow:0 4px 6px rgba(0,0,0,0.1);max-width:350px}
  .order-summary h4{margin-bottom:15px;border-bottom:2px solid #000;padding-bottom:5px;text-align:center}
  .order-summary .line-item{display:flex;justify-content:space-between;margin:10px 0}
  .order-summary .total{font-weight:bold;font-size:1.1rem}
  .order-summary button{display:block;width:100%;background:#FFA500;border:none;padding:10px 0;margin:15px 0;cursor:pointer;font-weight:bold}
  .order-summary .payments img{max-height:30px;margin-right:8px}
</style>

<div class="cart-container">
  <h2 id="cart-title">Shopping Cart (<?= $totalQty ?>)</h2>
  <table class="cart-table">
    <thead>
      <tr><th>Product</th><th>Amount</th><th>Quantity</th></tr>
    </thead>
    <tbody>
      <?php foreach($_SESSION['cart'] as $medId=>$qty):
        if(!isset($meds_info[$medId])) continue;
        $info = $meds_info[$medId];
        $lineTotal = $info['price'] * $qty;
      ?>
      <tr data-id="<?= $medId ?>">
        <td>
          <img src="<?= htmlspecialchars($info['img']) ?>" alt="<?= htmlspecialchars($info['name']) ?>">
          <?= htmlspecialchars($info['name']) ?>
        </td>
        <td><?= number_format($lineTotal,2,',','') ?>€</td>
        <td>
          <div class="quantity-control">
            <button class="qty-minus">−</button>
            <input type="text" value="<?= $qty ?>">
            <button class="qty-plus">+</button>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="order-summary">
    <h4>Order Summary</h4>
    <div class="line-item"><span>Payable Amount</span><span id="sum-payable"><?= number_format($payable,2,',','') ?>€</span></div>
    <div class="line-item"><span>Shipping</span><span id="sum-shipping"><?= number_format($shipping,2,',','') ?>€</span></div>
    <hr>
    <div class="line-item total"><span>Order Total</span><span id="sum-total"><?= number_format($orderTotal,2,',','') ?>€</span></div>
    <button type="button">Proceed To Checkout</button>
    <div class="payments text-center">
      <img src="immagini/visa.png" alt="Visa">
      <img src="immagini/mastercard.png" alt="MasterCard">
      <img src="immagini/paypal.png" alt="PayPal">
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const ENDPOINT    = 'dashboard.php';  // stesso file
  const tableBody   = document.querySelector('.cart-table tbody');
  const getRows     = () => Array.from(tableBody.querySelectorAll('tr'));
  const cartTitle   = document.getElementById('cart-title');
  const summaryLines = document.querySelectorAll('.order-summary .line-item');
  const payableEl   = summaryLines[0].querySelector('span:last-child');
  const shippingEl  = summaryLines[1].querySelector('span:last-child');
  const totalEl     = summaryLines[2].querySelector('span:last-child');
  const SHIPPING_COST = 5.99;

  function toEuro(val) {
    return val.toFixed(2).replace('.',',') + '€';
  }

  function calculateTotals() {
    let totalQty = 0, payable = 0;
    getRows().forEach(row => {
      const qty = parseInt(row.querySelector('input').value) || 0;
      totalQty += qty;
      const amt = parseFloat(
        row.children[1].textContent.replace('€','').replace(',','.')
      ) || 0;
      payable += amt;
    });

    const shipping   = (totalQty > 0 && (payable + SHIPPING_COST) <= 80)
                       ? SHIPPING_COST : 0;
    const orderTotal = payable + shipping;

    cartTitle.textContent   = `Shopping Cart (${totalQty})`;
    payableEl.textContent   = toEuro(payable);
    shippingEl.textContent  = toEuro(shipping);
    totalEl.textContent     = toEuro(orderTotal);
  }

  function syncSession(id, qty) {
    fetch(ENDPOINT, {
      method: 'POST',
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      body: `id=${id}&qty=${qty}`
    })
    .then(res => res.json())
    .then(data => {
      // i totali sono già stati calcolati in calculateTotals(),
      // qui potremmo scegliere di ricalcolare dal server se vogliamo:
      // cartTitle.textContent = `Shopping Cart (${data.totalQty})`;
      // payableEl.textContent = data.payable;
      // shippingEl.textContent = data.shipping;
      // totalEl.textContent = data.orderTotal;
    })
    .catch(console.error);
  }

  function attachControls(row) {
    const amountCell = row.children[1];
    const unitPrice  = parseFloat(amountCell.textContent.replace('€','').replace(',','.')) || 0;
    const input      = row.querySelector('.quantity-control input');
    const btnMinus   = row.querySelector('.quantity-control button:first-child');
    const btnPlus    = row.querySelector('.quantity-control button:last-child');
    const id         = row.dataset.id;

    function updateRow() {
      let qty = parseInt(input.value) || 0;
      if (qty <= 0) {
        row.remove();
        calculateTotals();
        syncSession(id, 0);
        return;
      }
      input.value = qty;
      amountCell.textContent = toEuro(unitPrice * qty);
      calculateTotals();
      syncSession(id, qty);
    }

    btnMinus.addEventListener('click', () => {
      input.value = parseInt(input.value) - 1;
      updateRow();
    });
    btnPlus.addEventListener('click', () => {
      input.value = parseInt(input.value) + 1;
      updateRow();
    });
    input.addEventListener('change', updateRow);
  }

  // inizializza
  getRows().forEach(attachControls);
  calculateTotals();
});
</script>


<div style="padding-bottom:300px;"></div>



<?php include __DIR__.'../footer.php'; ?>

