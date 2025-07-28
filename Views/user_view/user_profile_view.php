<?php
function displayOrPlaceholder($value) {
    if (!$value) {
        $value = '<span style="color: #888; font-style: italic;">Non renseigné</span>';
    }
    return $value;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Profil utilisateur</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./public/css/profile.css">
</head>
<body>

<div class="page-container">
  <button id="go-back">← Retour</button>
  <h2>Profil de <?= htmlspecialchars($profileDetails[0]['Name']) ?></h2>

  <div class="profile-image-section">
    <div class="upload">
      <img src="<?= $userImage ?>" alt="Profile Picture">
    </div>
  </div>

  <div class="basic-info-display">
    <p><strong>Téléphone :</strong> <?= displayOrPlaceholder($profileDetails[0]['Phone_number']); ?></p>
    <p><strong>Email :</strong> <?= displayOrPlaceholder($profileDetails[0]['Email']); ?></p>
    <p><strong>Adresse :</strong> <?= displayOrPlaceholder($profileDetails[0]['Address']); ?></p>
    <p><strong>Bio :</strong> <?= displayOrPlaceholder($profileDetails[0]['user_description']); ?></p>
  </div>

  <h3>Compétences</h3>
  <ul class="skills-list">
    <?php foreach ($getUserSkills as $skill): ?>
      <li><?= htmlspecialchars($skill['Name']) ?></li>
    <?php endforeach; ?>
    <?php if (count($getUserSkills) === 0): ?>
      <p style="color: #888; font-style: italic;">Aucune compétence renseignée.</p>
    <?php endif; ?>
  </ul>

  <h3>Éducation</h3>
  <div class="entry-box">
    <?php foreach ($getUserEducation as $edu): ?>
      <div class="entry-item">
        <strong><?= htmlspecialchars($edu['School']) ?></strong> – <?= htmlspecialchars($edu['Certification']) ?><br>
        <small><?= $edu['Start_Date'] ?> à <?= $edu['End_Date'] ?></small>
      </div>
    <?php endforeach; ?>
    <?php if (count($getUserEducation) === 0): ?>
      <p style="color: #888; font-style: italic;">Aucune formation renseignée.</p>
    <?php endif; ?>
  </div>

  <h3>Expérience</h3>
  <div class="entry-box">
    <?php foreach ($getUserExperience as $exp): ?>
      <div class="entry-item">
        <strong><?= htmlspecialchars($exp['Company']) ?></strong> – <?= htmlspecialchars($exp['Position']) ?><br>
        <small><?= $exp['Start_Date'] ?> à <?= $exp['End_Date'] ?></small>
      </div>
    <?php endforeach; ?>
    <?php if (count($getUserExperience) === 0): ?>
      <p style="color: #888; font-style: italic;">Aucune expérience renseignée.</p>
    <?php endif; ?>
  </div>

  <h3>Documents</h3>
  <div class="entry-box">
    <?php if (count($getUserDocuments) > 0): ?>
      <?php foreach ($getUserDocuments as $doc): ?>
        <div class="entry-item">
          <strong><?= htmlspecialchars($doc['Name']) ?></strong><br>
          <a href="<?= $doc['Path']; ?>" target="_blank">Voir</a> |
          <a href="<?= $doc['Path']; ?>" download>Télécharger</a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="color: #888; font-style: italic;">Aucun document disponible.</p>
    <?php endif; ?>
  </div>

</div>
</body>
</html>
<script>
  document.getElementById("go-back").addEventListener("click", () => {
    history.back();
  });
</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>