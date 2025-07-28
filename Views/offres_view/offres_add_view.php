<body>
    <div class="bodyoffer">
        <a href="/offer_list_recruiter" class="retour">← Retour</a><br>

        <h1>Ajouter une offre</h1>

        <?php if (!empty($error)): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="/add_offer">
            <label>Titre du poste :</label><br>
            <input type="text" name="title" required><br>

            <label>Description :</label><br>
            <textarea name="description" required></textarea><br>

            <label>Type de contrat :</label><br>
            <select name="contract_id" required>
                <option value="">-- Choisissez un type --</option>
                <option value="3">CDI</option>
                <option value="5">CDD</option>
                <option value="1">Alternance</option>
                <option value="2">Stage</option>
                <option value="4">Freelance</option>
            </select><br>

            <label>Mode de travail :</label><br>
            <select name="work_mode_id" required>
                <option value="">-- Sélectionner --</option>
                <option value="2">Présentiel</option>
                <option value="3">Télétravail</option>
                <option value="1">Hybride</option> 
            </select><br>

            <label>Entreprise :</label><br>
            <select name="company_id" required>
                <option value="<?= $entreprise["ID"] ?>"><?= $entreprise["Name"] ?></option>
            </select><br><br>

            <button type="submit">Créer l'offre</button>
        </form>
    </div>
</body>
</html>