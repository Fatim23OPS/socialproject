<?php
// Fichier: User.php

require_once 'config.php';
require_once 'Database.php';

class User {
    private $db;
    private $conn;
    
    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }
    
    // Vérifier si l'email existe déjà
    public function emailExists($email) {
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    
    // Créer un nouvel utilisateur
    public function create($fullname, $email, $password, $userType) {
        // Validation
        if (empty($fullname) || empty($email) || empty($password) || empty($userType)) {
            return ['success' => false, 'message' => 'Tous les champs sont obligatoires'];
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email invalide'];
        }
        
        if (strlen($password) < PASSWORD_MIN_LENGTH) {
            return ['success' => false, 'message' => 'Le mot de passe doit contenir au moins ' . PASSWORD_MIN_LENGTH . ' caractères'];
        }
        
        if (!in_array($userType, ['student', 'mentor', 'volunteer', 'orphan'])) {
            return ['success' => false, 'message' => 'Type d\'utilisateur invalide'];
        }
        
        // Vérifier si l'email existe
        if ($this->emailExists($email)) {
            return ['success' => false, 'message' => 'Cet email est déjà utilisé'];
        }
        
        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Insérer dans la base de données
        $query = "INSERT INTO users (fullname, email, password, user_type) VALUES (:fullname, :email, :password, :user_type)";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':user_type', $userType);
            
            if ($stmt->execute()) {
                $userId = $this->conn->lastInsertId();
                return [
                    'success' => true, 
                    'message' => 'Inscription réussie',
                    'user_id' => $userId,
                    'user_type' => $userType
                ];
            }
        } catch(PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de l\'inscription: ' . $e->getMessage()];
        }
        
        return ['success' => false, 'message' => 'Erreur inconnue'];
    }
    
    // Connexion utilisateur
    public function login($email, $password) {
        $query = "SELECT id, fullname, email, password, user_type FROM users WHERE email = :email";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch();
                
                if (password_verify($password, $user['password'])) {
                    return [
                        'success' => true,
                        'user_id' => $user['id'],
                        'fullname' => $user['fullname'],
                        'email' => $user['email'],
                        'user_type' => $user['user_type']
                    ];
                }
            }
        } catch(PDOException $e) {
            return ['success' => false, 'message' => 'Erreur de connexion: ' . $e->getMessage()];
        }
        
        return ['success' => false, 'message' => 'Email ou mot de passe incorrect'];
    }
    
    // Créer une session
    public function createSession($userId) {
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', time() + SESSION_DURATION);
        
        $query = "INSERT INTO user_sessions (user_id, session_token, expires_at) VALUES (:user_id, :token, :expires_at)";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expires_at', $expiresAt);
            $stmt->execute();
            
            return $token;
        } catch(PDOException $e) {
            return false;
        }
    }
}
?>
