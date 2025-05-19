<?php
require __DIR__ . '/config.php';
include __DIR__ . '/header.php';
$page_title = 'FAQ - MEDLINE';

?>
  <!-- Bootstrap Icons -->
  
  <style>
    body { font-family: Arial, sans-serif; color: #333; }
    /* Hero Section */
    .hero {
      background: url('https://images.unsplash.com/photo-1587502536263-3debaedc81e1?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
      color: white;
      text-align: center;
      padding: 6rem 1rem;
      position: relative;
    }
    .hero::after {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(0,0,0,0.5);
      z-index: 0;
    }
    .hero .container {
      position: relative;
      z-index: 1;
    }
    .hero h1 { font-size: 2.5rem; margin-bottom: 1.5rem; }
    .hero .input-group { max-width: 600px; margin: 0 auto; }

    /* FAQ Section */
    .faq-section { padding: 3rem 1rem; }
    .faq-section h5 { font-weight: bold; }
    .faq-section p { color: #555; }

    
    
   
    
  </style>

  

  <!-- Hero -->
  <section class="hero">
    <div class="container">
      <h1>Come possiamo aiutarti?</h1>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Scrivi qui la tua domanda">
        <button class="btn btn-light"><i class="bi bi-search"></i></button>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq-section">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6">
          <h5>Come posso ordinare i medicinali a domicilio?</h5>
          <p>Puoi effettuare l'ordine attraverso il nostro sito web, l'app dedicata o chiamando il numero del nostro servizio clienti.</p>
        </div>
        <div class="col-md-6">
          <h5>Il servizio è disponibile anche di notte e nei giorni festivi?</h5>
          <p>Sì, offriamo assistenza 24 ore su 24, 7 giorni su 7, inclusi i festivi.</p>
        </div>
        <div class="col-md-6">
          <h5>Serve la ricetta medica per ordinare un farmaco?</h5>
          <p>Sì, per i farmaci che lo richiedono, dovrai caricare la ricetta medica sul nostro portale o mostrarla al momento della consegna.</p>
        </div>
        <div class="col-md-6">
          <h5>Posso richiedere una visita o una consegna per un’altra persona?</h5>
          <p>Sì, è possibile ordinare medicinali o prenotare visite per familiari o amici, con il loro consenso.</p>
        </div>
        <div class="col-md-6">
          <h5>In quanto tempo verranno consegnati i medicinali?</h5>
          <p>La consegna standard avviene entro 2 ore dall'ordine, ma offriamo anche un servizio express per consegne urgenti.</p>
        </div>
        <div class="col-md-6">
          <h5>Quanto costa la consegna a domicilio dei medicinali?</h5>
          <p>Il costo della consegna varia in base alla distanza, ma offriamo spesso promozioni o sconti per ordini superiori a un certo importo.</p>
        </div>
      </div>
    </div>
  </section>

 
<div style="padding-bottom: 300px"></div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include __DIR__ . '/footer.php'; ?>