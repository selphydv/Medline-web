<?php
// includes/config.php
session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'Medline');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

function redirect($url) {
    header("Location: $url");
    exit;
}
function flash($msg) {
    $_SESSION['flash'][] = $msg;
}
function show_flash() {
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $m) {
            echo "<div class='alert alert-info'>".htmlspecialchars($m)."</div>";
        }
        unset($_SESSION['flash']);
    }
}
