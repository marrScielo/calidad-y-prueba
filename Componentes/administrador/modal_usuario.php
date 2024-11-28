<?php
require_once __DIR__ . '/../../Controlador/UsuariosController.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($action && $id) {
    $usuariosController = new UsuariosController();
    $usuario = $usuariosController->buscarPorId($id);

    if ($action == 'edit') {
        ?>
        <h2>Editar Usuario</h2>
        <form id="editUserForm">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            <label for="rol">Rol:</label>
            <input type="text" name="rol" value="<?php echo htmlspecialchars($usuario['rol']); ?>" required>
            <!-- Add other fields as necessary -->
            <button type="submit">Guardar Cambios</button>
        </form>
        <script>
            document.getElementById('editUserForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('../Controlador/UsuariosController.php', {
                    method: 'POST',
                    body: formData
                }).then(response => response.text())
                  .then(data => {
                      // Handle response
                      closeModal();
                  });
            });
        </script>
        <?php
    } elseif ($action == 'delete') {
        ?>
        <div id="deleteUserModal">
            <h2>Confirmar Eliminación</h2>
            <p>¿Estás seguro de que deseas eliminar al usuario con ID <?php echo htmlspecialchars($usuario['id']); ?>?</p>
            <button class="confirm-button" onclick="confirmDelete(<?php echo $usuario['id']; ?>)">Confirmar</button>
            <button class="cancel-button" onclick="closeModal()">Cancelar</button>
        </div>
        <script>
            function confirmDelete(id) {
                fetch(`../Controlador/UsuariosController.php?action=delete&id=${id}`, {
                    method: 'POST'
                }).then(response => response.text())
                  .then(data => {
                      // Handle response
                      closeModal();
                  });
            }
        </script>
        <?php
    }
} else {
    echo "";
}
?>