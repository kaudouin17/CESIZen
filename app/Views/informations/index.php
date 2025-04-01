<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Articles autour de la santé mentale</h2>

    <div class="d-flex flex-column align-items-center gap-4">
        <?php foreach ($articles as $article): ?>
            <div class="card shadow-sm w-100" style="max-width: 800px;">
                <?php if ($article['image']): ?>
                    <img src="<?= $article['image'] ?>" class="card-img-top" alt="<?= esc($article['title']) ?>" style="height: 250px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= esc($article['title']) ?></h5>
                    <p class="card-text"><?= esc($article['summary']) ?></p>
                    <a href="<?= site_url('/informations/' . $article['id']) ?>" class="btn btn-outline-success">Lire plus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
