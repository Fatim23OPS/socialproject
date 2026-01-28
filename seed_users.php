<?php
require_once 'config.php';
require_once 'User.php';

$user = new User();

$accounts = [
    [
        'fullname' => 'Eleve Test',
        'email' => 'student@test.com',
        'password' => '12345678',
        'type' => 'student'
    ],
    [
        'fullname' => 'Mentor Test',
        'email' => 'mentor@test.com',
        'password' => '12345678',
        'type' => 'mentor'
    ],
    [
        'fullname' => 'Benevole Test',
        'email' => 'volunteer@test.com',
        'password' => '12345678',
        'type' => 'volunteer'
    ],
    [
        'fullname' => 'Orphelin Test',
        'email' => 'orphan@test.com',
        'password' => '12345678',
        'type' => 'orphan'
    ]
];

echo "Creation des comptes de test...\n";

foreach ($accounts as $acc) {
    // Check if user exists
    $db = (new Database())->getConnection();
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$acc['email']]);
    
    if ($stmt->rowCount() == 0) {
        $result = $user->create($acc['fullname'], $acc['email'], $acc['password'], $acc['type']);
        if ($result['success']) {
            echo "[OK] Cree: {$acc['type']} ({$acc['email']}) - Pass: {$acc['password']}\n";
        } else {
            echo "[ERREUR] Echec pour {$acc['type']}: " . $result['message'] . "\n";
        }
    } else {
        echo "[INFO] Existe deja: {$acc['type']} ({$acc['email']})\n";
    }
}

echo "\nTermine ! Vous pouvez vous connecter avec ces comptes.";
?>
