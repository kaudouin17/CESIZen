<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4 d-flex">
    <!-- MENU LATÉRAL -->
    <div class="sidebar bg-light p-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-section="profile"><i class="fas fa-user"></i> Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="info"><i class="fas fa-info-circle"></i> Informations</a>
            </li>
        </ul>
    </div>

    <!-- CONTENU DYNAMIQUE -->
    <div class="content p-4 w-100">
        <!-- Onglet Profil -->
        <div id="profile" class="section">
            <h2>Mon Profil</h2>
            <p><strong>Dernière connexion :</strong> <?= session()->get('last_login') ?: 'Non disponible'; ?></p>
            <p><strong>Nombre de sessions :</strong> <?= session()->get('session_count') ?: 0; ?></p>
        </div>

        <!-- Onglet Informations -->
        <div id="info" class="section d-none">
            <h2>Informations</h2>
            <div class="mb-3">
                <label class="form-label"><strong>Nom d'utilisateur :</strong></label>
                <p class="form-control-plaintext"><?= esc(session()->get('username')) ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Email :</strong></label>
                <p class="form-control-plaintext"><?= esc(session()->get('user_email')) ?></p>
            </div>

            <!-- BOUTONS MODERNES -->
            <div class="d-flex flex-wrap gap-2 mt-3">
                <button class="btn btn-outline-success d-flex align-items-center gap-2"
                    style="border-radius: 30px; font-weight: 500; padding: 10px 20px;"
                    data-bs-toggle="modal"
                    data-bs-target="#avatarModal">
                    <i class="fas fa-image"></i> Changer mon avatar
                </button>

                <a href="<?= site_url('/profile/edit') ?>"
                    class="btn btn-primary d-flex align-items-center gap-2"
                    style="border-radius: 30px; font-weight: 500; padding: 10px 20px;">
                    <i class="fas fa-pen"></i> Modifier mes informations
                </a>
            </div>
        </div>
    </div>
</div>

<!-- MODALE CHOIX D'AVATAR -->
<div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="avatarModalLabel">Choisir un avatar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <?php
                    $avatarDir = base_url('avatars/');
                    for ($i = 1; $i <= 12; $i++): ?>
                        <div class="col-3 mb-3">
                            <form method="post" action="<?= site_url('/profile/update-avatar') ?>">
                                <input type="hidden" name="avatar" value="avatar<?= $i ?>.png">
                                <button type="submit" class="border-0 bg-transparent">
                                    <img src="<?= $avatarDir . 'avatar' . $i . '.png' ?>" alt="Avatar <?= $i ?>" class="img-fluid rounded-circle border border-success" style="width: 80px; height: 80px;">
                                </button>
                            </form>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TOAST Bootstrap -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= session()->getFlashdata('success') ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const toast = new bootstrap.Toast(document.getElementById('successToast'));
            toast.show();
        });
    </script>
<?php endif; ?>

<!-- SCRIPT ONGLET -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll(".sidebar .nav-link");
        const sections = document.querySelectorAll(".section");

        links.forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault();

                links.forEach(l => l.classList.remove("active"));
                sections.forEach(sec => sec.classList.add("d-none"));

                this.classList.add("active");
                const sectionId = this.getAttribute("data-section");
                document.getElementById(sectionId).classList.remove("d-none");
            });
        });
    });
</script>

<style>
    .sidebar {
        width: 200px;
        min-height: 100vh;
        border-right: 1px solid #ddd;
        background-color: #f8f9fa;
    }

    .nav-link {
        color: #2BA84A !important;
        font-weight: bold;
        padding: 10px;
        border-radius: 5px;
        transition: background 0.3s, color 0.3s;
    }

    .nav-link.active {
        background-color: #2BA84A !important;
        color: white !important;
    }

    .nav-link:hover {
        background-color: rgba(43, 168, 74, 0.2) !important;
        color: #2BA84A !important;
    }

    .nav-link i {
        margin-right: 8px;
    }
</style>

<?= $this->endSection() ?>
