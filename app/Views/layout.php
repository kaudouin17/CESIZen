<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESIZen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #e3f2fd, #ffffff);
            color: #2c3e50;
        }
        .navbar {
            background: #4A90E2 !important;
        }
        .container {
            max-width: 800px;
        }
        h1 {
            font-weight: 600;
        }
        .btn-primary {
            background: #4A90E2;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #357ABD;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">CESIZen</a>
        </div>
    </nav>

    <div class="container mt-5 text-center">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
