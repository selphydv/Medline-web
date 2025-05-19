<?php
require __DIR__ . '/config.php';
if(!isset($_SESSION['user_id'])) redirect('login.php');

$page_title = 'Tracciamento - MEDLINE';
include __DIR__ . '/header.php';
?>

<!-- Page-specific Styles -->
<style>
  .tracking-title {
    margin: 40px 0 20px;
    font-size: 1.8rem;
    font-weight: bold;
  }
  .tracking-id {
    margin-bottom: 20px;
    color: #555;
  }
  .tracking-card {
    background-color: #e0e0e0;
    border-radius: 12px;
    padding: 30px;
    max-width: 800px;
    margin: 0 auto 60px;
  }
  .tracking-details {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: 20px;
  }
  .tracking-details .item {
    flex: 1 1 30%;
    margin-bottom: 10px;
  }
  .tracking-details .item span.label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  /* Progress bar */
  .progressbar {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    position: relative;
    justify-content: space-between;
  }
  .progressbar li {
    flex: 1;
    position: relative;
    text-align: center;
    font-size: 0.9rem;
    color: #777;
        transition: color 0.3s ease;

  }
  .progressbar li:before {
    content: '';
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #ccc;
    display: block;
    margin: 0 auto 10px;
    z-index: 1;
    position: relative;
     transition: background-color 0.3s ease, transform 0.3s ease;
  }
  .progressbar li:after {
    content: '';
    position: absolute;
    width: 100%;
    height: 4px;
    background-color: #ccc;
    top: 10px;
    left: -50%;
    z-index: 0;
    transition: background-color 0.3s ease, width 0.3s ease;
  }
  .progressbar li:first-child:after {
    content: none;
  }
  .progressbar li.completed:before,
  .progressbar li.current:before {
    background-color: #FFA500;
    transform: scale(1.2);
  }
  .progressbar li.completed + li:after {
    background-color: #FFA500;
  }
  .progressbar li.completed {
    color: #000;
  }
  .progressbar li.current {
    color: #000;
    font-weight: bold;
  }

  .progressbar.finished li:before,
  .progressbar.finished li.completed:before,
  .progressbar.finished li.current:before {
    background-color: #28a745 !important;
    transform: scale(1.2);
  }
  .progressbar.finished li.completed + li:after {
    background-color: #28a745 !important;
    width: 100%;
  }
  .progressbar.finished li.completed,
  .progressbar.finished li.current {
    color: #28a745 !important;
  }
</style>

<main class="container">
  <div class="tracking-title">Traccia il tuo ordine:</div>
  <div class="tracking-id">Order ID: <strong>OD345872349</strong></div>

  <div class="tracking-card">
    <div class="tracking-details">
      <div class="item">
        <span class="label">Estimated Delivery time:</span>
        <span>15/01/25</span>
      </div>
      <div class="item">
        <span class="label">Status:</span>
        <span>Picked by the courier</span>
      </div>
      <div class="item">
        <span class="label">Tracking:</span>
        <span>BD093745349</span>
      </div>
    </div>

    <ul class="progressbar">
      <li class="completed">Order confirmed</li>
      <li class="current">Picked by courier</li>
      <li>On the way</li>
      <li>Ready for pickup</li>
    </ul>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const steps = Array.from(document.querySelectorAll('.progressbar li'));
  const statuses = steps.map(li => li.textContent.trim());
  let currentIndex = 0;
  const progressBar = document.querySelector('.progressbar');

  function updateStatusDetail() {
    const statusEl = document.querySelector('.tracking-details .item:nth-child(2) span:last-child');
    statusEl.textContent = statuses[currentIndex];
  }

  function initProgress() {
    steps.forEach((li, idx) => {
      li.classList.remove('completed','current');
      if (idx === currentIndex) li.classList.add('current');
    });
    updateStatusDetail();
  }

  function advanceStep() {
    if (currentIndex < steps.length - 1) {
      steps[currentIndex].classList.remove('current');
      steps[currentIndex].classList.add('completed');
      currentIndex++;
      steps[currentIndex].classList.add('current');
      updateStatusDetail();
      // Se è l'ultimo step, attiva lo stato finished
      if (currentIndex === steps.length - 1) {
        progressBar.classList.add('finished');
      }
    }
  }

  initProgress();
  setInterval(advanceStep, 10000);
});
</script>

</script>
<?php include __DIR__ . '/footer.php'; ?>