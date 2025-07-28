<?php
// Inclusion du modèle SwipeRecruiterModel qui gère les données liées aux utilisateurs ayant liké des offres
require_once $_SERVER['DOCUMENT_ROOT'] . '/Models/swipe_model/exploreUserModel.php';

// Définition de la classe SwipeRecruiterController pour le côté recruteur du swipe
class ExploreUserController
{
    // Méthode statique pour récupérer les profils d'utilisateurs ayant liké les offres d’un recruteur
    public static function getFilteredUsers(int $recruiterId): array
    {
        // Connexion aux deux bases de données (principale et vectorielle)
        [$pdoMain, $pdoVec] = connectToDatabases();

        // Récupère la liste des utilisateurs ayant liké les offres du recruteur
        $likedUsers = ExploreUserModel::getUsersWhoLikedOffers($pdoMain, $recruiterId);
        $result = [];

        // Pour chaque utilisateur, on récupère son vecteur de compétences (si disponible)
        foreach ($likedUsers as $user) {
            // Récupère le vecteur de l'utilisateur (sauf l'ID)
            $userVector = ExploreUserModel::getUserVector($pdoVec, $user['ID']);
            $user['vector'] = $userVector ? array_values(array_slice($userVector, 1, 14)) : []; // Exclut l'ID du vecteur

            // Ajoute l'utilisateur enrichi dans le tableau résultat
            $result[] = $user;
        }

        // Retourne la liste des utilisateurs avec leurs vecteurs
        return $result;
    }
}