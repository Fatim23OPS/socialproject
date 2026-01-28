<?php
require_once 'config.php';

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";charset=utf8mb4",
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to MySQL successfully.\n";
    
    
    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
    if ($stmt->fetch()) {
        echo "Database '" . DB_NAME . "' exists.\n";
        
        $pdo->exec("USE " . DB_NAME);
        
        // List tables
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        echo "Tables: " . implode(", ", $tables) . "\n";
        
        if (in_array('users', $tables)) {
            echo "Users table exists.\n";
            $columns = $pdo->query("DESCRIBE users")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($columns as $col) {
                echo "Column: " . $col['Field'] . " (" . $col['Type'] . ")\n";
            }
        } else {
            echo "Users table MISSING.\n";
        }
        
    } else {
        echo "Database '" . DB_NAME . "' does NOT exist.\n";
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
?>
