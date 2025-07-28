<?php
// Modèle dédié aux recruteurs pour récupérer les utilisateurs ayant liké leurs offres
class ExploreUserModel
{
    // Récupère tous les utilisateurs ayant liké une ou plusieurs offres du recruteur donné
    public static function getUsersWhoLikedOffers(PDO $pdo, int $recruiterId): array
    {
        $sql = "
            SELECT u.ID, u.Name, u.Email, u.user_description,
                COALESCE(med.Path, '/public/images/default_missing_picture.png') AS photo_path
            FROM Like_Job_Offer l
            JOIN Job_Offer jo ON jo.ID = l.Job_Offer_ID
            JOIN User u ON u.ID = l.User_ID
            LEFT JOIN Media med ON med.User_ID = u.ID
            WHERE jo.Recruiter_ID = ?

            -- Exclure les utilisateurs déjà likés par ce recruteur
            AND u.ID NOT IN (
                SELECT User_ID FROM Like_User WHERE Recruiter_ID = jo.Recruiter_ID
            )

            -- Exclure les utilisateurs déjà matchés avec ce recruteur sur une de ses offres
            AND NOT EXISTS (
                SELECT 1 FROM Matching m
                WHERE m.Recruiter_ID = jo.Recruiter_ID
                  AND m.User_ID = u.ID
                  AND m.Job_Offer_ID = jo.ID
            )
            GROUP BY u.ID
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$recruiterId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère le vecteur d’un étudiant
    public static function getUserVector(PDO $pdo, int $userId): ?array
    {
        $stmt = $pdo->prepare("SELECT * FROM User_Vector WHERE User_ID = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}