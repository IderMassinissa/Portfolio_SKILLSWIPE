<?php
class GeneralController
{
    public static function load(string $viewName): void
    {
        $allowedPages = ['contact', 'about', 'privacy', 'terms'];

        if (!in_array($viewName, $allowedPages)) {
            http_response_code(404);
            echo "Page non trouvée.";
            exit;
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . "/SkillSwipe/Views/static/$viewName.php";
    }
}