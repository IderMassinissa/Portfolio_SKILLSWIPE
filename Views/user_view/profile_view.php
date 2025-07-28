<?php
function displayOrPlaceholder($value) {
    if (!$value) {
        $value = '<span style="color: #888; font-style: italic;">Non renseigné</span>';
    }
    return $value;
}
?>

<!-- basic info -->
<div class="page-container">

  <h2>Mes informations</h2>


<div class="profile-image-section">
  <form  id="form" action="/edit_profile" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="info" value="profilepic">
    <div class="upload">
      <img src="<?= $userImage ?>" alt="Profile Picture">
      <div class="round">
        <label>
          <i class="icon-camera"></i> 
          <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png">
        </label>
      </div>
    </div>
</form>

    
    <h2><?= $profileDetails[0]['Name'] ?></h2>
  </div>
<div class="basic-info-display">
  <div id="displaySection">
      <p><strong>Téléphone :</strong> <span><?= displayOrPlaceholder($profileDetails[0]['Phone_number']); ?></span></p>
      <p><strong>Email :</strong> <span><?= displayOrPlaceholder($profileDetails[0]['Email']); ?></span></p>
      <p><strong>Adresse :</strong> <span><?= displayOrPlaceholder($profileDetails[0]['Address']); ?></span></p>
      <p><strong>Bio :</strong> <span><?= displayOrPlaceholder($profileDetails[0]['user_description']); ?></span></p>
  </div>
  <form  class ="forms" class="basic-info-form" id="formSection" method="post" action="/edit_profile">
    <input type="hidden" name="info" value="basic">

    <label>Nom:
      <input type="text" name="Name">
    </label>

    <label>Téléphone:
      <input type="text" name="Phone_number">
    </label>

    <label>Adresse :
      <input type="text" name="Address" id="adresse" autocomplete="off" >
      <ul id="suggestions" style="position: absolute; background: white; border: 1px solid #ccc; list-style: none; margin: 0; padding: 0; width: fit-content; max-height: 150px; overflow-y: auto; z-index: 10;"></ul>
    </label>

    <label>Bio:
      <textarea name="description"></textarea>
    </label>

  </form>
  <button id="toggleBtn" class="buttons buttons-color forms-action-buttons"> 
    <i id="editBtnIcon" class="icon-edit"></i>
    <span id="editButtonText"></span>
  </button>

  <button id="cancelFormButton-basic-info" class="forms-action-buttons buttons buttons-color cancel-button cancel-button-color"> 
    <i class="icon-remove"></i>
    Annuler
  </button>
</div>

<div class="skills">
    <h3>Compétences</h3>

    <!-- Add skills -->
    <!-- <button title="Ajouter une compétence" class="buttons buttons-color" onclick="document.getElementById('skillForm').style.display='block'">
      <i class="icon-plus"></i>
    </button> -->
    <button id="add_skill_btn" title="Ajouter une compétence" class="buttons buttons-color" onclick="toggleForm('skillForm')">
      <i class="icon-plus"></i>
    </button>
</div>

<ul id="skillsList">
  <?php foreach ($getUserSkills as $skill): ?>
    <li>
      <form method="POST" action="/edit_profile">
        <?= htmlspecialchars($skill['Name']) ?>
        <input type="hidden" name="info" value="delete_skill">
        <input type="hidden" name="skill_id" value="<?= $skill['ID'] ?>">

        
        <button type="submit" class="clear_button" title="Supprimer cette compétence">
          <i class="icon-remove"></i>
        </button>
      </form>
    </li>
  <?php endforeach; ?>
</ul>


<form id="skillForm" style="display: none;" method="POST" action="/edit_profile">
  <input type="hidden" name="info" value="skills">
  <input type="text" name="skill" placeholder="Ex : HTML, Photoshop, Node.js" required>
   <button type="submit" class="validation-btn">
        Valider 
        <i id="editBtnIcon" class="icon-ok"></i>
    </button>
</form>

<!-- Add certificate -->
<div class="education">
  <h3>Diplômes</h3>
  <button id="add_edu_btn" title="Ajouter un diplôme" class="buttons buttons-color" onclick="toggleForm('eduForm')">
    <i class="icon-plus"></i>
  </button>
</div>

<div class="entry-box">
  <?php if (count($getUserEducation) > 0): ?>
    <?php foreach ($getUserEducation as $edu): ?>
      <div class="entry-item">
        <div>
          <strong><?= htmlspecialchars($edu['School']) ?></strong> – <?= htmlspecialchars($edu['Certification']) ?><br>
          <small><?= $edu['Start_Date'] ?> &emsp; à &emsp;  <?= $edu['End_Date'] ?></small>
        </div>
        <form method="POST" action="/edit_profile">
          <input type="hidden" name="info" value="delete_education">
          <input type="hidden" name="edu_id" value="<?= $edu['ID'] ?>">
          <button type="submit" class="clear_button" title="Supprimer ce diplôme">
            <i class="icon-remove"></i>
          </button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
      <p style="color: #999; font-style: italic;">Aucun diplôme renseigné.</p>
  <?php endif; ?>
</div>

<div class="education_form">
    <form class ="forms"  id="eduForm" style="display:none;" method="POST" action="/edit_profile">
      <p>Ajouter un diplôme</p>
      <input type="hidden" name="info" value="education">
      <input type="text" name="school" placeholder="École" required>
      <input type="text" name="certificate" placeholder="Diplôme" required>
      <input type="text" name="level" placeholder="Niveau" required>
      <input type="text" name="field" placeholder="Domaine" required>
      <input type="date" name="start" required>
      <input type="date" name="end" required>
      <button type="submit" class="validation-btn">
        Valider 
        <i id="editBtnIcon" class="icon-ok"></i>
      </button>
    </form>
</div>

<div class="experience">
    <h3>Expérience</h3>
    <button id="add_exp_btn" title="Ajouter un expérience" class="buttons buttons-color" onclick="toggleForm('expForm')">
      <i class="icon-plus"></i>
    </button>
</div>

<div class="entry-box">
  <?php if (count($getUserExperience) > 0): ?>
    <?php foreach ($getUserExperience as $exp): ?>
      <div class="entry-item">
        <div>
          <strong><?= htmlspecialchars($exp['Company']) ?></strong> – <?= htmlspecialchars($exp['Position']) ?><br>
          <small><?= $exp['Start_Date'] ?> à <?= $exp['End_Date'] ?></small>
        </div>
        <form method="POST" action="/edit_profile">
          <input type="hidden" name="info" value="delete_experience">
          <input type="hidden" name="exp_id" value="<?= $exp['ID'] ?>">
          <button type="submit" class="clear_button" title="Supprimer cette expérience">
            <i class="icon-remove"></i>
          </button>
        </form>
      </div>
    <?php endforeach; ?>
    <?php else: ?>
      <p style="color: #999; font-style: italic;">Aucune expérience renseigné.</p>
    <?php endif; ?>
</div>

    <form class ="forms" id="expForm" style="display:none;" method="POST" action="/edit_profile">
      <input type="hidden" name="info" value="experience">
      <input type="text" name="Company" placeholder="Entreprise" required>
      <input type="text" name="Position" placeholder="Poste" required>
      <input type="text" name="Address" placeholder="Adresse" required>
      <input type="date" name="Start" required>
      <input type="date" name="End" required>
      <button type="submit" class="validation-btn">
        Valider 
        <i id="editBtnIcon" class="icon-ok"></i>
      </button>
    </form>
  <br>
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
        <form method="POST" action="/edit_profile">
          <input type="hidden" name="info" value="delete_document">
          <input type="hidden" name="doc_id" value="<?= $doc['ID'] ?>">
          <button type="submit" class="clear_button" title="Supprimer ce document">
            <i class="icon-remove"></i>
          </button>
        </form>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p style="color: #999; font-style: italic;">Aucun document envoyé.</p>
  <?php endif; ?>
</div>

 <form action="/edit_profile" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
  <input type="hidden" name="info" value="documents">
  <label for="cv">Ajouter un document (PDF) :</label>
  <input type="file" id="cv" name="cv" accept="application/pdf"  required>
  <button type="submit" class="buttons primary-btn">
    <i class="icon-plus"></i>
    Ajouter un document
  </button>
</form>


<script>
  const toggleBtn = document.getElementById('toggleBtn');
  const displaySection = document.getElementById('displaySection');
  const formSection = document.getElementById('formSection');
  const editBtnIcon = document.getElementById('editBtnIcon');
  const editButtonText = document.getElementById('editButtonText');
  const cancelBasicInfo = document.getElementById('cancelFormButton-basic-info');
  const expEdit = document.getElementById("add_exp_btn");
  const eduEdit = document.getElementById("add_edu_btn");
  const skillEdit = document.getElementById("add_skill_btn");

  let isEditing = false;


  toggleBtn.addEventListener('click', () => {
    if (isEditing) {
      formSection.submit();
    } else {
      formSection.style.display = 'block';
      cancelBasicInfo.style.display = 'block';
      displaySection.style.display = 'none';
      editButtonText.textContent = 'Valider';
      editBtnIcon.classList.remove('icon-edit');
      editBtnIcon.classList.add('icon-ok');
      isEditing = true;
    }
  });

  cancelBasicInfo.addEventListener('click', () => {
    isEditing= false;
    formSection.style.display = 'none';
    cancelBasicInfo.style.display = 'none';
    displaySection.style.display = 'block';
    editButtonText.textContent = '';
    editBtnIcon.classList.remove('icon-ok');
    editBtnIcon.classList.add('icon-edit');
  });

  function toggleEditState(button) {
    const icon = button.querySelector('i');
    icon.classList.toggle('icon-plus');
    icon.classList.toggle('icon-remove');
    button.classList.toggle('buttons-color');
    button.classList.toggle('cancel-button-color');
  }

  expEdit.addEventListener('click', () => toggleEditState(expEdit));
  eduEdit.addEventListener('click', () => toggleEditState(eduEdit));
  skillEdit.addEventListener('click', () => toggleEditState(skillEdit));

  document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById("image");
    const form = document.getElementById("form");

    if (imageInput && form) {
      imageInput.onchange = function () {
        console.log("submit triggered");
        form.submit();
      };
    }
  });

  function toggleForm(formId) {
    const form = document.getElementById(formId);
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
  }

document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("adresse");
    const suggestions = document.getElementById("suggestions");

    input.addEventListener("input", () => {
        const query = input.value.trim();
        if (query.length < 3) {
            suggestions.innerHTML = "";
            return;
        }

        fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}&limit=5`)
            .then(res => res.json())
            .then(data => {
                suggestions.innerHTML = "";
                if (data.features && data.features.length > 0) {
                    data.features.forEach(feature => {
                        const li = document.createElement("li");
                        li.textContent = feature.properties.label;
                        li.style.cursor = "pointer";
                        li.style.padding = "8px";
                        li.addEventListener("click", () => {
                            input.value = feature.properties.label;
                            suggestions.innerHTML = "";
                        });
                        suggestions.appendChild(li);
                    });
                } else {
                    suggestions.innerHTML = "<li style='padding: 8px; color: #999;'>Aucune adresse trouvée</li>";
                }
            })
            .catch(err => {
                console.error("Erreur API:", err);
            });
    });

    document.addEventListener("click", (e) => {
        if (!suggestions.contains(e.target) && e.target !== input) {
            suggestions.innerHTML = "";
        }
    });
});
</script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

</body>
</html>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/Layout/footer.php"; ?>