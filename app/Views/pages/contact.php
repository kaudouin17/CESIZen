<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <h2>Contact</h2>
    <form method="post" action="#">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
</div>
<?= $this->endSection() ?>
