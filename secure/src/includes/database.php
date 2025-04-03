<?php
require __DIR__.'/config.php';

class SecureDB extends SQLite3 {
    public function __construct() {
        parent::__construct(DB_PATH);
        $this->enableExceptions(true);
        $this->exec("PRAGMA foreign_keys = ON");
    }

    public function querySecure($sql, $params = []) {
        $stmt = $this->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        return $stmt->execute();
    }
}

// Initialisation sécurisée
try {
    $db = new SecureDB();
    
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password_hash TEXT NOT NULL,
        is_admin BOOLEAN DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Hachage des mots de passe avec bcrypt
    $hashed_admin = password_hash('AdminSecure123!', PASSWORD_BCRYPT);
    $db->exec("INSERT OR IGNORE INTO users (username, password_hash, is_admin) 
              VALUES ('admin', '$hashed_admin', 1)");
    
} catch (Exception $e) {
    error_log("Database error: ".$e->getMessage());
    die("Maintenance en cours. Veuillez réessayer plus tard.");
}
?>