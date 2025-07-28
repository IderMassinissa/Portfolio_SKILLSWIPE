<?php
session_start();
header("Content-Type: application/json");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifie que l'utilisateur est bien un recruteur
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'recruteur') {
    http_response_code(403);
    echo json_encode(["error" => "Accès refusé"]);
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/swipe_controller/swipeUserController.php';

// Récupère les données JSON
$filters = json_decode(file_get_contents("php://input"), true) ?? [];

$recruiterId = (int) $_SESSION['userID'];

try {
    $cleanFilters = [
        'localisation' => isset($filters['localisation']) ? trim($filters['localisation']) : '',
        'skills' => isset($filters['skills']) && is_array($filters['skills']) ? $filters['skills'] : []
    ];

    // Connexion aux deux BDD (main + vecteurs)
    [$pdoMain, $pdoVec] = connectToDatabases();

    // Appel du contrôleur avec les deux connexions
    $result = SwipeUserController::getFilteredUsers($pdoMain, $pdoVec, $recruiterId, $cleanFilters['localisation'], $cleanFilters['skills']);
    echo json_encode($result);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Erreur interne",
        "message" => $e->getMessage()
    ]);
}