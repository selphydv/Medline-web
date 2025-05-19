<?php
require __DIR__.'../config.php';
include __DIR__.'../header.php';
$page_title = 'Contatti - MEDLINE';

?>



  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; color: #333; }
    
    main { padding: 2rem; display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; }
    .card { background-color: #FFA500; flex: 1 1 300px; max-width: 400px; padding: 2rem; border-radius: 8px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); align-items: center; }
    .card svg { width: 60px; height: 60px; margin-bottom: 1rem ;  }
    .card h2 { margin-bottom: 0.5rem; }
    .card p { margin-bottom: 1.5rem; line-height: 1.4; }
    .card .btn { display: inline-block; padding: 0.5rem 1.5rem; border: 2px solid #333; border-radius: 4px; text-decoration: none; font-weight: bold; }
    
  </style>


  <main>
    <div class="card">
      <!-- Icona email -->
     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
    </svg>
      <h2>Inviaci una mail</h2>
      <p>Per qualsiasi richiesta di assistenza o chiarimento, è possibile contattarci tramite email. Il nostro team è a disposizione per offrire il supporto necessario.</p>
      <p><strong>medline@gmail.com</strong></p>
    </div>

    <div class="card">
      <!-- Icona chat -->
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
  <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
    </svg>
      <h2>Livechat con operatore</h2>
      <p>Per qualsiasi richiesta di assistenza o chiarimento, è possibile utilizzare la live chat. Il nostro team sarà disponibile per offrire il supporto necessario in tempo reale.</p>
      <a href="#" class="btn">CHAT</a>
    </div>
  </main>

   

<!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


  <?php include __DIR__.'../footer.php'; ?>