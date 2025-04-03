<?php
require __DIR__.'/../includes/auth.php';
require __DIR__.'/../includes/database.php';

check_auth();

// Requête sécurisée
$stmt = $db->prepare("SELECT * FROM dvds WHERE available = 1");
$dvds = $stmt->execute();

require __DIR__.'/../templates/header.php';
?>

<h1>DVDs Disponibles</h1>

<div class="secure-content">
    <?php while ($dvd = $dvds->fetchArray(SQLITE3_ASSOC)): ?>
        <div class="dvd-card">
            <h3><?= htmlspecialchars($dvd['title']) ?></h3>
            <p>Année: <?= htmlspecialchars($dvd['year']) ?></p>
            <p>Réalisateur: <?= htmlspecialchars($dvd['director']) ?></p>
        </div>
    <?php endwhile; ?>
</div>

<?php require __DIR__.'/../templates/footer.php'; ?>