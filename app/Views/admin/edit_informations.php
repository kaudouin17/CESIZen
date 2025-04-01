<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="mb-4">Modifier l'article</h2>

    <form method="post" action="<?= site_url('/admin/informations/update/' . $article['id']) ?>">
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" class="form-control" value="<?= esc($article['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Résumé</label>
            <textarea name="summary" class="form-control" rows="2" required><?= esc($article['summary']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Contenu complet</label>
            <textarea name="content" class="form-control" rows="6" required><?= esc($article['content']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">URL de l'image</label>
            <input type="text" name="image" class="form-control" value="<?= esc($article['image']) ?>">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="<?= site_url('/admin/informations') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
