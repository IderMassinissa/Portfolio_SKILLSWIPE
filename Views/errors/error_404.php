<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
  <div class="background-bubbles" id="bubbles-container"></div>
  <div class="container">
    <div class="text-box">
      <h1>404</h1>
      <p>Oups ! Cette page est introuvable.</p>
      <button onclick="window.history.back()">Retour</button>
    </div>
    <div class="image-box">
      <div class="flip-card">
        <div class="flip-face flip-front">
          <img src="https://preview.redd.it/posting-an-osage-chan-image-day-53-v0-vkexza14pcje1.png?width=566&format=png&auto=webp&s=ca21ab71a019ea1b795dd5e2441deb3f34bdb613" alt="Perdu Front" />
        </div>
        <div class="flip-face flip-back">
          <img src="https://uploads.dailydot.com/2024/07/yamchas-death-pose.jpg?q=65&auto=format&w=1600&ar=2:1&fit=crop" alt="Perdu Back" />
        </div>
      </div>
    </div>
    <div id="confetti-container"></div>
    <audio id="confetti-sound" src="/assets/Yippee.mp3" preload="auto"></audio>
  </div>
  <script src="/public/Js/error-page.js"></script>
</body>
</html>