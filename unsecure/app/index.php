<?php
require 'includes/config.php';

// Injection SQL fonctionnelle
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM dvds WHERE title LIKE '%$search%'";
$dvds = $db->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>TheaterThreat - Mode Vulnérable</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .vuln-area { background: #ffeeee; padding: 15px; }
    </style>
</head>
<body>
    <h1>DVDs Disponibles</h1>
    
    <div class="vuln-area">
        <form method="get">
            <input type="text" name="search" placeholder="Essayez : ' OR 1=1--">
            <button>Rechercher</button>
        </form>
        
        <?php while($dvd = $dvds->fetchArray()): ?>
            <div>
                <strong><?= $dvd['title'] ?></strong> (<?= $dvd['year'] ?>)
                <?= $_GET['xss'] ?? '' ?> <!-- Zone XSS -->
            </div>
        <?php endwhile; ?>
    </div>
    
    <div style="margin-top: 30px; color: red;">
        <h3>Attaques possibles :</h3>
        <ul>
            <li><code>?search=' UNION SELECT id,username,password,1,1 FROM users--</code></li>
            <li><code>?xss=&lt;script&gt;alert(1)&lt;/script&gt;</code></li>
        </ul>
    </div>
</body>
</html>