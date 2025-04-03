<?php
require __DIR__.'/database.php';

function login($username, $password) {
    global $db;
    
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username);
    $user = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
    
    if ($user && password_verify($password, $user['password_hash'])) {
        // Régénération de l'ID de session
        session_regenerate_id(true);
        
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'is_admin' => (bool)$user['is_admin'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ];
        
        return true;
    }
    
    // Délai anti-brute force
    sleep(1);
    return false;
}

function check_auth() {
    if (empty($_SESSION['user'])) {
        header('Location: /login.php');
        exit;
    }
    
    // Vérification de l'empreinte de session
    if ($_SESSION['user']['ip'] !== $_SERVER['REMOTE_ADDR'] || 
        $_SESSION['user']['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_destroy();
        header('Location: /login.php');
        exit;
    }
}

function check_admin() {
    check_auth();
    if (!$_SESSION['user']['is_admin']) {
        header('HTTP/1.1 403 Forbidden');
        die('Accès refusé');
    }
}

function generate_csrf_token() {
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_tokens'][$token] = time() + CSRF_TOKEN_EXPIRY;
    return $token;
}

function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_tokens'][$token]) || 
        $_SESSION['csrf_tokens'][$token] < time()) {
        return false;
    }
    unset($_SESSION['csrf_tokens'][$token]);
    return true;
}
?>