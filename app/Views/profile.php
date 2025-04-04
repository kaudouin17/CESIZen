<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex" style="min-height: 70vh;">
    <!-- MENU LATÉRAL -->
    <div class="sidebar pe-4" style="border-right: 1px solid #ddd;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-section="profile"><i class="fas fa-user"></i> Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-section="info"><i class="fas fa-info-circle"></i> Informations</a>
            </li>
        </ul>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="flex-grow-1 ps-4">
        <!-- Onglet Profil -->
        <div id="profile" class="section">
            <h5 class="mb-4 text-success text-center">🧘‍♂️ Temps total par exercice</h5>
            <div class="row text-center justify-content-center">
                <?php
                $couleurs = ['7-4-8' => '🟢', '5-5' => '🔵', '4-6' => '🟡'];
                foreach (['7-4-8', '5-5', '4-6'] as $type): ?>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 h-100">
                            <h6 class="fw-bold mb-2"><?= $couleurs[$type] ?? '' ?> <?= esc($type) ?></h6>
                            <?php if (isset($sessionsParType[$type])): ?>
                                <?php
                                $h = $sessionsParType[$type]['hours'] ?? 0;
                                $m = $sessionsParType[$type]['minutes'];
                                $s = $sessionsParType[$type]['seconds'];

                                if ($h >= 1) {
                                    echo "<span class='text-muted'>{$h} h" . ($m > 0 ? " {$m} min" : "") . "</span>";
                                } elseif ($m >= 10) {
                                    echo "<span class='text-muted'>{$m} min</span>";
                                } else {
                                    echo "<span class='text-muted'>{$m} min {$s} sec</span>";
                                }
                                ?>
                            <?php else: ?>
                                <span class="text-muted">0 min</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Onglet Informations -->
        <div id="info" class="section d-none">
            <h2 class="text-success text-center">Informations</h2>
            <p><strong>Nom d'utilisateur :</strong><br><?= esc(session()->get('username')) ?></p>
            <p><strong>Email :</strong><br><?= esc(session()->get('user_email')) ?></p>

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
            const toastEl = document.getElementById('successToast');
            const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
            toast.show();

            // Sécurité en plus : on le ferme après 5s
            setTimeout(() => toast.hide(), 5000);
        });
    </script>
<?php endif; ?>

<!-- SCRIPT ONGLET -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll(".sidebar .nav-link");
        const sections = document.querySelectorAll(".section");

        links.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();

                links.forEach(l => l.classList.remove("active"));
                sections.forEach(sec => sec.classList.add("d-none"));

                this.classList.add("active");
                const sectionId = this.getAttribute("data-section");
                document.getElementById(sectionId).classList.remove("d-none");
            });
        });

        // Affiche la section "profil" au démarrage
        document.querySelector('[data-section="profile"]').click();
    });
</script>

<!-- STYLES -->
<style>
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
