<?php
session_start();

// Chemin de la base de données
$db_path = __DIR__.'/../database/db.sqlite';

// Créer le dossier si inexistant
if (!file_exists(dirname($db_path))) {
    mkdir(dirname($db_path), 0775, true);
}

try {
    $db = new SQLite3($db_path);
    $db->enableExceptions(true); // Pour mieux voir les erreurs
    
    // Suppression des commentaires dans les requêtes SQL
    $db->exec("PRAGMA foreign_keys = OFF");
    
    // Création des tables (sans commentaires)
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY,
        username TEXT,
        password TEXT,
        is_admin BOOLEAN
    )");
    
    $db->exec("CREATE TABLE IF NOT EXISTS dvds (
        id INTEGER PRIMARY KEY,
        title TEXT,
        year INTEGER,
        director TEXT,
        available BOOLEAN DEFAULT 1
    )");
    
    // Insertion des données (colonnes explicites)
    $db->exec("INSERT OR IGNORE INTO users (id, username, password, is_admin) 
              VALUES (1, 'admin', 'admin123', 1)");
    
    $db->exec("INSERT OR IGNORE INTO users (id, username, password, is_admin) 
              VALUES (2, 'user1', 'password123', 0)");
    
    $db->exec("INSERT OR IGNORE INTO dvds (id, title, year, director, available) 
              VALUES (1, 'Inception', 2010, 'Christopher Nolan', 1)");
    
    $db->exec("INSERT OR IGNORE INTO dvds (id, title, year, director, available) 
              VALUES (2, 'The Matrix', 1999, 'Lana Wachowski', 0)");

} catch (Exception $e) {
    die("<h1>Erreur Base de Données</h1><pre>".$e->getMessage()."</pre>");
}
?>