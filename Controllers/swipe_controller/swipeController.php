<?php
// Inclusion du modèle MatchModel pour gérer les actions like/dislike et les éventuels matchs
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/swipe_model/MatchModel.php';
// Inclusion du modèle SwipeModel pour récupérer les offres correspondantes à un utilisateur
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/swipe_model/swipeModel.php';

// Définition de la classe SwipeController qui gère les requêtes liées au swipe et aux matchs
class SwipeController
{
    // Méthode statique pour traiter une action de swipe (like ou dislike)
    public static function handleMatch($pdoMain)
    {
        // Récupère les données JSON envoyées dans la requête
        $input = json_decode(file_get_contents("php://input"), true);

        // Vérifie si l'utilisateur est connecté et si les paramètres nécessaires sont présents
        if (!isset($_SESSION['userID']) || !isset($input['offer_id'], $input['action'])) {
            http_response_code(400); // Code HTTP 400 : mauvaise requête
            echo json_encode(["error" => "Paramètres manquants ou utilisateur non connecté"]);
            exit;
        }

        // Récupère les données de la requête
        $userId = intval($_SESSION['userID']);   // ID utilisateur
        $offerId = intval($input['offer_id']);   // ID de l'offre concernée
        $action = $input['action'];              // Action : 'like' ou 'dislike'

        // Appelle la méthode processAction du modèle MatchModel
        $result = MatchModel::processAction($pdoMain, $userId, $offerId, $action);
        // Retourne le résultat au format JSON
        echo json_encode($result);
    }

    // Méthode statique pour gérer une requête de récupération d'offres à swiper
    public static function handleSwipeRequest($userId, $filters)
    {
        // Vérifie que l'ID est valide et les filtres bien fournis
        if (!$userId || !is_array($filters)) {
            http_response_code(400);
            echo json_encode(["error" => "Données invalides"]);
            return;
        }

        // Appelle la méthode getMatchingOffers du modèle SwipeModel
        $offers = SwipeModel::getMatchingOffers($userId, $filters);
        // Spécifie que la réponse sera en JSON
        header('Content-Type: application/json');
        // Envoie les offres récupérées
        echo json_encode($offers);
    }
}