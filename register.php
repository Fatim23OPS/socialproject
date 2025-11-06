<!-- 5. Script de traitement de l'inscription -->
<?php
// Fichier: register.php

require_once 'config.php';
require_once 'User.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $userType = $_POST['user_type'] ?? '';
    
    // Vérifier que les mots de passe correspondent
    if ($password !== $confirmPassword) {
        echo json_encode([
            'success' => false,
            'message' => 'Les mots de passe ne correspondent pas'
        ]);
        exit;
    }
    
    // Créer l'utilisateur
    $user = new User();
    $result = $user->create($fullname, $email, $password, $userType);
    
    if ($result['success']) {
        // Créer la session
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['user_type'] = $result['user_type'];
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        
        // Créer le token de session
        $sessionToken = $user->createSession($result['user_id']);
        
        if ($sessionToken) {
            setcookie('session_token', $sessionToken, time() + SESSION_DURATION, '/', '', false, true);
        }
        
        // Déterminer la page de redirection
        $redirectUrl = DASHBOARDS[$result['user_type']];
        
        echo json_encode([
            'success' => true,
            'message' => 'Inscription réussie !',
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
