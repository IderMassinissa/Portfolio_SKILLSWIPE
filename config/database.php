<?php
// Définition des constantes pour la connexion à la base de données principale
define('DB_HOST', 'localhost');             // Hôte de la base de données
define('DB_NAME', 'skillswipe');            // Nom de la base principale
define('DB_USER', 'root');                  // Nom d'utilisateur MySQL
define('DB_PASS', '');                      // Mot de passe MySQL
define('DB_MATCHING', 'skillswipe_matching'); // Nom de la base secondaire pour les vecteurs de matching

// Fonction pour établir une connexion à la base de données principale
function getDbConnection()
{
    // Création de la chaîne DSN pour PDO
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';

    // Retourne une nouvelle instance PDO avec options d’erreur et de fetch configurées
    return new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // Affiche les erreurs comme des exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   // Retourne les résultats sous forme de tableau associatif
    ]);
}

// Fonction pour établir une connexion à la base de données de matching
function getMatchingDbConnection()
{
    // Chaîne DSN pour la base skillswipe_matching
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_MATCHING . ';charset=utf8';

    // Retourne une instance PDO pour la base secondaire
    return new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

// Fonction qui établit les deux connexions (principale et matching) et les retourne sous forme de tableau
function connectToDatabases(): array
{
    $pdoMain = getDbConnection();         // Connexion à la base principale
    $pdoVec = getMatchingDbConnection();  // Connexion à la base de vecteurs
    return [$pdoMain, $pdoVec];           // Retourne les deux connexions dans un tableau
}