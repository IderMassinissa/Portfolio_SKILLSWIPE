<!DOCTYPE html>
<html lang="fr">

<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$userType = $_SESSION['user_type'] ?? null;
$isRecruiter = $userType === 'recruteur';

$pageTitle = $title ?? 'SkillSwipe';
$css_name = $css_name ?? 'style';
$view_name = $view_name ?? 'home';

require_once $_SERVER['DOCUMENT_ROOT'] . "/routes/views_routes.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/routes/nav_routes.php";
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="icon" type="image/x-icon" href="/public/images/Logo_SkillSwipe.png">
  <link rel="stylesheet" href="/public/css/<?= htmlspecialchars($css_name) ?>.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<?php if ($view_name !== "home" && !in_array($view_name, NO_NAV_PAGES)): ?>
  <link rel="stylesheet" href="/public/css/style.css">

  <body>
    <header>
      <div class="header-wrapper">

        <!-- Gauche : menu burger (mobile uniquement) -->
        <div class="header-left">
          <div id="menu-toggle" class="burger-menu" title="Menu">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>

        <!-- Centre : logo + menu desktop -->
        <div class="header-center">
          <a href="/" class="logo">SKILLSWIPE</a>

          <nav class="nav-desktop">
            <?php if ($isRecruiter): ?>
              <a href="/swipe_user">SWIPE</a>
              <a href="/explore_users_page">MATCH</a>
              <a href="/message_list">Messagerie</a>
              <a href="/offer_list_recruiter">Offres</a>
            <?php else: ?>
              <a href="/swipe_page">Swipe & Match</a>
              <a href="/message_list">Messagerie</a>
              <a href="/offer_list">Offres</a>
            <?php endif; ?>
            <a href="/event/index">Événements</a>
          </nav>
        </div>

        <!-- Droite : profil + logout -->
        <div class="header-right">
          <a href="/profile" class="pfp-user" title="Profil">
            <img src="<?= $_SESSION["user_pic"]; ?>" alt="Photo de profil">
          </a>
          <a href="/login" class="logout-icon" title="Déconnexion">
            <img src="/public/images/logout.png" alt="Déconnexion" class="logout-img">
          </a>
        </div>
      </div>

      <!-- Menu plein écran (mobile) -->
      <div id="fullscreen-menu" class="fullscreen-menu hidden">
        <button id="close-menu" class="close-menu" aria-label="Fermer le menu">✖</button>
        <nav>
          <?php if ($isRecruiter): ?>
            <a href="/swipe_user">SWIPE</a>
            <a href="/explore_users_page">MATCH</a>
            <a href="/message_list">Messagerie</a>
            <a href="/offer_list_recruiter">Offres</a>
          <?php else: ?>
            <a href="/swipe_page">Swipe & Match</a>
            <a href="/message_list">Messagerie</a>
            <a href="/offer_list">Offres</a>
          <?php endif; ?>
          <a href="/event/index">Événements</a>
          <a href="/profile">Profil</a>
          <a href="/login">Déconnexion</a>
        </nav>
      </div>
    </header>

    <main class="container">
    <?php endif; ?>

    <?php
    $viewFile = $_SERVER['DOCUMENT_ROOT'] . VIEWS_PATHS[$view_name] ?? null;
    if ($viewFile && file_exists($viewFile)) {
      require_once $viewFile;
    }
    ?>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const menuToggle = document.getElementById("menu-toggle");
        const fullscreenMenu = document.getElementById("fullscreen-menu");
        const closeMenu = document.getElementById("close-menu");

        if (menuToggle && fullscreenMenu && closeMenu) {
          menuToggle.addEventListener("click", () => {
            fullscreenMenu.classList.remove("hidden");
          });

          closeMenu.addEventListener("click", () => {
            fullscreenMenu.classList.add("hidden");
          });
        }
      });
    </script>