<?php
require 'includes/config.php';
$db->exec("DELETE FROM users");
header('Location: admin.php');
?>