<?php
require __DIR__.'../config.php';
include __DIR__.'../header.php';
$page_title = 'Spedizioni - MEDLINE';

?>


  <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    /* Header */
    
    /* Section spacing */
    .section { padding: 2rem 0; }
    /* Title Section */
    .title-section h1 { font-size: 3rem; font-weight: bold; text-transform: uppercase; }
    /* Intro & Icon */
    .intro-icon i { font-size: 4rem; color: #D61F29; }
    /* Process Section */
    .process-section { background-color: #FFA500; color: #fff; padding: 2rem; }
    .process-section ol { padding-left: 1.2rem; }
    /* Details Section */
    .details-section { padding: 2rem 0; }
    .details-section .separator { width: 4px; background-color: #FFA500; margin: 0 1rem; }
    .details-section h5 { font-weight: bold; }
    
  </style>


  <!-- Title Section -->
  <section class="section container title-section">
    <div class="row align-items-center">
      <div class="text-center">
        <h1>Come avvengono le spedizioni?</h1>
      </div>
    </div>
  </section>

  <!-- Intro & Icon -->
  <section class="section container intro-icon">
    <div class="row align-items-center">
      <div class="col-md-8">
        <p>Grazie per la fiducia nei nostri prodotti! Per garantire una consegna sicura e puntuale, abbiamo ottimizzato ogni fase del processo di spedizione. Ecco come gestiamo i tuoi ordini, passo dopo passo.</p>
      </div>
      <div class="col-md-4 text-center">
        <i class="bi bi-truck"></i>
      </div>
    </div>
  </section>

  <!-- Process Section -->
  <section class="process-section container">
    <div class="row align-items-center">
      <div class="col-md-4">
        <img src="https://www.sendabox.it/Images/shipping-pages/international.jpg" alt="Preparazione pacco" class="img-fluid">
      </div>
      <div class="col-md-8">
        <p>Appena riceviamo il tuo ordine, il nostro team inizia il processo di preparazione:</p>
        <ol>
          <li><strong>Conferma dell'Ordine:</strong> Verifichiamo che il pagamento sia andato a buon fine.</li>
          <li><strong>Imballaggio:</strong> Utilizziamo materiali sicuri ed ecologici per proteggere i tuoi prodotti durante il trasporto.</li>
          <li><strong>Etichettatura:</strong> Ogni pacco viene etichettato con un codice di tracciamento unico.</li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Details Section -->
  <section class="details-section container d-flex justify-content-between">
    <div class="col-md-5">
      <h5>Monitoraggio</h5>
      <p>Quando il tuo ordine lascia il nostro magazzino, ti invieremo un'email di notifica con il link per monitorarne lo stato. Puoi vedere:</p>
      <ul>
        <li>Data di partenza</li>
        <li>Posizione attuale</li>
        <li>Data stimata di consegna</li>
      </ul>
    </div>
    <div class="separator d-none d-md-block"></div>
    <div class="col-md-5">
      <h5>Problematiche e Soluzioni</h5>
      <p>Se riscontri problemi con la spedizione, ti invitiamo a contattarci immediatamente. Offriamo assistenza per:</p>
      <ul>
        <li>Ordini smarriti</li>
        <li>Prodotti danneggiati durante il trasporto</li>
        <li>Ritardi imprevisti</li>
      </ul>
    </div>
  </section>

  <div style="padding-bottom: 350px"></div>
  

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  
<?php include __DIR__.'../footer.php'; ?>