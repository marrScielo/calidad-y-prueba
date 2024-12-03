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
    <title>Gestión de Usuarios</title>
    <link rel="icon" href="img/favicon.png">
    <style>
        body {
            font-family: Montserrat, sans-serif;
            background-color: #D9D9D9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #7A5BA6;
            padding: 10px 20px;
            color: #FFFFFF;
        }
        .header img {
            height: 50px;
        }
        .header .actions {
            display: flex;
            align-items: center;
        }
        .header .actions form {
            margin-left: 20px;
        }
        .content-wrapper {
            display: flex;
            flex-wrap: wrap;
        }
        .sidebar, .main-content {
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar {
            flex: 1 1 300px;
            background-color: #A6A3BF;
            margin-right: 20px;
        }
        .main-content {
            flex: 3 1 600px;
            background-color: #FFFFFF;
        }
        .card {
            background-color: #FFFFFF;
            border: 1px solid #9D8EBF;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
        }
        .card h2 {
            color: #4F468C;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #4F468C;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #9D8EBF;
            border-radius: 4px;
        }
        .btn {
            background-color: #7A5BA6;
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-danger {
            background-color: #FF4C4C;
        }
        .error, .success {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .error {
            background-color: #FFCCCC;
            color: #CC0000;
        }
        .success {
            background-color: #CCFFCC;
            color: #006600;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #9D8EBF;
            text-align: left;
        }
        table th {
            background-color: #A6A3BF;
            color: #FFFFFF;
        }
        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
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
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #FFFFFF;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #9D8EBF;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }
        .close {
            color: #AAAAAA;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: #000000;
            text-decoration: none;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
            }
            .sidebar {
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <header class="header">
        <img src="img/favicon.png" alt="Logo">

        <div class="actions">
            <form action="usuarios.php" method="POST">
                <input type="hidden" name="accion" value="cerrar_sesion">
                <button type="submit" class="btn">Cerrar sesión</button>
            </form>
        </div>
    </header>
    <div class="content-wrapper">
        <aside class="sidebar">
            <div class="card">
                <h2>Buscar Usuario</h2>
                <form id="searchForm" method="GET">
                    <div class="form-group">
                        <input type="text" placeholder="Buscar por email" name="email" id="searchEmail">
                    </div>
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
                    <button type="submit" class="btn">Agregar Usuario</button>
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
                    <tbody id="userList">
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
            <button type="submit" class="btn">Actualizar Usuario</button>
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
    document.getElementById('searchEmail').addEventListener('input', function() {
        const email = this.value;
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'usuarios.php?email=' + email, true);
        xhr.onload = function() {
            if (this.status === 200) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(this.responseText, 'text/html');
                const userList = doc.getElementById('userList').innerHTML;
                document.getElementById('userList').innerHTML = userList;
            }
        };
        xhr.send();
    });

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

    function openDeleteModal(id) {
        document.getElementById('delete_id').value = id;
        document.getElementById('deleteModal').style.display = 'block';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    function toggleEditPsychologistFields(rol) {
        const fields = document.getElementById('edit_psicologo_fields');
        if (rol === 'psicologo') {
            fields.style.display = 'block';
        } else {
            fields.style.display = 'none';
        }
    }

    document.querySelectorAll('.close').forEach(function(element) {
        element.addEventListener('click', function() {
            closeEditModal();
            closeDeleteModal();
        });
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