
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mes informations</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../public/css/profile.css">
</head>
<body>

<div class="page-container">

  <h2>Mes informations</h2>


<div class="profile-image-section">
  <form id="form" action="upload_image_controller.php" method="POST" enctype="multipart/form-data">
    <div class="upload">
      <img src="/SkillSwipe/<?= $userImage ?>" alt="Profile Picture">
      <div class="round">
        <label>
          <i class="fa fa-camera"></i>
          <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png">
        </label>
      </div>
    </div>
</form>

    
    <h2><?= $profileDetails[0]['Name'] ?></h2>
  </div>

  <div class="basic-info-display" id="displaySection">
    <p><strong>Téléphone :</strong> <span><?= displayOrPlaceholder($profileDetails[0]['Phone_number']); ?></span></p>
    <p><strong>Email :</strong> <span><?= displayOrPlaceholder($profileDetails[0]['Email']); ?></span></p>
    <p><strong>Adresse :</strong> <span><?= displayOrPlaceholder($profileDetails[0]['Address']); ?></span></p>
    <p><strong>Bio :</strong> <span><?= displayOrPlaceholder($profileDetails[0]['user_description']); ?></span></p>
  </div>

  <form class="basic-info-form" id="formSection" method="post" action="../../Controllers/user_controller/edit_profile_controller.php">
    <input type="hidden" name="info" value="basic">
    <label>Nom :
      <input type="text" name="Name" value="<?= $profileDetails[0]['Name'] ?? ''; ?>" required>
    </label>
    <label>Téléphone :
      <input type="text" name="Phone_number" value="<?= $profileDetails[0]['Phone_number'] ?? ''; ?>" required>
    </label>
    <label>Email :
      <input type="email" name="Email" value="<?= $profileDetails[0]['Email'] ?? ''; ?>" required>
    </label>
    <label>Adresse :
      <input type="text" name="Address" value="<?= $profileDetails[0]['Address'] ?? ''; ?>" required>
    </label>
    <label>Bio :
      <textarea name="description" required><?= htmlspecialchars($profileDetails[0]["user_description"] ?? '') ?></textarea>
    </label>
  </form>

  <button id="toggleBtn">Modifier</button>



<h3>Documents (CVs, certificats...)</h3>

<div class="entry-box">
  <?php if (count($getUserDocuments) > 0): ?>
    <?php foreach ($getUserDocuments as $doc): ?>
      <div class="entry-item">
        <div>
          <strong><?= htmlspecialchars($doc['Name']) ?></strong><br>
          <a href="<?= $doc['Path']; ?>" target="_blank">Voir</a> | 
          <a href="<?= $doc['Path']; ?>" download>Télécharger</a>
        </div>
        <form method="POST" action="../../Controllers/user_controller/edit_profile_controller.php">
          <input type="hidden" name="info" value="delete_document">
          <input type="hidden" name="doc_id" value="<?= $doc['ID'] ?>">
          <button type="submit" class="delete-btn" title="Supprimer ce document">×</button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="color: #999; font-style: italic;">Aucun document envoyé.</p>
  <?php endif; ?>
</div>

 <form action="../../Controllers/user_controller/edit_profile_controller.php" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
  <input type="hidden" name="info" value="documents">
  <label for="cv">Ajouter un document (PDF) :</label>
  <input type="file" id="cv" name="cv" accept="application/pdf" required>
  <button type="submit" class="primary-btn">Ajouter</button>
</form>