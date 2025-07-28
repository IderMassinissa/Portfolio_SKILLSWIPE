<?php
session_start();

require_once "routes/controllers_routes.php";
require_once "library/display.php";

if (empty($_GET)) {
    display("home", "Page d'accueil", "index");
} else {
    $go = $_GET["go"] ?? null;
    if(!isset(CONTROLLERS_PATHS[$go])) {

        require_once DEFAULT_CONTROLLER_ROUTE;

    } else {

        require_once CONTROLLERS_PATHS[$go];
    }
}

