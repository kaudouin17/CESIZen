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
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .nav-item {
            margin: 0 5px;
        }

        .nav-link {
            color: white !important;
            font-weight: bold;
            padding: 8px 15px;
        }

        .nav-link:hover {
            color: #FFD700 !important;
        }

        /* Boutons à droite */
        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
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

        .dropdown-item:focus,
        .dropdown-item:hover {
            background-color: #f1f1f1 !important;
            /* Gris clair */
            color: black !important;
        }

        .btn-action {
            width: 110px;
            /* Ajuste selon tes besoins */
            text-align: center;
            white-space: nowrap;
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

            <!-- Liens de navigation centrés -->
            <div class="d-flex justify-content-center w-100">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/profile') ?>"><i class="fas fa-user"></i> Profil</a>
                    </li>
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
                                <li><a class="dropdown-item" href="<?= site_url('/admin/exercises') ?>"><i class="fas fa-wind"></i> Exercices</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Boutons Connexion / Déconnexion -->
            <div class="nav-buttons">
                <?php if (session()->get('isLoggedIn')) : ?>
                    <span class="text-white me-2">Bienvenue, <?= session()->get('username'); ?></span>
                    <a class="btn btn-danger" href="<?= site_url('/logout') ?>">Déconnexion</a>
                <?php else : ?>
                    <a href="<?= base_url('/login') ?>" class="btn btn-light">Connexion</a>
                    <a href="<?= base_url('/register') ?>" class="btn btn-warning">S'inscrire</a>
                <?php endif; ?>
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