<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESIZen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('css/style_pro.css') ?>">
</head>

<body class="bg-light">

    <div class="navbar-wrapper d-flex justify-content-between align-items-center">
        <!-- Bloc logo -->
        <div class="navbar-box d-flex align-items-center justify-content-center">
            <a href="<?= base_url() ?>">
                <img src="<?= base_url('logo.png') ?>" alt="CESIZen Logo" style="height: 40px;">
            </a>
        </div>

        <!-- Bloc navbar -->
        <div class="navbar-box">
            <nav class="navbar navbar-expand-lg justify-content-center">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/informations') ?>"><i class="fas fa-newspaper"></i> Informations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/exercises') ?>"><i class="fas fa-wind"></i> Exercices</a>
                    </li>

                    <?php if (session()->get('is_admin')) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-cogs"></i> Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= site_url('/admin') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('/admin/users') ?>"><i class="fas fa-users"></i> Utilisateurs</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('/admin/informations') ?>"><i class="fas fa-newspaper"></i> Informations</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <!-- Bloc profil -->
        <div class="navbar-box d-flex align-items-center justify-content-center">
            <div class="dropdown profile-dropdown">
                <a class="nav-link dropdown-toggle profile-container" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                    <img src="<?= base_url('avatars/' . (session()->get('avatar') ?? 'default.png')) ?>" class="rounded-circle" width="40" height="40">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <li><a class="dropdown-item" href="<?= site_url('/profile') ?>"><i class="fas fa-user"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('/logout') ?>"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                    <?php else : ?>
                        <li><a class="dropdown-item" href="<?= site_url('/login') ?>">Se connecter</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('/register') ?>">S'inscrire</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <main class="main-content container mt-5 content">
        <?= $this->renderSection('content') ?>
    </main>


    <footer class="footer text-center">
        <p>&copy; <?= date('Y') ?> CESIZen - Tous droits réservés. |
            <a href="<?= base_url('/mentions-legales') ?>">Mentions Légales</a> |
            <a href="<?= base_url('/contact') ?>">Contact</a> |
            <a href="<?= base_url('/a-propos') ?>">À propos</a>
        </p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>