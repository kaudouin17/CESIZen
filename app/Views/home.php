<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-center align-items-center py-5 px-3" style="min-height: 80vh;">
    <div class="text-center p-5 shadow" style="background-color: #FAF5E4; border-radius: 20px; max-width: 600px; width: 100%;">
        <h1 class="fw-bold text-dark mb-4" style="font-size: 2.5rem;">Bienvenue sur</h1>
        
        <div class="mb-4">
            <img src="<?= base_url('logo.png') ?>" alt="Logo CESIZen" class="img-fluid" style="max-width: 180px;">
        </div>
        
        <p class="text-muted fs-5">
            Découvrez une application qui prend soin de votre bien-être mental.
        </p>
        
        <a href="<?= base_url('/informations') ?>" class="btn mt-4 px-4 py-2" style="background-color: #2BA84A; color: white; border-radius: 30px;">
            Explorer
        </a>
    </div>
</div>

<?= $this->endSection() ?>
