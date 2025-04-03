<?php
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '' ?>">
    <title>TheaterThreat Sécurisé</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" href="data:,"> <!-- Protection contre les favicons malveillants -->
</head>
<body>
    <header>
        <nav>
            <a href="/">Accueil</a>
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['is_admin']): ?>
                    <a href="/admin/">Admin</a>
                <?php endif; ?>
                <a href="/logout.php">Déconnexion</a>
            <?php else: ?>
                <a href="/login.php">Connexion</a>
            <?php endif; ?>
        </nav>
    </header>
    <main class="container">