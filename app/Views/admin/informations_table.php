<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle shadow-sm">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Résumé</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= esc($article['id']) ?></td>
                        <td><?= esc($article['title']) ?></td>
                        <td><?= esc($article['summary']) ?></td>
                        <td class="text-end">
                            <a href="<?= site_url('/admin/informations/edit/' . $article['id']) ?>" class="btn btn-warning btn-sm me-1">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="<?= site_url('/admin/informations/delete/' . $article['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Aucun article trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
