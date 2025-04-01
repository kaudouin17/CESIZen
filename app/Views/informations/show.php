<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5" style="max-width: 800px;">
    <!-- Titre -->
    <h1 class="mb-4 text-center fw-bold"><?= esc($article['title']) ?></h1>

    <!-- Image principale -->
    <?php if ($article['image']): ?>
        <div class="text-center mb-4">
            <img src="<?= esc($article['image']) ?>" class="img-fluid rounded shadow-sm" alt="<?= esc($article['title']) ?>" style="max-height: 400px; object-fit: cover;">
        </div>
    <?php endif; ?>

    <!-- Contenu de l'article -->
    <div class="article-content mb-5" style="line-height: 1.8; font-size: 1.1rem;">
        <?= nl2br(esc($article['content'])) ?>
    </div>

    <!-- Bouton de retour -->
    <div class="text-center">
        <a href="<?= site_url('/informations') ?>" class="btn btn-outline-success">
            ← Retour aux articles
        </a>
    </div>
</div>

<style>
    .article-content::first-letter {
        font-size: 1.5em;
        font-weight: bold;
    }
</style>
<?= $this->endSection() ?>
