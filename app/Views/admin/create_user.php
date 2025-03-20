<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Ajouter un utilisateur</h2>
    
    <form method="POST" action="<?= site_url('/admin/users/store') ?>" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Nom d'utilisateur</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_admin" class="form-check-input" id="isAdminCheck">
            <label class="form-check-label" for="isAdminCheck">Administrateur</label>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="isActiveCheck" checked>
            <label class="form-check-label" for="isActiveCheck">Compte actif</label>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Enregistrer</button>
        <a href="<?= site_url('/admin/users') ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?= $this->endSection() ?>
