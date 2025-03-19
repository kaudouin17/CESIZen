<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESIZen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f4e1;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #2ca058;
        }

        .navbar-brand {
            font-weight: bold;
            color: white;
        }

        .navbar-brand:hover {
            color: #ffcc00;
        }

        .auth-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .home-container {
            position: relative;
            background: url('https://source.unsplash.com/1600x900/?zen,nature') no-repeat center center/cover;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }

        .home-content {
            position: relative;
            z-index: 2;
        }

        .brand {
            color: #ffcc00;
            font-weight: bold;
        }

        html,
        body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        .footer {
            background-color: #2BA84A;
            color: white;
            padding: 5px 0;
            text-align: center;
            font-size: 14px;
            width: 100%;
        }

        .footer p {
            margin: 0;
            padding: 2px 0;
        }

        .footer a {
            text-decoration: none;
            font-weight: bold;
            color: white;
            font-size: 13px;
        }

        .footer a:hover {
            text-decoration: underline;
            color: #FFD700;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg" style="background-color: #2BA84A;">
        <div class="container">
            <a class="navbar-brand text-white d-flex align-items-center" href="<?= base_url() ?>">
                <img src="<?= base_url('logo.png') ?>" alt="CESIZen Logo" class="me-2" style="height: 40px;">
            </a>
            <div class="ml-auto d-flex align-items-center">
                <?php if (session()->get('isLoggedIn')) : ?>
                    <span class="text-white me-3">Bienvenue, <?= session()->get('username'); ?></span>

                    <?php if (session()->get('is_admin')) : ?>
            <a class="btn btn-primary me-2" href="<?= site_url('/admin') ?>">Admin</a>
        <?php endif; ?>

                    <a class="btn btn-danger" href="<?= site_url('/logout') ?>">Déconnexion</a>
                <?php else : ?>
                    <?php $uri = service('uri')->getSegment(1); ?>
                    <?php if ($uri !== 'login') : ?>
                        <a href="<?= base_url('/login') ?>" class="btn btn-light me-2">Connexion</a>
                    <?php endif; ?>
                    <?php if ($uri !== 'register') : ?>
                        <a href="<?= base_url('/register') ?>" class="btn btn-warning">S'inscrire</a>
                    <?php endif; ?>
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