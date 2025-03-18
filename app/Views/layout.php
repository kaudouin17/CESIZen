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
            /* Fond clair */
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #2ca058;
            /* Vert du logo */
        }

        .navbar-brand {
            font-weight: bold;
            color: white;
        }

        .navbar-brand:hover {
            color: #ffcc00;
            /* Jaune du logo */
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
            /* Jaune du logo */
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg" style="background-color: #2BA84A;">
        <div class="container">
            <a class="navbar-brand text-white d-flex align-items-center" href="<?= base_url() ?>">
                <img src="<?= base_url('logo.png') ?>" alt="CESIZen Logo" class="me-2" style="height: 40px;">
            </a>
            <div class="ml-auto">
                <?php $uri = service('uri')->getSegment(1); ?>

                <?php if ($uri !== 'login'): ?>
                    <a href="<?= base_url('/login') ?>" class="btn btn-light">Connexion</a>
                <?php endif; ?>

                <?php if ($uri !== 'register'): ?>
                    <a href="<?= base_url('/register') ?>" class="btn btn-warning">S'inscrire</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>