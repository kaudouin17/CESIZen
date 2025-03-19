<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<style>
    /* Style du menu latéral */
    .sidebar {
        width: 60px;
        height: calc(100vh - 56px); /* 100% de la hauteur - hauteur de la navbar */
        position: fixed;
        left: 0;
        top: 56px; /* Décalage sous la navbar */
        background-color: #2BA84A;
        transition: width 0.3s;
        overflow: hidden;
        white-space: nowrap;
        z-index: 1000;
    }

    .sidebar:hover {
        width: 200px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        padding: 15px;
    }

    .sidebar i {
        font-size: 20px;
        width: 30px;
        text-align: center;
    }

    .sidebar span {
        opacity: 0;
        transition: opacity 0.3s;
        margin-left: 10px;
    }

    .sidebar:hover span {
        opacity: 1;
    }

    /* Contenu principal */
    .content {
        margin-left: 60px;
        padding: 20px;
        transition: margin-left 0.3s;
    }

    .sidebar:hover + .content {
        margin-left: 200px;
    }
</style>

<div class="d-flex">
    <!-- Menu latéral -->
    <div class="sidebar">
        <a href="<?= site_url('/admin/users') ?>">
            <i class="fas fa-users"></i><span> Utilisateurs</span>
        </a>
        <a href="<?= site_url('/admin/informations') ?>">
            <i class="fas fa-newspaper"></i><span> Informations</span>
        </a>
        <a href="<?= site_url('/admin/exercises') ?>">
            <i class="fas fa-wind"></i><span> Exercices</span>
        </a>
        <a href="<?= site_url('/admin/settings') ?>">
            <i class="fas fa-cog"></i><span> Paramètres</span>
        </a>
    </div>

    <!-- Contenu principal -->
    <div class="content">
        <h1>Tableau de Bord Administrateur</h1>
        <p>Bienvenue <?= session()->get('username'); ?>, vous êtes administrateur.</p>
    </div>
</div>

<?= $this->endSection() ?>
