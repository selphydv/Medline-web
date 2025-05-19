<?php

require __DIR__ . '/config.php';
include __DIR__ . '/header.php';
$page_title = 'Login - MEDLINE';
?>

<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-Cu2BNbVFLb2aIR3Ypwl1fLRpXkMNVp5Y0N2U5P0xtsM="
  crossorigin=""
/>
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .hero-image {
    width: 100%;
    max-height: 350px;
    object-fit: cover;
  }
  .hero-text {
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin: 30px 0;
  }
  .section-btn {
    background-color: #f6a623;
    border: none;
    padding: 10px 20px;
    color: white;
    font-weight: bold;
  }
  /* Mappa incorporata con Google Maps */
  .map-iframe {
    width: 100%;
    max-width: 350px;       /* Larghezza massima */
    aspect-ratio: 4 / 3;    /* Proporzioni 4:3 */
    border-radius: 8px;
    margin: 0 auto 1rem;
    border: 0;
  }
  /* Layout modifica colonna destra */
  .col-visita {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  /* Immagine visita con le stesse dimensioni della mappa */
  .visita-img {
    width: 100%;
    max-width: 350px;        /* Stessa larghezza massima */
    aspect-ratio: 4 / 3;     /* Stessa proporzione */
    object-fit: cover;       /* Ritaglia eventualmente */
    margin-bottom: 1rem;
    border-radius: 8px;
  }
</style>

<!-- Hero Text -->
<div class="container text-center my-4">
  <p class="hero-text">
    LA TUA SALUTE, OVUNQUE TU SIA:<br>
    FARMACI E SERVIZI SANITARI A DOMICILIO IN MODO RAPIDO E AFFIDABILE
  </p>
</div>

<!-- Service Section with interactive map and visita -->
<div class="container text-center mb-5">
  <div class="row g-4 justify-content-center">
    <!-- Colonna mappa -->
    <div class="col-md-6 d-flex flex-column align-items-center">
      <iframe
        class="map-iframe"
        src="https://maps.google.com/maps?q=41.9,12.5&z=6&output=embed"
        allowfullscreen
        loading="lazy">
      </iframe>
      <a href="../Medline/ordinazioneMed.php">
        <button class="section-btn">ORDINA LA TUA MEDICINA</button>
      </a>
    </div>
    <!-- Colonna visita -->
    <div class="col-md-6 col-visita">
      <img
        src="immagini/visita.avif"
        class="img-fluid visita-img"
        alt="Visita">
      <a href="../Medline/prenotazioneVisita.php">
        <button class="section-btn">PRENOTA LA TUA VISITA</button>
      </a>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include __DIR__ . '/footer.php'; ?>
