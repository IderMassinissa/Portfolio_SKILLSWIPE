<h2>Liste des plaintes</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>plaintes n :</th>
            <th>utilisateur</th>
            <th>titre</th>
            <th>description</th>
            <th>image</th>
            <th>date</th>
            <th>supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($complaints as $complaint): ?>
            <tr>
                <td><?= htmlspecialchars($complaint['id']) ?></td>
                <td><?= htmlspecialchars($complaint['name']) ?></td>
                <td><?= htmlspecialchars($complaint['title']) ?></td>
                <td><?= htmlspecialchars($complaint['description']) ?></td>
                
                <td>
                    <?php if (!empty($complaint['image_path'])): ?>
                        <img src="<?= htmlspecialchars($complaint['image_path']) ?>" alt="preuveenimagemtnnnnpwwwwxnjsnx" style="max-width: 100px;">
                    <?php else: ?>
                        r
                    <?php endif; ?>
                </td>

                <td><?= htmlspecialchars($complaint['created_at']) ?></td>

                <td>
                    <a href="/complaint_delete?id=<?= $complaint['id'] ?>" class="cta-button" onclick="return confirm('cette plainte a bien été traitée ?')">X</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
