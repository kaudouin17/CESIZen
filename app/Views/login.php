<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center"><i class="fas fa-sign-in-alt"></i> Connexion</h3>
        <?= session()->getFlashdata('error') ? '<div class="alert alert-danger">' . session()->getFlashdata('error') . '</div>' : '' ?>
        <?= session()->getFlashdata('success') ? '<div class="alert alert-success">' . session()->getFlashdata('success') . '</div>' : '' ?>
        <form action="<?= base_url('auth/processLogin') ?>" method="post">
            <div class="mb-3">
                <label for="identifier" class="form-label"><i class="fas fa-user"></i> Nom d'utilisateur ou adresse e-mail</label>
                <input type="text" class="form-control" id="identifier" name="identifier" required>
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