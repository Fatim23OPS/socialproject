<!-- 6. Script de connexion -->
<?php
// Fichier: login.php

require_once 'config.php';
require_once 'User.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Email et mot de passe requis'
        ]);
        exit;
    }
    
    $user = new User();
    $result = $user->login($email, $password);
    
    if ($result['success']) {
        // Créer la session
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['user_type'] = $result['user_type'];
        $_SESSION['fullname'] = $result['fullname'];
        $_SESSION['email'] = $result['email'];
        
        // Créer le token de session
        $sessionToken = $user->createSession($result['user_id']);
        
        if ($sessionToken) {
            setcookie('session_token', $sessionToken, time() + SESSION_DURATION, '/', '', false, true);
        }
        
        // Déterminer la page de redirection
        $redirectUrl = DASHBOARDS[$result['user_type']];
        
        echo json_encode([
            'success' => true,
            'message' => 'Connexion réussie !',
            'redirect' => $redirectUrl
        ]);
    } else {
        echo json_encode($result);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée'
    ]);
}
?>
