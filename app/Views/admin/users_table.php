<div class="table-responsive">
    <table class="table table-hover table-striped shadow-sm">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th class="text-end">Actions</th> <!-- Colonne actions vide pour alignement -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['is_admin'] ? 'Admin' : 'Utilisateur'; ?></td>
                    <td>
                        <a href="<?= site_url('/admin/users/toggle/' . $user['id']); ?>"
                            class="btn btn-sm <?= $user['is_active'] ? 'btn-success' : 'btn-danger' ?>">
                            <i class="fas <?= $user['is_active'] ? 'fa-check-circle' : 'fa-times-circle' ?>"></i>
                            <?= $user['is_active'] ? ' Actif' : ' Inactif'; ?>
                        </a>

                    </td>
                    <td class="text-end">
                        <a href="<?= site_url('/admin/users/edit/' . $user['id']); ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="<?= site_url('/admin/users/delete/' . $user['id']); ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function filterUsers() {
                let search = document.getElementById("search").value;
                let role = document.getElementById("role").value;
                let status = document.getElementById("status").value;

                let xhr = new XMLHttpRequest();
                xhr.open("GET", "<?= site_url('/admin/users/filter') ?>?search=" + search + "&role=" + role + "&status=" + status, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(xhr.responseText, "text/html");
                        let newTableBody = doc.querySelector("tbody").innerHTML;
                        document.querySelector("tbody").innerHTML = newTableBody;
                    }
                };
                xhr.send();
            }

            document.getElementById("search").addEventListener("input", filterUsers);
            document.getElementById("role").addEventListener("change", filterUsers);
            document.getElementById("status").addEventListener("change", filterUsers);
        });
    </script>
</div>