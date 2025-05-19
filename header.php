<?php // includes/header.php ?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?=htmlspecialchars($page_title ?? 'Medline')?></title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Navbar Styles (copiati da home.html) -->
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .topbar {
      background-color: #f6a623;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
    }
    .topbar .logo {
      display: flex;
      align-items: center;
    }
    .topbar .logo img {
      height: 40px;
      margin-right: 10px;
    }
    .topbar .logo .title {
      font-weight: bold;
      font-size: 1rem;
      color: black;
      line-height: 1;
    }
    .topbar .logo .subtitle {
      font-size: 0.7rem;
      color: black;
      line-height: 1;
    }
    .topbar nav a {
      margin-left: 20px;
      text-decoration: none;
      color: black;
      font-weight: bold;
      font-size: 0.95rem;
    }

  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Topbar / Navbar -->
   <header class="topbar">
    <div class="logo">
      <img src="immagini\logo.png" alt="Logo">
      <div>
        <span class="title">MEDLINE</span>
        <span class="subtitle">healthcare services on click</span>
      </div>
    </div>
    <nav>
     <a href="../Medline/home.php">Home</a>
      <a href="../Medline/chisiamo.php">Chi siamo</a>
      <a href="../Medline/contatti.php">Contatti</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="../Medline/dashboard.php">Dashboard</a>
        <a href="../Medline/logout.php">Logout</a>
      <?php else: ?>
        <a href="../Medline/login.php">Login</a>
        <a href="../Medline/registrati.php">Registrati</a>
      <?php endif; ?>
    </nav>
  </header>



