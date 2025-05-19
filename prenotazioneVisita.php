<?php
require __DIR__ . '/config.php';
include __DIR__ . '/header.php';
$page_title = 'Prenotazioni - MEDLINE';
if(!isset($_SESSION['user_id'])) redirect('login.php');

?>


  <style>
    body {
      font-family: 'Arial', sans-serif;
    }


    .main-title {
      font-weight: bold;
      margin-top: 30px;
    }

    .form-section {
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 40px 20px;
    }

    .form-container {
      background-color: white;
      padding: 30px;
      border: 2px solid #f6a623;
      border-radius: 8px;
      box-shadow: 8px 8px 0px #f6a623;
      width: 100%;
      max-width: 500px;
    }

    .form-control,
    .form-select {
      margin-bottom: 15px;
      border: 1.5px solid #f6a623;
    }

    .form-icon {
      font-size: 5rem;
      color: #0077b6;
      margin-right: 30px;
    }

    .btn-next {
      background-color: #f6a623;
      color: black;
      font-weight: bold;
      float: right;
      margin: 20px;
      padding: 10px 20px;
    }
</style>
   


  <!-- Testo introduttivo -->
  <div class="container text-center">
    <h2 class="main-title">PRENOTA LA TUA VISITA IN POCHI CLICK!</h2>
    <p>Scegli lo specialista, seleziona la data e l'orario che preferisci e prenota<br>la tua visita in modo semplice e veloce</p>
  </div>

  <!-- Form -->
  <div class="form-section container">
    <div class="d-none d-md-block">
      <img src="https://cdn-icons-png.flaticon.com/512/387/387561.png" alt="Dottore" width="120">
    </div>
    <form class="form-container">
      <label>Tipologia visita:</label>
      <select class="form-select">
        <option selected disabled>Seleziona</option>
        <option>Visita Generale</option>
        <option>Specialistica</option>
      </select>

      <label>Specialista:</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cerca...">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
      </div>

      <label>Modalità visita:</label>
      <select class="form-select">
        <option selected disabled>Seleziona</option>
        <option>a domicilio</option>
        <option>in struttura</option>
      </select>

      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Nome">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Cognome">
        </div>
      </div>

      <input type="email" class="form-control" placeholder="Email">
      <input type="tel" class="form-control" placeholder="Numero di telefono">
      <input type="text" class="form-control" placeholder="Note aggiuntive">

      <label>Data della prenotazione:</label>
      <input type="date" class="form-control">

      <input type="time" class="form-control mt-2" placeholder="Orario della visita">
    </form>
  </div>

  <div class="container">
    <button class="btn btn-next">Avanti ➜</button>
  </div>

 <div style="padding-bottom: 350px"></div>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<?php include __DIR__ . '/footer.php'; ?>