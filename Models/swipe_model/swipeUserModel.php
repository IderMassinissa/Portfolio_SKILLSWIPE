<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/vector_tools.php';

class SwipeUserModel
{
    public static function getUsersFiltered(
        PDO $pdoMain,
        PDO $pdoVec,
        int $recruiterId,
        string $location = '',
        array $skills = []
    ): array {
        $sql = "
            SELECT DISTINCT u.ID, u.Name, u.Email, u.user_description,
                COALESCE(med.Path, '/public/images/default_missing_picture.png') AS photo_path
            FROM User u
            LEFT JOIN Media med ON med.User_ID = u.ID
            LEFT JOIN Matching m ON m.User_ID = u.ID AND m.Recruiter_ID = :recruiter_id
            LEFT JOIN Like_User lu ON lu.User_ID = u.ID AND lu.Recruiter_ID = :recruiter_id
            LEFT JOIN Localisation l ON u.Address_ID = l.ID
            WHERE u.User_type = 'etudiant'
              AND m.ID IS NULL
              AND lu.ID IS NULL
        ";

        $params = ['recruiter_id' => $recruiterId];

        if (!empty($location)) {
            $sql .= " AND l.Address_Name LIKE :location";
            $params['location'] = "%$location%";
        }

        if (!empty($skills)) {
            $conditions = [];
            foreach ($skills as $i => $skill) {
                $param = "skill_$i";
                $conditions[] = "sk.Name LIKE :$param";
                $params[$param] = "%$skill%";
            }

            $sql .= " AND EXISTS (
                SELECT 1 FROM User_Skill us
                JOIN Skill sk ON sk.ID = us.SkillID
                WHERE us.UserID = u.ID AND (" . implode(" OR ", $conditions) . ")
            )";
        }

        $stmt = $pdoMain->prepare($sql);
        $stmt->execute($params);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Récupère toutes les offres du recruteur
        $offerStmt = $pdoMain->prepare("SELECT ID FROM Job_Offer WHERE Recruiter_ID = ?");
        $offerStmt->execute([$recruiterId]);
        $offerIds = $offerStmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($offerIds))
            return [];

        // Récupère les vecteurs des offres
        $placeholders = implode(',', array_fill(0, count($offerIds), '?'));
        $offerVecStmt = $pdoVec->prepare("SELECT * FROM Offer_Vector WHERE Offer_ID IN ($placeholders)");
        $offerVecStmt->execute($offerIds);
        $offerVectors = $offerVecStmt->fetchAll(PDO::FETCH_ASSOC);

        $offerVecMap = [];
        foreach ($offerVectors as $ov) {
            $offerVecMap[$ov['Offer_ID']] = normalizeVector(array_values(array_slice($ov, 1)));
        }

        // Calcule le meilleur score de similarité pour chaque étudiant
        foreach ($students as &$student) {
            $vecStmt = $pdoVec->prepare("SELECT * FROM User_Vector WHERE User_ID = ?");
            $vecStmt->execute([$student['ID']]);
            $vec = $vecStmt->fetch(PDO::FETCH_ASSOC);

            if (!$vec) {
                $student['score'] = 0;
                continue;
            }

            $userVector = normalizeVector(array_values(array_slice($vec, 1)));
            $bestScore = 0;

            foreach ($offerVecMap as $offerVector) {
                $score = cosineSimilarity($userVector, $offerVector);
                $bestScore = max($bestScore, $score);
            }

            $student['score'] = $bestScore;
        }

        // Trie par score décroissant
        usort($students, fn($a, $b) => $b['score'] <=> $a['score']);

        // Limite à 10 résultats
        $students = array_slice($students, 0, 10);
        
        // Supprime le score du retour
        foreach ($students as &$s) {
            unset($s['score']);
        }

        return $students;
    }
}