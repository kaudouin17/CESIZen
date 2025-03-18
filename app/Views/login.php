<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center"><i class="fas fa-sign-in-alt"></i> Connexion</h3>
        <form action="<?= base_url('auth/processLogin') ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">
                <i class="fas fa-arrow-right"></i> Se connecter
            </button>
        </form>
        <div class="text-center mt-3">
            <p>Pas encore de compte ? <a href="<?= base_url('register') ?>">Inscrivez-vous</a></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
