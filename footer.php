<?php // includes/footer.php ?> 

<!-- Custom Footer Styles (copiati da home.html) -->
<style>

body
{
  position: relative;
}

 .footer {
      background-color: #222;
      color: white;
      padding: 40px 20px;
      position: absolute;
      bottom: 0;
      
      width: 100%;
      left: 0;
    }

    .footer h6 {
      font-weight: bold;
    }

    .footer a {
      color: white;
      text-decoration: none;
      display: block;
      margin: 5px 0;
    }

    .copyright {
      text-align: center;
      margin-top: 20px;
      font-size: 0.9rem;
    }
</style>

<footer class="footer mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <img src="immagini\logo.png" alt="Logo" width="50">
        <p><strong>MEDLINE</strong><br>healthcare services on click</p>
      </div>
      <div class="col-md-4">
        <h6>Link Utili</h6>
        <a href="../Medline/home.php">Home</a>
        <a href="../Medline/chisiamo.php">Chi siamo</a>
        <a href="../Medline/contatti.php">Contattaci</a>
      </div>
      <div class="col-md-4">
        <h6>Informazioni ed Ordini</h6>
        <a href="../Medline/faq.php">FAQ</a>
        <a href="../Medline/spedizioni.php">Spedizione</a>
        <a href="../Medline/tracciamento.php">Tracciamento</a>
      </div>
    </div>
    <div class="copyright mt-4">
      &copy; 2025
    </div>
  </div>
</footer>

 <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


</body>
</html>
