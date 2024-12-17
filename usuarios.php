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

    $error = $_SESSION['error'] ?? '';
    $success = $_SESSION['success'] ?? '';

    // Limpiar mensajes de sesión
    unset($_SESSION['error']);
    unset($_SESSION['success']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'agregar':
                    $password = $_POST['password'];
                    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=]).{8,}$/';

                    if (!preg_match($pattern, $password)) {
                        $_SESSION['error'] = "La contraseña debe contener al menos una letra mayúscula, un símbolo, un número y tener al menos 8 caracteres.";
                        break;
                    }

                    //valida si gmail ya existe
                    $email = $_POST['email'];
                    $stmt = $usuariosController->buscarPorEmail($email);
                    if ($stmt) {
                        $_SESSION['error'] = "El correo ya esta registrado, intenta con otro.";
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
                        $_SESSION['success'] = "Usuario agregado exitosamente.";
                    } else {
                        $_SESSION['error'] = "Error al agregar usuario.";
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
                        $_SESSION['success'] = "Usuario actualizado exitosamente.";
                    } else {
                        $_SESSION['error'] = "Error al actualizar usuario.";
                    }
                    break;
                case 'eliminar':
                    $result = $usuariosController->eliminarUsuario($_POST['id']);
                    if ($result) {
                        $_SESSION['success'] = "Usuario eliminado exitosamente.";
                    } else {
                        $_SESSION['error'] = "Error al eliminar usuario.";
                    }
                    break;
                case 'cerrar_sesion':
                    session_destroy();
                    header("Location: index.php");
                    exit();
                    break;
            }
            header("Location: usuarios.php");
            exit();
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
    <title>Contigo Voy: Gestión de Usuarios</title>
    <link rel="icon" href="img/favicon.png">
    <style>
        :root {
            --primary-color: #7A5BA6;
            --secondary-color: #4F468C;
            --background-color: #F5F5F5;
            --text-color: #333333;
            --border-color: #9D8EBF;
            --success-color: #4CAF50;
            --error-color: #FF5252;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: center;
        }

        .header {
            background-color: var(--primary-color);
            color: #FFFFFF;
            padding: 1em;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .header img {
            height: 50px;
        }

        .header-marca {
            display: flex;
            align-items: center;
            flex-direction: row;
            gap: 1em;
        }

        .search-form {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .search-form input {
            padding: 10px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }

        .search-form button {
            background-color: var(--secondary-color);
            color: #FFFFFF;
            padding: 10px 15px;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .search-form button:hover {
            background-color: #3A3266;
        }

        .content-wrapper {
            margin-top: 100px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .card h2 {
            color: var(--secondary-color);
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .btn {
            background-color: var(--primary-color);
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--secondary-color);
        }

        .btn-danger {
            background-color: var(--error-color);
        }

        .btn-danger:hover {
            background-color: #D32F2F;
        }

        .error, .success {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: bold;
        }

        .error {
            background-color: #FFEBEE;
            color: var(--error-color);
        }

        .success {
            background-color: #E8F5E9;
            color: var(--success-color);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            background-color: #FFFFFF;
        }

        table th {
            background-color: var(--secondary-color);
            color: #FFFFFF;
            font-weight: 600;
        }

        table tr {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        table tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
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
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: #FFFFFF;
            margin: 1em auto;
            padding: 20px;
            border: 1px solid var(--border-color);
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close {
            color: #AAAAAA;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #000000;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }

            .search-form {
                margin-top: 10px;
            }

            .content-wrapper {
                margin-top: 150px;
            }

            table {
                font-size: 14px;
            }

            table th, table td {
                padding: 10px;
            }

            .user-image {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
<header class="header">
        <div class="container header-content">
            <div class="header-marca">
                <img src="img/favicon.png" alt="Logo">
                <h2>Contigo Voy</h2>
            </div>
            <form id="searchForm" method="GET" class="search-form">
                <input type="text" placeholder="Buscar por email" name="email" id="searchEmail">
                <button type="submit" class="btn">Buscar</button>
            </form>
            <form action="usuarios.php" method="POST">
                <input type="hidden" name="accion" value="cerrar_sesion">
                <button type="submit" class="btn">Cerrar sesión</button>
            </form>
        </div>
    </header>

    <div class="container">
        <div class="content-wrapper">
            <main class="main-content">
            <?php if ($error): ?>
                <div id="errorModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('errorModal')">&times;</span>
                        <div class="error"><?php echo $error; ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div id="successModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('successModal')">&times;</span>
                        <div class="success"><?php echo $success; ?></div>
                    </div>
                </div>
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
        <?php
        if (isset($_GET['edit_id'])) {
            $userId = $_GET['edit_id'];
            $user = $userController->getUserById($userId);
        }
        ?>
        <h2>Editar Usuario</h2>
        <form id="editForm" action="usuarios.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="accion" value="actualizar">
            <input type="hidden" name="id" id="edit_id" value="<?= $user['id'] ?? '' ?>">
            <div class="form-group">
                <label for="edit_email">Email</label>
                <input type="email" id="edit_email" name="email" value="<?= $user['email'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="edit_password">Nueva Contraseña (dejar en blanco para mantener la actual)</label>
                <input type="password" id="edit_password" name="password">
            </div>
            <div class="form-group">
                <label for="edit_fotoPerfil">URL Foto de Perfil</label>
                <input type="url" id="edit_fotoPerfil" name="fotoPerfil" value="<?= $user['fotoPerfil'] ?? '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="edit_rol">Rol</label>
                <select name="rol" id="edit_rol" required>
                    <option value="administrador" <?= isset($user['rol']) && $user['rol'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
                    <option value="psicologo" <?= isset($user['rol']) && $user['rol'] == 'psicologo' ? 'selected' : '' ?>>Psicólogo</option>
                    <option value="marketing" <?= isset($user['rol']) && $user['rol'] == 'marketing' ? 'selected' : '' ?>>Marketing</option>
                    <option value="paciente" <?= isset($user['rol']) && $user['rol'] == 'paciente' ? 'selected' : '' ?>>Paciente</option>
                </select>
            </div>
            <div id="edit_psicologo_fields" style="display: <?= isset($user['rol']) && $user['rol'] == 'psicologo' ? 'block' : 'none' ?>;">
                <div class="form-group">
                    <label for="edit_especialidad_user">Especialidad</label>
                    <select name="especialidad_user" id="edit_especialidad_user">
                        <?php foreach ($especialidadesController->getEspecialidades() as $especialidad): ?>
                            <option value="<?= $especialidad['id'] ?>" <?= isset($user['especialidad_user']) && $user['especialidad_user'] == $especialidad['id'] ? 'selected' : '' ?>><?= $especialidad['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_nombrePsicologo">Nombre del Psicólogo</label>
                    <input type="text" id="edit_nombrePsicologo" name="nombrePsicologo" value="<?= $user['nombrePsicologo'] ?? '' ?>">
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
            </div>
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

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    window.onload = function() {
        if (document.getElementById('errorModal')) {
            document.getElementById('errorModal').style.display = 'block';
        }
        if (document.getElementById('successModal')) {
            document.getElementById('successModal').style.display = 'block';
        }

        // Mostrar campos de psicólogo si el rol es psicólogo al cargar la página
        const rolSelect = document.getElementById('rol_new_user');
        const psicologoFields = document.getElementById('psicologo_fields');
        if (rolSelect.value === 'psicologo') {
            psicologoFields.style.display = 'block';
        } else {
            psicologoFields.style.display = 'none';
        }
    }

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

    // Mostrar/ocultar campos de psicólogo según el rol seleccionado
    document.getElementById('rol_new_user').addEventListener('change', function() {
        const psicologoFields = document.getElementById('psicologo_fields');
        if (this.value === 'psicologo') {
            psicologoFields.style.display = 'block';
        } else {
            psicologoFields.style.display = 'none';
        }
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