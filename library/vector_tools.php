<?php

// Fonction pour normaliser un vecteur (ramène tous les éléments à une norme unitaire)
function normalizeVector(array $vector): array
{
    $norm = sqrt(array_sum(array_map(fn($x) => $x ** 2, $vector)));
    return $norm > 0 ? array_map(fn($x) => $x / $norm, $vector) : $vector;
}

// Fonction qui calcule le produit scalaire entre deux vecteurs
function dotProduct(array $a, array $b): float
{
    return array_sum(array_map(fn($x, $y) => $x * $y, $a, $b));
}

// Fonction qui calcule la similarité cosinus entre deux vecteurs
function cosineSimilarity(array $a, array $b): float
{
    $normA = sqrt(array_sum(array_map(fn($x) => $x ** 2, $a)));
    $normB = sqrt(array_sum(array_map(fn($x) => $x ** 2, $b)));
    if ($normA == 0 || $normB == 0)
        return 0;
    return dotProduct($a, $b) / ($normA * $normB);
}

// Fonction qui transforme un texte en vecteur binaire selon les compétences présentes en BDD
function getEmbeddingFromSkills(PDO $pdo, string $text): array
{
    $stmt = $pdo->query("SELECT Name FROM Skill ORDER BY ID");
    $skills = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $text = strtolower($text);
    $embedding = [];

    foreach ($skills as $skill) {
        $embedding[] = str_contains($text, strtolower($skill)) ? 1.0 : 0.0;
    }

    return $embedding;
}

// Fonction pour générer et insérer ou mettre à jour les vecteurs d'un utilisateur
function updateUserVector(PDO $pdoVec, PDO $pdoMain, int $userId): void
{
    // Récupération de la description utilisateur
    $stmt = $pdoMain->prepare("SELECT user_description FROM User WHERE ID = ?");
    $stmt->execute([$userId]);
    $description = $stmt->fetchColumn() ?: "";

    // Calcul du vecteur compétences
    $skillsVector = getEmbeddingFromSkills($pdoMain, $description);

    // Normalisation du vecteur
    $normalized = normalizeVector($skillsVector);

    // Création des placeholders pour les colonnes (p1 à p14...) selon la taille
    $columns = [];
    $placeholders = [];
    for ($i = 0; $i < count($normalized); $i++) {
        $columns[] = "p" . ($i + 1);
        $placeholders[] = ":p" . ($i + 1);
    }

    $sql = "REPLACE INTO User_Vector (User_ID, " . implode(',', $columns) . ")
            VALUES (:user_id, " . implode(',', $placeholders) . ")";
    $stmt = $pdoVec->prepare($sql);

    $params = ['user_id' => $userId];
    foreach ($normalized as $i => $val) {
        $params["p" . ($i + 1)] = $val;
    }

    $stmt->execute($params);
}