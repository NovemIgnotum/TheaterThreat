<?php
// Ne plus inclure config.php ici
// Les fichiers qui ont besoin des fonctions DOIVENT inclure config.php d'abord

function get_dvds($filter = '') {
    global $db, $secure_mode;
    
    if ($secure_mode) {
        $stmt = $db->prepare("SELECT * FROM dvds WHERE available = 1 AND title LIKE :filter");
        $stmt->bindValue(':filter', "%$filter%");
        return $stmt->execute();
    } else {
        return $db->query("SELECT * FROM dvds WHERE title LIKE '%$filter%'");
    }
}
?>