<div class="table-scroll">
    <table class="user-table">
        <thead class="user-table__header">
        <tr class="user-table__row">
            <th class="user-table__cell user-table__cell--header">ID</th>
            <th class="user-table__cell user-table__cell--header">Email</th>
            <th class="user-table__cell user-table__cell--header">Foto Perfil</th>
            <th class="user-table__cell user-table__cell--header">Rol</th>
            <th class="user-table__cell user-table__cell--header">Mas</th>
        </tr>
        </thead>
        <tbody class="user-table__body">
        <?php foreach ($usuarios as $usuario): ?>
            <tr class="user-table__row">
                <td class="user-table__cell"><?php echo htmlspecialchars($usuario['id']); ?></td>
                <td class="user-table__cell"><?php echo htmlspecialchars($usuario['email']); ?></td>
                <td class="user-table__cell">
                    <figure class="user-table__cell-figure">
                        <img src="<?php echo htmlspecialchars($usuario['fotoPerfil']); ?>" alt="Foto de perfil" class="user-table__profile-picture">
                    </figure>
                </td>
                <td class="user-table__cell"><?php echo htmlspecialchars($usuario['rol']); ?></td>
                <td class="user-table__cell">
                    <div class="user-table__cell-actions">
                        <button class="user-table__delete-button" onclick="openModal('delete', <?php echo $usuario['id']; ?>)">
                            <i class="fa-solid fa-trash-can"></i>
                            <span>Eliminar</span>
                        </button>
                        <button class="user-table__edit-button" onclick="openModal('edit', <?php echo $usuario['id']; ?>)">
                            <i class="fa-solid fa-pencil"></i>
                            <span>Editar</span>
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function openModal(action, id) {
        const modal = document.getElementById('userModal');
        const modalContent = document.getElementById('modalContent');
        fetch(`../Componentes/administrador/modal_usuario.php?action=${action}&id=${id}`)
            .then(response => response.text())
            .then(data => {
                modalContent.innerHTML = `<span class="close" onclick="closeModal()">&times;</span>` + data;
                modal.style.display = 'block';
            });
    }

    function closeModal() {
        document.getElementById('userModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('userModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>