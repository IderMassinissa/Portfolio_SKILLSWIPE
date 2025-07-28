<?php
// Modèle gérant les opérations liées aux likes, matchs et interactions entre utilisateurs et recruteurs
class MatchModel
{
    private PDO $pdo;

    // Constructeur : initialise l'objet avec une connexion PDO à la base principale
    public function __construct(PDO $pdoMain)
    {
        $this->pdo = $pdoMain;
    }

    // Enregistre un like d’un utilisateur pour une offre (sans duplication grâce à INSERT IGNORE)
    public function likeOffer(int $userId, int $offerId): void
    {
        $stmt = $this->pdo->prepare("INSERT IGNORE INTO Like_Job_Offer (User_ID, Job_Offer_ID) VALUES (?, ?)");
        $stmt->execute([$userId, $offerId]);
    }

    // Récupère l’ID du recruteur à partir de l’ID de l’offre
    public function getRecruiterIdFromOffer(int $offerId): ?int
    {
        $stmt = $this->pdo->prepare("SELECT Recruiter_ID FROM Job_Offer WHERE ID = ?");
        $stmt->execute([$offerId]);
        return $stmt->fetchColumn() ?: null;
    }

    // Vérifie si le recruteur a liké l’utilisateur en retour
    public function recruiterLikesUser(int $userId, int $recruiterId): bool
    {
        $stmt = $this->pdo->prepare("SELECT 1 FROM Like_User WHERE User_ID = ? AND Recruiter_ID = ?");
        $stmt->execute([$userId, $recruiterId]);
        return (bool) $stmt->fetch();
    }

    // Enregistre un match entre un recruteur et un utilisateur pour une offre donnée
    public function insertMatch(int $recruiterId, int $userId, int $offerId): void
    {
        $stmt = $this->pdo->prepare("INSERT IGNORE INTO Matching (Recruiter_ID, User_ID, Job_Offer_ID) VALUES (?, ?, ?)");
        $stmt->execute([$recruiterId, $userId, $offerId]);
    }

    // Gère l’action 'like' ou 'dislike' et renvoie une réponse adaptée
    public static function processAction(PDO $pdo, int $userId, int $offerId, string $action): array
    {
        $model = new self($pdo);

        if ($action === 'like') {
            $model->likeOffer($userId, $offerId);

            $recruiterId = $model->getRecruiterIdFromOffer($offerId);
            if ($recruiterId && $model->recruiterLikesUser($userId, $recruiterId)) {
                $model->insertMatch($recruiterId, $userId, $offerId);
                return ["status" => "match"];
            }

            return ["status" => "liked"];
        }

        if ($action === 'dislike') {
            return ["status" => "disliked"];
        }

        return ["error" => "Action inconnue"];
    }

    // Enregistre un like d’un recruteur pour un utilisateur
    public function likeUser(int $userId, int $recruiterId): void
    {
        $stmt = $this->pdo->prepare("INSERT IGNORE INTO Like_User (User_ID, Recruiter_ID) VALUES (?, ?)");
        $stmt->execute([$userId, $recruiterId]);
    }

    // Recherche une offre aimée par l'utilisateur parmi celles du recruteur
    public function findMutualOffer(int $userId, int $recruiterId): ?int
    {
        $stmt = $this->pdo->prepare("
            SELECT lo.Job_Offer_ID
            FROM Like_Job_Offer lo
            JOIN Job_Offer jo ON lo.Job_Offer_ID = jo.ID
            WHERE lo.User_ID = ? AND jo.Recruiter_ID = ?
            LIMIT 1
        ");
        $stmt->execute([$userId, $recruiterId]);
        return $stmt->fetchColumn() ?: null;
    }
}