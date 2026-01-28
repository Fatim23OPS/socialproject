<?php
require_once 'config.php';
require_once 'Database.php';

echo "--- DIAGNOSTIC DE LA BASE DE DONNÉES ---\n";

try {
    $db = (new Database())->getConnection();
    echo "[OK] Connexion DB réussie.\n";
    
    // 1. Structure de la table users
    echo "\n1. Structure de la table 'users':\n";
    $stmt = $db->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($columns as $col) {
        echo " - " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }

    // 2. Liste des utilisateurs
    echo "\n2. Utilisateurs existants:\n";
    $stmt = $db->query("SELECT id, fullname, email, user_type FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($users) > 0) {
        foreach ($users as $u) {
            echo " - ID: {$u['id']} | Nom: {$u['fullname']} | Email: {$u['email']} | Rôle: {$u['user_type']}\n";
        }
    } else {
        echo "[ATTENTION] Aucun utilisateur trouvé ! Le script de seeding n'a pas fonctionné.\n";
    }

} catch (Exception $e) {
    echo "[ERREUR CRITIQUE] " . $e->getMessage() . "\n";
}
?>
