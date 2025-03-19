<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="text-center py-5" style="background-color: #FAF5E4; border-radius: 15px;">
    <h1 class="fw-bold text-dark">Bienvenue sur</h1>
    <div class="text-center">
        <img src="<?= base_url('logo.png') ?>" alt="CESIZen Logo" class="img-fluid" style="max-width: 200px;">
    </div>
    <p class="text-muted">Découvrez une application qui prend soin de votre bien-être mental.</p>
</div>


<?= $this->endSection() ?>