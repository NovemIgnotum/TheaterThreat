<?php
require_once __DIR__.'includes/config.php';
$_SESSION['secure_mode'] = !$secure_mode;
header('Location: index.php');
?>