<?php
require __DIR__ . '/config.php';
include __DIR__ . '/header.php';
$page_title = 'Login - MEDLINE';


// 2) Connessione e setup

// 3) Prepariamo eventuali errori e il redirect di default
$redirect = 'home.php';

// 4) Se arriva il POST, tentiamo il login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preleva email e password
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';

    // Cerchiamo l’utente in DB
    $stmt = $mysqli->prepare("
        SELECT IDUtente, Password
          FROM Utenti
         WHERE Email = ?
    ");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($userId, $pwHashFromDb);

    if ($stmt->fetch()) {
        // Confrontiamo l’hash sha256
        if (hash('sha256', $password) === $pwHashFromDb) {
            // Login riuscito
            $_SESSION['user_id'] = $userId;
            header("Location: $redirect");
            exit;
        } else {
            $errors[] = 'Password errata.';
        }
    } else {
        $errors[] = 'Email non registrata.';
    }
    $stmt->close();
}
?>




  <style>
    body { font-family: Arial, sans-serif; color: #333; background-color: #777; }
    
    /* Login Card */
    .login-wrapper { position: relative; max-width: 550px; margin: 4rem auto; }
    .offset-card { position: absolute; top: 20px; left: 20px; width: 100%; height: 100%; background-color: #FFA500; border-radius: 8px; z-index: 1; }
    .login-card { position: relative;  z-index: 2; padding: 2rem;  width: 450px; border-radius: 8px; background-color: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .login-card h2 { color: #FFA500; margin-bottom: 0.25rem; text-align: center; }
    .login-card p.subtitle { margin-bottom: 1.5rem; color: #666; text-align: center; }
    .login-card .form-control { border: 1px solid #FFA500; }
    .login-card .btn-login { background-color: #FFA500; border: none; }
    .login-card .btn-register { border: 2px solid #FFA500; color: #FFA500; background-color: transparent; }
    .login-card .forgot-link { display: block; text-align: center; margin-top: 0.5rem; color: #666; text-decoration: none; }
    
  </style>



  <!-- Login Form -->
   <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  <div class="login-wrapper">
    <div class="offset-card"></div>
    <div class="login-card">
      <h2>Login</h2>
      <p class="subtitle">Entra nel tuo account</p>
      <form method="POST">
        <div class="mb-3">
          <label class="visually-hidden" for="username">Username</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" class="form-control" id="username" name="email" placeholder="Email" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="visually-hidden" for="password">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          </div>
        </div>
        <button type="submit" class="btn btn-login w-100 mb-2">Login</button>
        <a href="#" class="forgot-link">Ho dimenticato la mia password</a>
        <button type="button" class="btn btn-register w-100 mt-3">Registrati</button>
      </form>
    </div>
  </div>

 

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include __DIR__ . '/footer.php'; ?>
