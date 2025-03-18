<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <h1 class="text-center">Bienvenue sur CESIZen</h1>
    <p class="text-center">Votre plateforme pour la gestion du stress et du bien-être mental.</p>
    <div class="text-center mt-4">
        <a href="<?= base_url('login') ?>" class="btn btn-primary">Se connecter</a>
    </div>
<?= $this->endSection() ?>
