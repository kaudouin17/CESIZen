<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2 class="text-center">Inscription</h2>
    <p class="text-center">Créez un compte pour accéder aux outils de bien-être.</p>

    <form action="<?= base_url('auth/register') ?>" method="post" class="mt-4">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </div>
    </form>

    <p class="text-center mt-3">
        Déjà un compte ? <a href="<?= base_url('login') ?>">Connectez-vous</a>
    </p>
<?= $this->endSection() ?>
