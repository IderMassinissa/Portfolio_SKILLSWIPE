



<form method="POST" enctype="multipart/form-data" action="/complaint_send">

  <h2>formulaire de plainte</h2>

  <label>l'objet de votre plainte :</label>
  <input type="text" name="title" required><br><br>

  <label>Description ?</label>
  <textarea name="description"></textarea><br><br>

  <label>veuillez inserer une image comme preuve :</label>
  <input type="file" name="image" accept="image/*"><br>
  <button type="submit">Envoyer</button>
</form>
