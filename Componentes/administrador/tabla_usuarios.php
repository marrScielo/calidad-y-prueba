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
                        <figure class="user-table__cell-figure"><img src="<?php echo htmlspecialchars($usuario['fotoPerfil']); ?>" alt="Foto de perfil" class="user-table__profile-picture"></figure>
                    </td>
                    <td class="user-table__cell"><?php echo htmlspecialchars($usuario['rol']); ?></td>
                    <td class="user-table__cell">
                        <div class="user-table__cell--actions">
                            <button class="user-table__delete-button">
                                <i class="fa-solid fa-trash-can"></i>
                                <span>Eliminar</span>
                            </button>
                            <button class="user-table__edit-button">
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