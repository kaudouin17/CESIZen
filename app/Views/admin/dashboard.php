<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="text-center text-success mb-5 fw-bold">Tableau de Bord Administrateur</h1>

    <div class="row text-center justify-content-center mb-5">
        <!-- Carte Utilisateurs -->
        <div class="col-md-3 mb-3">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="text-success fw-bold">👤 Utilisateurs</h5>
                    <p class="mb-3">Nombre total : <strong><?= esc($totalUsers) ?></strong></p>
                </div>
                <a href="<?= site_url('/admin/users') ?>" class="btn btn-outline-success btn-sm mt-auto rounded-pill">Voir</a>
            </div>
        </div>

        <!-- Carte Exercices -->
        <div class="col-md-3 mb-3">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="text-success fw-bold">🧘 Exercices</h5>
                    <p class="mb-3">Aujourd'hui : <strong><?= esc($totalExercisesToday) ?></strong></p>
                </div>
            </div>
        </div>

        <!-- Carte Article -->
        <div class="col-md-3 mb-3">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="text-success fw-bold">📰 Dernier article</h5>
                    <p class="mb-3"><strong><?= esc($lastArticle) ?></strong></p>
                </div>
                <a href="<?= site_url('/admin/informations') ?>" class="btn btn-outline-success btn-sm mt-auto rounded-pill">Voir</a>
            </div>
        </div>
    </div>

    <!-- GRAPHIQUES -->
    <div class="row justify-content-center">
        <!-- Graphique barres -->
        <div class="col-md-6 mb-4">
            <div class="bg-white p-4 rounded-4 shadow-sm" style="height: 360px;">
                <h5 class="fw-bold text-center mb-3 text-success">📊 Exercices par type</h5>
                <div style="height: 280px; position: relative;">
                    <canvas id="exerciseChart" style="max-height: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique camembert -->
        <div class="col-md-6 mb-4">
            <div class="bg-white p-4 rounded-4 shadow-sm" style="height: 360px;">
                <h5 class="fw-bold text-center mb-3 text-success">👥 Utilisateurs actifs/inactifs</h5>
                <div style="height: 280px; position: relative;">
                    <canvas id="usersPie" style="max-height: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique barres
    const exerciseCtx = document.getElementById('exerciseChart').getContext('2d');
    new Chart(exerciseCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($exerciseTypes)) ?>,
            datasets: [{
                label: 'Nombre de sessions',
                data: <?= json_encode(array_values($exerciseTypes)) ?>,
                backgroundColor: 'rgba(43, 168, 74, 0.4)',
                borderColor: '#2BA84A',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: true } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Graphique camembert
    const userPieCtx = document.getElementById('usersPie').getContext('2d');
    new Chart(userPieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Actifs', 'Inactifs'],
            datasets: [{
                data: [<?= $activeUsers ?>, <?= $inactiveUsers ?>],
                backgroundColor: ['#2BA84A', '#FFD700'],
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>
