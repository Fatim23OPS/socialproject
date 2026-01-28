<?php
require_once 'config.php';
require_once 'auth_check.php';

header('Content-Type: application/json');

$user = getUserInfo();

if ($user) {
    echo json_encode([
        'logged_in' => true, 
        'user' => $user,
        'dashboard' => DASHBOARDS[$user['user_type']] ?? '#'
    ]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>
