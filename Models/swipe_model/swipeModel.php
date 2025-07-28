<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/library/vector_tools.php';

class SwipeModel
{
    public static function getUserVector(PDO $pdo, int $userId): ?array
    {
        $stmt = $pdo->prepare("SELECT * FROM User_Vector WHERE User_ID = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserDescription(PDO $pdo, int $userId): ?string
    {
        $stmt = $pdo->prepare("SELECT user_description FROM User WHERE ID = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public static function getFilteredOffers(PDO $pdo, array $filters, int $userId): array
    {
        $where = ["jo.ID NOT IN (SELECT Job_Offer_ID FROM Like_Job_Offer WHERE User_ID = :currentUser)"];
        $params = ['currentUser' => $userId];

        if (!empty($filters['poste'])) {
            $where[] = "jo.Title LIKE :poste";
            $params['poste'] = '%' . $filters['poste'] . '%';
        }

        if (!empty($filters['contrat'])) {
            $where[] = "c.Name = :contrat";
            $params['contrat'] = $filters['contrat'];
        }

        if (!empty($filters['secteur'])) {
            $where[] = "i.Name LIKE :secteur";
            $params['secteur'] = '%' . $filters['secteur'] . '%';
        }

        if (!empty($filters['localisation'])) {
            $where[] = "co.Address LIKE :localisation";
            $params['localisation'] = '%' . $filters['localisation'] . '%';
        }

        $sql = "
            SELECT jo.ID AS offer_id, jo.Title, jd.Description, co.Name AS company, ov.*
            FROM Job_Offer jo
            JOIN Job_Description jd ON jd.ID = jo.Job_Description_ID
            JOIN Company co ON co.ID = jo.Company_ID
            JOIN Contract c ON c.ID = jo.Contract_ID
            JOIN skillswipe_matching.Offer_Vector ov ON ov.Offer_ID = jo.ID
            WHERE " . implode(" AND ", $where) . "
            LIMIT 15
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMatchingOffers(int $userId, array $filters): array
    {
        [$pdoMain, $pdoVec] = connectToDatabases();

        $userVector = self::getUserVector($pdoVec, $userId);
        if (!$userVector)
            return [];

        $pVector = array_values(array_slice($userVector, 1, 14));
        $userDesc = self::getUserDescription($pdoMain, $userId) ?: '';
        $skillVector = getEmbeddingFromSkills($pdoMain, $userDesc);
        $fullVector = array_merge($pVector, $skillVector);

        $offers = self::getFilteredOffers($pdoMain, $filters, $userId);
        $result = [];

        foreach ($offers as $offer) {
            $vVector = array_values(array_slice($offer, -17, 14)); // v1 → v14
            $click = $offer['v12'] ?? 0;
            $dwell = $offer['v13'] ?? 0;
            $cosine = cosineSimilarity($fullVector, $vVector);

            $score = round((0.7 * $cosine) + (0.2 * $dwell) + (0.1 * $click), 4);
            $offer['score'] = $score;
            $result[] = $offer;
        }

        usort($result, fn($a, $b) => $b['score'] <=> $a['score']);
        return array_slice($result, 0, 10);
    }
}