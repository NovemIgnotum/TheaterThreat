<?php
require 'includes/config.php';

// Aucune vérification d'authentification !
$users = $db->query("SELECT * FROM users");
?>

<h1>Panel Admin</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password (en clair)</th>
    </tr>
    <?php while ($user = $users->fetchArray()): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['username'] ?></td>
        <td style="color:red"><?= $user['password'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- Vulnérabilité CSRF -->
<form action="delete_all.php" method="post">
    <button>⚠️ Supprimer tous les utilisateurs</button>
</form>