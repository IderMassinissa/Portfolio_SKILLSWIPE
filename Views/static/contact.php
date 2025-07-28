<main class="page-wrapper">
    <h1>Contactez-nous</h1>

    <p>Une question ? Une suggestion ? Un bug à signaler ? Écrivez-nous !</p>

    <form method="post" action="#" class="contact-form">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Adresse email :</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="6" required></textarea>

        <button type="submit" class="btn btn-submit">Envoyer</button>
    </form>
</main>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Views/layout/footer.php";
?>