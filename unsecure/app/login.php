<?php
require 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Authentification vulnérable
    $query = "SELECT * FROM users WHERE username='".$_POST['username']."' 
              AND password='".$_POST['password']."'";
    $user = $db->querySingle($query, true);
    
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php?login=success');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Vulnérable</title>
    <style>
        body { max-width: 500px; margin: 50px auto; }
        form { border: 2px solid red; padding: 20px; }
    </style>
</head>
<body>
    <form method="post">
        <h2>Connexion (vulnérable)</h2>
        <input type="text" name="username" placeholder="admin'--" required>
        <input type="password" name="password" placeholder="n'importe quoi">
        <button>Se connecter</button>
    </form>
    
    <div style="margin-top: 20px; background: #fff3f3; padding: 15px;">
        <h3>Comment exploiter :</h3>
        <p>Utilisez <code>admin'--</code> comme nom d'utilisateur</p>
        <p>Laissez le mot de passe vide</p>
    </div>
</body>
</html>