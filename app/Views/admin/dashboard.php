<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<!-- Contenu principal -->
<div class="content">
    <h1>Tableau de Bord Administrateur</h1>
    <p>Bienvenue <?= session()->get('username'); ?>, vous êtes administrateur.</p>
</div>
</div>

<?= $this->endSection() ?>