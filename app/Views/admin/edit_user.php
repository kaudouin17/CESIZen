<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Modifier l'utilisateur</h2>
    
    <form action="<?= site_url('/admin/users/update/' . $user['id']) ?>" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe (laisser vide pour ne pas modifier)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" <?= $user['is_admin'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="is_admin">
                Administrateur
            </label>
        </div>

        <button type="submit" class="btn btn-success mt-3">Enregistrer les modifications</button>
        <a href="<?= site_url('/admin/users') ?>" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
<?= $this->endSection() ?>
