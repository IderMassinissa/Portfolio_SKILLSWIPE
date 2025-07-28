<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/swipe_model/swipeUserModel.php';

class SwipeUserController
{
    public static function getFilteredUsers(PDO $pdoMain, PDO $pdoVec, int $recruiterId, string $location = '', array $skills = []): array
    {
        // Connexion aux deux bases
        [$pdoMain, $pdoVec] = connectToDatabases();

        // Extraction et nettoyage des filtres
        $location = $filters['localisation'] ?? '';
        $skills = $filters['skills'] ?? [];

        // Appel au modèle
        return SwipeUserModel::getUsersFiltered($pdoMain, $pdoVec, $recruiterId, $location, $skills);
    }
}
