<?php
require __DIR__.'/../../includes/auth.php';
check_admin();

// Logique admin sécurisée
$stmt = $db->prepare("SELECT id, username, created_at FROM users");
$users = $stmt->execute();
?>

<?php require __DIR__.'/../../templates/header.php'; ?>

<h1>Panel Admin</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Date création</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($user = $users->fetchArray(SQLITE3_ASSOC)): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= htmlspecialchars($user['created_at']) ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php require __DIR__.'/../../templates/footer.php'; ?>