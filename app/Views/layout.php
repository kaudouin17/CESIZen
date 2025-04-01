<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESIZen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f4e1;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background-color: #2BA84A !important;
            padding: 10px 0;
            position: relative;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: bold;
            color: white;
        }

        .navbar-brand:hover {
            color: #ffcc00;
        }

        /* Centrage parfait */
        .navbar-nav {
            display: flex !important;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }


        .nav-item {
            margin: 0 5px;
        }

        .nav-link {
            color: white !important;
            font-weight: bold;
            padding: 8px 15px;
        }

        .navbar-nav .nav-link:hover {
            background-color: transparent !important;
            color: #FFD700 !important;
        }



        /* Menu Profil */
        .profile-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid white;
        }

        /* Ajustement du dropdown */
        .profile-dropdown .dropdown-menu {
            min-width: 160px;
            text-align: center;
            border-radius: 10px;
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            background-color: #f1f1f1 !important;
            color: black !important;
        }

        /* Footer ultra-fin */
        .footer {
            background-color: #2BA84A;
            color: white;
            padding: 3px 0;
            text-align: center;
            font-size: 12px;
            width: 100%;
            margin-top: auto;
        }

        .footer a {
            text-decoration: none;
            font-weight: bold;
            color: white;
            font-size: 12px;
        }

        .footer a:hover {
            text-decoration: underline;
            color: #FFD700;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a class="navbar-brand text-white d-flex align-items-center" href="<?= base_url() ?>">
                <img src="<?= base_url('logo.png') ?>" alt="CESIZen Logo" class="me-2" style="height: 40px;">
            </a>

            <!-- ... reste du code identique ... -->

            <!-- Liens de navigation centrés -->
            <div class="d-flex justify-content-center flex-grow-1">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/informations') ?>"><i class="fas fa-newspaper"></i> Informations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/exercises') ?>"><i class="fas fa-wind"></i> Exercices</a>
                    </li>

                    <?php if (session()->get('is_admin')) : ?>
                        <!-- Menu déroulant Admin -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-cogs"></i> Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= site_url('/admin') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('/admin/users') ?>"><i class="fas fa-users"></i> Utilisateurs</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('/admin/informations') ?>"><i class="fas fa-newspaper"></i> Informations</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('/admin/exercises') ?>"><i class="fas fa-wind"></i> Exercices</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Menu de profil avec image -->
            <div class="nav-buttons">
                <div class="dropdown profile-dropdown">
                    <a class="nav-link dropdown-toggle profile-container" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="<?= base_url('avatars/' . (session()->get('avatar') ?? 'default.png')) ?>" class="rounded-circle" width="40" height="40">
                    </a>

                    <!-- Contenu du menu déroulant -->
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
    </nav>

    <div class="container mt-5 content">
        <?= $this->renderSection('content') ?>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p>&copy; <?= date('Y') ?> CESIZen - Tous droits réservés. |
                <a href="<?= base_url('/mentions-legales') ?>">Mentions Légales</a> |
                <a href="<?= base_url('/contact') ?>">Contact</a> |
                <a href="<?= base_url('/a-propos') ?>">À propos</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>