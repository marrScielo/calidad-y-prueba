<?php
session_start();
if (isset($_SESSION['logeado'])) {
    require_once 'Controlador/UsuariosController.php';
    include_once 'Controlador/Psicologo/PsicologoController.php';
    include_once 'Controlador/EspecialidadesController.php';
    include_once 'Controlador/FileManagerController.php';
    $psicologoController = new PsicologoController();
    $especialidadesController = new EspecialidadController();
    $usuariosController = new UsuariosController();

    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'agregar':
                    $password = $_POST['password'];
                    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=]).{8,}$/';

                    if (!preg_match($pattern, $password)) {
                        $error = "La contraseña debe contener al menos una letra mayúscula, un símbolo, un número y tener al menos 8 caracteres.";
                        break;
                    }

                    $urlNewImage = $fileManager->uploadImage($_FILES['fotoPerfil']);

                    $result = $usuariosController->agregarUsuario(
                        $_POST['email'],
                        $password,
                        $urlNewImage,
                        $_POST['rol'],
                        $_POST['introduccion_new_user'],
                        $_POST['speciality_new_user'],
                        $_POST['nombrePsicologo'] ?? '',
                        $_POST['video'] ?? '',
                        $_POST['celular'] ?? ''
                    );

                    if ($result) {
                        $success = "Usuario agregado exitosamente.";
                    } else {
                        $error = "Error al agregar usuario.";
                    }
                    break;
                case 'actualizar':
                    $result = $usuariosController->actualizarUsuario(
                        $_POST['id'],
                        $_POST['email'],
                        $_POST['password'],
                        $_POST['fotoPerfil'],
                        $_POST['rol'],
                        $_POST['introduccion_user'],
                        $_POST['especialidad_user'],
                        $_POST['nombrePsicologo'] ?? '',
                        $_POST['video'] ?? '',
                        $_POST['celular'] ?? ''
                    );

                    if ($result) {
                        $success = "Usuario actualizado exitosamente.";
                    } else {
                        $error = "Error al actualizar usuario.";
                    }
                    break;
                case 'eliminar':
                    $result = $usuariosController->eliminarUsuario($_POST['id']);
                    if ($result) {
                        $success = "Usuario eliminado exitosamente.";
                    } else {
                        $error = "Error al eliminar usuario.";
                    }
                    break;
                case 'cerrar_sesion':
                    session_destroy();
                    header("Location: index.php");
                    exit();
                    break;
            }
        }
    }

    $emailBuscar = $_GET['email'] ?? '';
    $usuarios = !empty($emailBuscar) ? $usuariosController->buscarPorEmail($emailBuscar) : $usuariosController->mostrarUsuarios();
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Usuarios</title>
        <link rel="icon" href="img/favicon.png">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary-color: #4a90e2;
                --secondary-color: #50c878;
                --danger-color: #e74c3c;
                --background-color: #f5f7fa;
                --text-color: #333;
                --border-color: #e1e4e8;
            }
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            body {
                font-family: 'Roboto', sans-serif;
                line-height: 1.6;
                color: var(--text-color);
                background-color: var(--background-color);
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }
            header {
                background-color: var(--primary-color);
                color: white;
                text-align: center;
                padding: 1rem;
                margin-bottom: 2rem;
            }
            h1 {
                margin-bottom: 0.5rem;
            }
            .content-wrapper {
                display: flex;
                gap: 2rem;
            }
            .sidebar {
                flex: 1;
            }
            .main-content {
                flex: 3;
            }
            .card {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            .form-group {
                margin-bottom: 1rem;
            }
            label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: bold;
            }
            input[type="text"], input[type="email"], input[type="password"], input[type="url"], input[type="tel"], select, textarea {
                width: 100%;
                padding: 0.5rem;
                border: 1px solid var(--border-color);
                border-radius: 4px;
                font-size: 1rem;
            }
            button, .btn {
                display: inline-block;
                background-color: var(--primary-color);
                color: white;
                padding: 0.5rem 1rem;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 1rem;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }
            button:hover, .btn:hover {
                background-color: #3a7bd5;
            }
            .btn-danger {
                background-color: var(--danger-color);
            }
            .btn-danger:hover {
                background-color: #c0392b;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 0.75rem;
                text-align: left;
                border-bottom: 1px solid var(--border-color);
            }
            th {
                background-color: #f1f3f5;
                font-weight: bold;
            }
            .user-image {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                object-fit: cover;
            }
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4);
            }
            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 500px;
                border-radius: 8px;
            }
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }
            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
            .error, .success {
                padding: 0.75rem;
                margin-bottom: 1rem;
                border-radius: 4px;
            }
            .error {
                background-color: #fce4e4;
                border: 1px solid #fcc2c3;
                color: #cc0033;
            }
            .success {
                background-color: #d4edda;
                border: 1px solid #c3e6cb;
                color: #155724;
            }
        </style>
    </head>
    <body>
    <header>
        <h1>Lista de Usuarios</h1>
    </header>

    <div class="container">
        <div class="content-wrapper">
            <aside class="sidebar">
                <div class="card">
                    <h2>Acciones</h2>
                    <form action="usuarios.php" method="POST" class="form-group">
                        <input type="hidden" name="accion" value="cerrar_sesion">
                        <button type="submit" class="btn">Cerrar sesión</button>
                    </form>
                    <a href="gestion_contactanos.php" class="btn">Gestionar Contáctenos</a>
                </div>

                <div class="card">
                    <h2>Buscar Usuario</h2>
                    <form action="usuarios.php" method="GET">
                        <div class="form-group">
                            <input type="text" placeholder="Buscar por email" name="email">
                        </div>
                        <button type="submit">Buscar</button>
                    </form>
                </div>
            </aside>

            <main class="main-content">
                <?php if ($error): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="success"><?php echo $success; ?></div>
                <?php endif; ?>

                <div class="card">
                    <h2>Agregar Nuevo Usuario</h2>
                    <form action="usuarios.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="accion" value="agregar">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="fotoPerfil">Foto de Perfil</label>
                            <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="rol_new_user">Rol</label>
                            <select name="rol" id="rol_new_user" required>
                                <option value="administrador">Administrador</option>
                                <option value="psicologo">Psicólogo</option>
                                <option value="marketing">Marketing</option>
                            </select>
                        </div>
                        <div id="psicologo_fields" style="display:none;">
                            <div class="form-group">
                                <label for="speciality_new_user">Especialidad</label>
                                <select name="speciality_new_user" id="speciality_new_user">
                                    <?php foreach ($especialidadesController->getEspecialidades() as $especialidad): ?>
                                        <option value="<?= $especialidad['id'] ?>"><?= $especialidad['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nombrePsicologo">Nombre del Psicólogo</label>
                                <input type="text" id="nombrePsicologo" name="nombrePsicologo">
                            </div>
                            <div class="form-group">
                                <label for="video">URL del Video</label>
                                <input type="url" id="video" name="video">
                            </div>
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="tel" id="celular" name="celular">
                            </div>
                            <div class="form-group">
                                <label for="introduccion_new_user">Introducción</label>
                                <textarea id="introduccion_new_user" name="introduccion_new_user"></textarea>
                            </div>
                        </div>
                        <button type="submit">Agregar Usuario</button>
                    </form>
                </div>

                <div class="card">
                    <h2>Lista de Usuarios</h2>
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Foto Perfil</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['id']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><img src="<?= htmlspecialchars($usuario['fotoPerfil']) ?>" alt="Foto Perfil" class="user-image"></td>
                                <td><?= htmlspecialchars($usuario['rol']) ?></td>
                                <td>
                                    <button onclick="openEditModal(<?= htmlspecialchars(json_encode($usuario)) ?>)" class="btn">Editar</button>
                                    <button onclick="openDeleteModal(<?= htmlspecialchars($usuario['id']) ?>)" class="btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Editar Usuario</h2>
            <form id="editForm" action="usuarios.php" method="POST">
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label for="edit_email">Email</label>
                    <input type="email" id="edit_email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="edit_password">Nueva Contraseña (dejar en blanco para mantener la actual)</label>
                    <input type="password" id="edit_password" name="password">
                </div>
                <div class="form-group">
                    <label for="edit_fotoPerfil">URL Foto de Perfil</label>
                    <input type="url" id="edit_fotoPerfil" name="fotoPerfil" required>
                </div>
                <div class="form-group">
                    <label for="edit_rol">Rol</label>
                    <select name="rol" id="edit_rol" required>
                        <option value="administrador">Administrador</option>
                        <option value="psicologo">Psicólogo</option>
                        <option value="marketing">Marketing</option>
                        <option value="paciente">Paciente</option>
                    </select>
                </div>
                <div id="edit_psicologo_fields" style="display:none;">
                    <div class="form-group">
                        <label for="edit_especialidad_user">Especialidad</label>
                        <select name="especialidad_user" id="edit_especialidad_user">
                            <?php foreach ($especialidadesController->getEspecialidades() as $especialidad): ?>
                                <option value="<?= $especialidad['id'] ?>"><?= $especialidad['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_nombrePsicologo">Nombre del Psicólogo</label>
                        <input type="text" id="edit_nombrePsicologo" name="nombrePsicologo">
                    </div>
                    <div class="form-group">
                        <label for="edit_video">URL del Video</label>
                        <input type="url" id="edit_video" name="video">
                    </div>
                    <div class="form-group">
                        <label for="edit_celular">Celular</label>
                        <input type="tel" id="edit_celular" name="celular">
                    </div>
                    <div class="form-group">
                        <label for="edit_introduccion_user">Introducción</label>
                        <textarea id="edit_introduccion_user" name="introduccion_user"></textarea>
                    </div>
                </div>
                <button type="submit">Actualizar Usuario</button>
            </form>
        </div>
    </div>

    <!-- Modal de Eliminación -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirmar Eliminación</h2>
            <p>¿Está seguro de que desea eliminar este usuario?</p>
            <form id="deleteForm" action="usuarios.php" method="POST">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="id" id="delete_id">
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" onclick="closeDeleteModal()" class="btn">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        // Funciones para el modal de edición
        function openEditModal(usuario) {
            document.getElementById('edit_id').value = usuario.id;
            document.getElementById('edit_email').value = usuario.email;
            document.getElementById('edit_fotoPerfil').value = usuario.fotoPerfil;
            document.getElementById('edit_rol').value = usuario.rol;
            toggleEditPsychologistFields(usuario.rol);
            if (usuario.rol === 'psicologo') {
                document.getElementById('edit_especialidad_user').value = usuario.especialidad_id || '';
                document.getElementById('edit_nombrePsicologo').value = usuario.nombrePsicologo || '';
                document.getElementById('edit_video').value = usuario.video || '';
                document.getElementById('edit_celular').value = usuario.celular || '';
                document.getElementById('edit_introduccion_user').value = usuario.introduccion || '';
            }
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Funciones para el modal de eliminación
        function openDeleteModal(userId) {
            document.getElementById('delete_id').value = userId;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Cerrar modales al hacer clic en la X
        var spans = document.getElementsByClassName("close");
        for (var i = 0; i < spans.length; i++) {
            spans[i].onclick = function() {
                this.parentElement.parentElement.style.display = "none";
            }
        }

        // Cerrar modales al hacer clic fuera de ellos
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = "none";
            }
        }

        // Función para mostrar/ocultar campos de psicólogo en el formulario de edición
        function toggleEditPsychologistFields(role) {
            var fields = document.getElementById('edit_psicologo_fields');
            fields.style.display = (role === 'psicologo') ? 'block' : 'none';
        }

        // Event listener para el cambio de rol en el formulario de edición
        document.getElementById('edit_rol').addEventListener('change', function() {
            toggleEditPsychologistFields(this.value);
        });

        // Función para mostrar/ocultar campos de psicólogo en el formulario de creación
        function toggleNewPsychologistFields(role) {
            var fields = document.getElementById('psicologo_fields');
            fields.style.display = (role === 'psicologo') ? 'block' : 'none';
        }

        // Event listener para el cambio de rol en el formulario de creación
        document.getElementById('rol_new_user').addEventListener('change', function() {
            toggleNewPsychologistFields(this.value);
        });
    </script>
    </body>
    </html>
    <?php
} else {
    header("Location: index.php");
    exit();
}
?>