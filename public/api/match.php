<?php

// Inclusion du contrôleur qui gère les actions de swipe côté étudiant (like/dislike + matching)
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/swipe_controller/matchController.php';

// Création d'une instance du contrôleur
$controller = new MatchController();

// Exécution de la méthode handle() pour traiter la requête POST (offre + action)
$controller->handle();