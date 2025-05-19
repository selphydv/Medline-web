<?php
// public/logout.php

session_start();        // Assicura che la sessione sia avviata
session_unset();        // Rimuove tutte le variabili di sessione
session_destroy();      // Distrugge la sessione

// Redirect alla pagina di login
header('Location: login.php');
exit;