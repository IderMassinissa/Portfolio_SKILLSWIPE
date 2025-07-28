<?php
session_start();
header("Content-Type: application/json");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifie que c'est bien un recruteur connecté
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'recruteur') {
    http_response_code(403);
    echo json_encode(["error" => "Accès refusé : recruteur requis"]);
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/swipe_controller/exploreUserController.php';

try {
    $recruiterId = (int) $_SESSION['userID'];
    $filters = json_decode(file_get_contents("php://input"), true) ?? [];

    $cleanFilters = [
        'localisation' => isset($filters['localisation']) ? trim($filters['localisation']) : '',
        'skills' => isset($filters['skills']) && is_array($filters['skills']) ? $filters['skills'] : []
    ];

    $result = ExploreUserController::getFilteredUsers($recruiterId, $cleanFilters);
    echo json_encode($result);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Erreur interne",
        "message" => $e->getMessage()
    ]);
}