<?php
session_start();
header('Content-Type: application/json');

// Active l'affichage des erreurs (dev uniquement)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/swipe_controller/swipeApiController.php';

// Vérifie que l'étudiant est connecté
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'etudiant') {
    http_response_code(403);
    echo json_encode(["error" => "Accès refusé : étudiant requis"]);
    exit;
}

try {
    // Envoie l'ID utilisateur et les données de formulaire (POST normal, pas JSON ici)
    SwipeApiController::handleSwipeRequest((int) $_SESSION['userID'], $_POST);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Erreur interne",
        "message" => $e->getMessage()
    ]);
}