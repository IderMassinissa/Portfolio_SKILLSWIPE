<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Vérifie que l'utilisateur est un recruteur
if (!isset($_SESSION['userID']) || $_SESSION['user_type'] !== 'recruteur') {
    http_response_code(403);
    echo json_encode(["error" => "Accès refusé : recruteur requis"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
if (!isset($input['student_id'], $input['action'])) {
    http_response_code(400);
    echo json_encode(["error" => "Paramètres manquants"]);
    exit;
}

$recruiterId = (int) $_SESSION['userID'];
$studentId = (int) $input['student_id'];
$action = $input['action'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

try {
    $pdo = getDbConnection();

    if ($action === 'like') {
        // Vérifie s'il y a déjà un like
        $check = $pdo->prepare("SELECT 1 FROM Like_User WHERE Recruiter_ID = ? AND User_ID = ?");
        $check->execute([$recruiterId, $studentId]);

        if ($check->rowCount() === 0) {
            $insert = $pdo->prepare("INSERT INTO Like_User (User_ID, Recruiter_ID) VALUES (?, ?)");
            $insert->execute([$studentId, $recruiterId]);
        }

        // Récupère les offres du recruteur
        $offers = $pdo->prepare("SELECT ID FROM Job_Offer WHERE Recruiter_ID = ?");
        $offers->execute([$recruiterId]);
        $offerIds = $offers->fetchAll(PDO::FETCH_COLUMN);

        if (!empty($offerIds)) {
            $inClause = implode(',', array_fill(0, count($offerIds), '?'));
            $params = array_merge([$studentId], $offerIds);

            $matchCheck = $pdo->prepare("
                SELECT Job_Offer_ID FROM Like_Job_Offer 
                WHERE User_ID = ? AND Job_Offer_ID IN ($inClause)
            ");
            $matchCheck->execute($params);

            $matchedOfferId = $matchCheck->fetchColumn();
            if ($matchedOfferId) {
                $insertMatch = $pdo->prepare("
                    INSERT IGNORE INTO Matching (Recruiter_ID, User_ID, Job_Offer_ID, Status)
                    VALUES (?, ?, ?, 'match')
                ");
                $insertMatch->execute([$recruiterId, $studentId, $matchedOfferId]);

                echo json_encode(["match" => true, "offer_id" => $matchedOfferId]);
                exit;
            }
        }

        echo json_encode(["like" => true]);
        exit;

    } elseif ($action === 'dislike') {
        echo json_encode(["dislike" => true]);
        exit;
    }

    http_response_code(400);
    echo json_encode(["error" => "Action invalide"]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Erreur serveur",
        "message" => $e->getMessage()
    ]);
    exit;
}