<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h2 class="text-center">Bienvenue sur votre espace CESIZen</h2>
    <p class="text-center">Vous êtes connecté en tant que <b><?= session('user_email') ?></b></p>

    <div class="text-center mt-4">
        <a href="<?= base_url('logout') ?>" class="btn btn-danger">Se déconnecter</a>
    </div>
<?= $this->endSection() ?>
