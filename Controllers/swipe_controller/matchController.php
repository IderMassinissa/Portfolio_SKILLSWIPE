<?php
// Inclusion du fichier de configuration de la base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
// Inclusion du modèle MatchModel utilisé pour les opérations de matching
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/swipe_model/matchModel.php';

// Définition de la classe MatchController responsable du traitement des likes/dislikes
class MatchController
{
    public function handle()
    {
        session_start(); // Démarrage de la session pour accéder à l'ID utilisateur
        header("Content-Type: application/json"); // Spécifie que la réponse sera en JSON

        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['userID'])) {
            http_response_code(403); // Code HTTP 403 : accès interdit
            echo json_encode(["error" => "Utilisateur non connecté"]);
            exit;
        }

        // Récupère les données JSON envoyées par la requête POST
        $input = json_decode(file_get_contents("php://input"), true);

        // Vérifie que les paramètres nécessaires sont bien présents
        if (!isset($input['offer_id'], $input['action'])) {
            http_response_code(400); // Code HTTP 400 : mauvaise requête
            echo json_encode(["error" => "Paramètres manquants"]);
            exit;
        }

        // Récupération et validation des données d'entrée
        $userId = intval($_SESSION['userID']);       // ID de l'utilisateur actuel
        $offerId = intval($input['offer_id']);       // ID de l'offre à traiter
        $action = $input['action'];                  // Action à effectuer : 'like' ou 'dislike'

        try {
            // Connexion aux deux bases de données
            [$pdoMain, $_] = connectToDatabases(); // Le second $pdoVec est inutile ici
            // Instanciation du modèle avec la base principale
            $model = new MatchModel($pdoMain);

            // Si l'action est un like
            if ($action === 'like') {
                $model->likeOffer($userId, $offerId); // Enregistre le like
                $recruiterId = $model->getRecruiterIdFromOffer($offerId); // Récupère l'ID du recruteur concerné

                // Vérifie si le recruteur a aussi liké l'utilisateur
                if ($recruiterId && $model->recruiterLikesUser($userId, $recruiterId)) {
                    // Crée un match entre les deux
                    $model->insertMatch($recruiterId, $userId, $offerId);
                    echo json_encode(["status" => "match"]);
                    return;
                }

                // Si pas de match réciproque, on retourne simplement "liked"
                echo json_encode(["status" => "liked"]);

                // Si l'action est un dislike
            } elseif ($action === 'dislike') {
                echo json_encode(["status" => "disliked"]);

                // Si l'action n'est ni 'like' ni 'dislike'
            } else {
                http_response_code(400); // Code HTTP 400 : mauvaise requête
                echo json_encode(["error" => "Action invalide"]);
            }

            // Gestion des erreurs PDO (base de données)
        } catch (PDOException $e) {
            http_response_code(500); // Code HTTP 500 : erreur interne serveur
            echo json_encode(["error" => "Erreur BDD : " . $e->getMessage()]);
        }
    }
}