<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Gestion des utilisateurs</h2>
        <a href="<?= site_url('/admin/users/create') ?>" class="btn btn-success">
            <i class="fas fa-user-plus"></i> Ajouter un utilisateur
        </a>
    </div>


    <!-- Formulaire de recherche et filtrage -->
    <form method="GET" action="<?= site_url('/admin/users') ?>" class="mb-4 d-flex align-items-center gap-2">
        <input type="text" name="search" class="form-control" placeholder="Rechercher un utilisateur..."
            value="<?= esc($search ?? '') ?>">

        <select name="role" class="form-select">
            <option value="">Tous les rôles</option>
            <option value="admin" <?= isset($role) && $role == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="user" <?= isset($role) && $role == 'user' ? 'selected' : '' ?>>Utilisateur</option>
        </select>

        <select name="status" class="form-select">
            <option value="">Tous les statuts</option>
            <option value="active" <?= isset($status) && $status == 'active' ? 'selected' : '' ?>>Actif</option>
            <option value="inactive" <?= isset($status) && $status == 'inactive' ? 'selected' : '' ?>>Inactif</option>
        </select>
    </form>

    <!-- Conteneur du tableau -->
    <div id="usersTableContainer">
        <?= $this->include('admin/users_table') ?>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function filterUsers() {
            let search = document.querySelector("[name='search']").value;
            let role = document.querySelector("[name='role']").value;
            let status = document.querySelector("[name='status']").value;

            let xhr = new XMLHttpRequest();
            xhr.open("GET", "<?= site_url('/admin/users/filter') ?>?search=" + encodeURIComponent(search) + "&role=" + encodeURIComponent(role) + "&status=" + encodeURIComponent(status), true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.querySelector("#usersTableContainer").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Ajout des écouteurs d'événements sur les champs de filtrage
        document.querySelector("[name='search']").addEventListener("input", filterUsers);
        document.querySelector("[name='role']").addEventListener("change", filterUsers);
        document.querySelector("[name='status']").addEventListener("change", filterUsers);
    });
</script>

<?= $this->endSection() ?>