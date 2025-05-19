<?php
require __DIR__.'../config.php';
include __DIR__.'../header.php';
$page_title = 'Chi siamo - MEDLINE';

?>
  
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }


    /* HERO */
    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: linear-gradient(to right, #87cefa, #2323f8);
      padding: 0 20px;
    }
    .hero h1 {
      font-size: 2.5rem;
      margin-left: 100px;
      font-weight: bold;
      color: black;
    }
    .hero .hero-img {
      max-width: 300px;
      width: 100%;
      height: 200px;
    }

    /* TEAM ROW */
    .team-row {
      background-color: #f6a623;
      padding: 20px 0;
      display: flex;
      justify-content: center;
      gap: 30px;
    }
    .team-member {
      text-align: center;
      width: 100px;
    }
    .team-member .circle {
      width: 100px;
      height: 100px;
      background-color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 10px;
    }
    .team-member .circle i {
      font-size: 3rem;
      color: black;
    }
    .team-member .name {
      font-weight: bold;
      font-size: 0.9rem;
      color: black;
    }
    .team-member .surname {
      font-size: 0.9rem;
      color: black;
    }

    /* MAIN CONTENT */
    .content {
      padding: 40px 20px;
      max-width: 1000px;
      margin: 0 auto;
    }
    .content .row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 100px;
    }
    .content .col-8 {
      flex: 0 0 65%;
    }

    .content p
    {
        font-size: 18px;
        padding-top: 8px;
        line-height: 30px;

    }

    .content .col-4 {
      flex: 0 0 30%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .content img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }

   
    @media (max-width: 768px) {
      .hero { flex-direction: column; text-align: center; }
      .hero h1 { margin-bottom: 20px; }
      .content .row { flex-direction: column; }
      .content .col-8, .content .col-4 { flex: 1 0 100%; }
      .team-row { flex-wrap: wrap; }
    }
  </style>



  <!-- HERO -->
  <section class="hero">
    <h1>CHI SIAMO?</h1>
    <img class="hero-img" src="https://storage.googleapis.com/a1aa/image/0a63a4d0-9aa5-442b-41be-273d78e8890d.jpg"
         alt="Doctor con icona famiglia">
  </section>

  <!-- TEAM ROW -->
  <section class="team-row">
    <div class="team-member">
      <div class="circle"><i class="fas fa-user"></i></div>
      <div class="name">Mastrangelo</div>
      <div class="surname">Pierpaolo</div>
    </div>
    <div class="team-member">
      <div class="circle"><i class="fas fa-user"></i></div>
      <div class="name">Cavone</div>
      <div class="surname">Nicola</div>
    </div>
    <div class="team-member">
      <div class="circle"><i class="fas fa-user"></i></div>
      <div class="name">Lobuono</div>
      <div class="surname">Gabriele</div>
    </div>
    <div class="team-member">
      <div class="circle"><i class="fas fa-user"></i></div>
      <div class="name">Cutrignelli</div>
      <div class="surname">Davide</div>
    </div>
    <div class="team-member">
      <div class="circle"><i class="fas fa-user"></i></div>
      <div class="name">Cataldo</div>
      <div class="surname">Luigi</div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <div class="content">
    <div class="row">
      <div class="col-8">
        <p>Immaginati di avere bisogno di un farmaco urgentemente, ma non puoi uscire di casa. O magari sei una persona anziana che preferisce ricevere le medicine comodamente a casa tua. Ecco dove entriamo in gioco noi!</p>
        <p>La nostra missione è semplificare la vita delle persone, rendendo l'accesso ai farmaci rapido, facile e sicuro. Con la nostra piattaforma innovativa, puoi ordinare tutti i tuoi medicinali con pochi click e riceverli direttamente a domicilio, nella fascia oraria che preferisci.</p>
      </div>
      <div class="col-4">
        <img src="https://storage.googleapis.com/a1aa/image/1139401e-6a9b-4ef2-0f3e-95e0bac8dd17.jpg"
             alt="Dottore con mascherina e medicina">
      </div>
    </div>

    <div class="row">
      <div class="col-4">
        <img src="immagini/sanita.jpg"
             alt="Icone mediche combinate">
      </div>
      <div class="col-8">
        <p>Il nostro team è composto da professionisti appassionati del loro lavoro, che mettono al primo posto la tua salute e il tuo benessere. Farmacisti esperti, sviluppatori software all'avanguardia e un team di customer care sempre disponibile: siamo un gruppo affiatato e determinato a offrirti il miglior servizio possibile.</p>
        <p>La nostra storia inizia dal 2024, quando ci siamo resi conto dell'esigenza crescente di servizi sanitari a domicilio. Da allora, non abbiamo mai smesso di innovare e migliorare, per offrirti un'esperienza sempre più personalizzata e soddisfacente.</p>
        <p>Unisciti alla nostra community e scopri come possiamo semplificare la tua vita!</p>
      </div>
    </div>
  </div>

  <div style="padding-bottom:250px;"></div>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">




<?php include __DIR__.'../footer.php'; ?>