<?php

require_once 'config.php';
require_once 'Database.php';

function checkAuth($requiredUserType = null) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: connexion.html');
        exit;
    }
    
    if ($requiredUserType && $_SESSION['user_type'] !== $requiredUserType) {
        header('Location: ' . DASHBOARDS[$_SESSION['user_type']]);
        exit;
    }
    
    return true;
}

function getUserInfo() {
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'],
        'fullname' => $_SESSION['fullname'],
        'email' => $_SESSION['email'],
        'user_type' => $_SESSION['user_type']
    ];
}
?>