<?php
// Désactiver l'affichage des erreurs en production
error_reporting(0);
ini_set('display_errors', 0);

// Configuration de la session
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => true,
    'cookie_samesite' => 'Strict'
]);

// Constantes de sécurité
define('DB_PATH', __DIR__.'/../data/db.sqlite');
define('CSRF_TOKEN_EXPIRY', 3600); // 1 heure
?>