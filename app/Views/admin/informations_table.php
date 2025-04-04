<table class="table table-hover">
    <thead class="table-success">
        <tr>
            <th>Id</th>
            <th>Titre</th>
            <th>Résumé</th>
            <th>Date</th>
            <th style="width: 160px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= esc($article['id']) ?></td>
                <td><?= esc($article['title']) ?></td>
                <td><?= esc($article['summary']) ?></td>
                <td><?= date('d/m/Y', strtotime($article['created_at'])) ?></td>
                <td class="text-end">
                    <a href="<?= site_url('/admin/users/edit/' . $article['id']); ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="<?= site_url('/admin/users/delete/' . $article['id']); ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
