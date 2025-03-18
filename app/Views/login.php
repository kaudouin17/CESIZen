<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2 class="text-center">Connexion</h2>
    <p class="text-center">Connectez-vous pour accéder à votre espace personnel.</p>

    <form action="<?= base_url('auth/processLogin') ?>" method="post" class="mt-4">
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="email" class="form-label">Adresse e-mail</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>
</form>


    <p class="text-center mt-3">
        Pas encore de compte ? <a href="<?= base_url('register') ?>">Inscrivez-vous</a>
    </p>
<?= $this->endSection() ?>
