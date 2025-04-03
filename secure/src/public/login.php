<?php
require __DIR__.'/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'])) {
        die('Token CSRF invalide');
    }
    
    if (login($_POST['username'], $_POST['password'])) {
        header('Location: /');
        exit;
    }
    $error = "Identifiants incorrects";
}

require __DIR__.'/../templates/header.php';
?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
    
    <label>Nom d'utilisateur:
        <input type="text" name="username" required>
    </label>
    
    <label>Mot de passe:
        <input type="password" name="password" required minlength="8">
    </label>
    
    <button type="submit">Se connecter</button>
    
    <?php if (isset($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
</form>

<?php require __DIR__.'/../templates/footer.php'; ?>