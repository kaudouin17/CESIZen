<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajouter un article</h2>

    <form action="<?= site_url('/admin/informations/store') ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Résumé</label>
            <textarea name="summary" class="form-control" rows="2" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Contenu</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">URL de l’image (optionnel)</label>
            <input type="text" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Ajouter l’article</button>
        <a href="<?= site_url('/admin/informations') ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?= $this->endSection() ?>
