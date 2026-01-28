<?php
// Fichier: logout.php

require_once 'config.php';


session_unset();
session_destroy();

setcookie('session_token', '', time() - 3600, '/');

header('Location: index.html');
exit;
?>