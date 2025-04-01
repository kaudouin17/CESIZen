<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Gestion des articles</h2>
        <a href="<?= site_url('/admin/informations/create') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Ajouter un article
        </a>
    </div>

    <!-- Formulaire de recherche -->
    <form method="GET" action="<?= site_url('/admin/informations') ?>" class="mb-4 d-flex align-items-center gap-2">
        <input type="text" name="search" class="form-control" placeholder="Rechercher un article..."
               value="<?= esc($search ?? '') ?>">
    </form>

    <!-- Conteneur dynamique -->
    <div id="articlesTableContainer">
        <?= $this->include('admin/informations_table') ?>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.querySelector("[name='search']");

        searchInput.addEventListener("input", function () {
            const search = encodeURIComponent(this.value);
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "<?= site_url('/admin/informations/filter') ?>?search=" + search, true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.querySelector("#articlesTableContainer").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    });
</script>
<?= $this->endSection() ?>
