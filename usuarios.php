<?php
session_start();
if(isset($_SESSION['logeado'])){
    // Incluir el controlador
    require_once 'Controlador/UsuariosController.php';
    include_once 'Controlador/Psicologo/PsicologoController.php';
    include_once 'Controlador/EspecialidadesController.php';
    $psicologoController = new PsicologoController();
    $especialidadesController = new EspecialidadController();
    $usuariosController = new UsuariosController();

        // Verificar las acciones CRUD
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'agregar':
                    $usuariosController->agregarUsuario(
                        $_POST['email'],
                        $_POST['password'],
                        $_POST['fotoPerfil'],
                        $_POST['rol'],
                        $_POST['introduccion_new_user'],
                        $_POST['speciality_new_user'],
                        isset($_POST['nombrePsicologo']) ? $_POST['nombrePsicologo'] : '', // Verificar si está definido
                        isset($_POST['video']) ? $_POST['video'] : '', // Verificar si está definido
                        isset($_POST['celular']) ? $_POST['celular'] : '' // Verificar si está definido
                    );
                    break;
                case 'actualizar':
                    $usuariosController->actualizarUsuario(
                        $_POST['id'],
                        $_POST['email'],
                        $_POST['password'],
                        $_POST['fotoPerfil'],
                        $_POST['rol'],
                        $_POST['introduccion_user'],
                        $_POST['especialidad_user'],
                        isset($_POST['nombrePsicologo']) ? $_POST['nombrePsicologo'] : '', // Verificar si está definido
                        isset($_POST['video']) ? $_POST['video'] : '', // Verificar si está definido
                        isset($_POST['celular']) ? $_POST['celular'] : '' // Verificar si está definido
                    );
                    break;
                case 'eliminar':
                    $usuariosController->eliminarUsuario($_POST['id']);
                    break;
                case 'cerrar_sesion':
                    session_destroy();
                    header("Location: index.php");
                    exit();
                    break;
            }
        }
    }

    // Verificar si se ha enviado un email para buscar
    $emailBuscar = isset($_GET['email']) ? $_GET['email'] : '';

    // Llamar al método del controlador según si se busca por email o no
    if (!empty($emailBuscar)) {
        $usuarios = $usuariosController->buscarPorEmail($emailBuscar);
    } else {
        $usuarios = $usuariosController->mostrarUsuarios();
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/usuarios.css">
</head>

<body>
    <div class="container">
        <div class="logout-button">
            <form action="usuarios.php" method="POST">
                <input type="hidden" name="accion" value="cerrar_sesion">
                <input type="submit" value="Cerrar sesión">
            </form>
        </div>
        <a href="gestion_contactanos.php" class="gestion-contactenos-btn">Gestionar Contactenos</a>
        <div class="search-container">
            <form action="usuarios.php" method="GET">
                <input type="text" placeholder="Buscar por email" name="email">
                <input type="submit" value="Buscar">
            </form>
        </div>

        <div class="form-container">
            <form action="usuarios.php" method="POST">
                <input type="hidden" name="accion" value="agregar">
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="url" name="fotoPerfil" placeholder="Foto Perfil URL" required>
                <select name="rol" required id="rol_new_user">
                    <option value="paciente">Paciente</option>
                    <option value="psicologo">Psicologo</option>
                    <option value="administrador">Administrador</option>
                </select>
                <select name="speciality_new_user" id="speciality_new_user" style="display: none;">
                    <?php foreach ($especialidadesController->getEspecialidades() as $especialidad): ?>
                    <option value="<?= $especialidad['id'] ?>"><?= $especialidad['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="nombrePsicologo" placeholder="Nombre Psicologo" style="display: none;">
                <input type="url" name="video" placeholder="Video URL" style="display: none;">
                <input type="tel" name="celular" placeholder="Celular" style="display: none;">
                <textarea name="introduccion_new_user" id="introduccion_new_user" placeholder="Introducción" style="display: none;"></textarea>
                <input type="submit" value="Agregar Usuario">
            </form>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Foto Perfil</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($usuarios as $usuario): 
                $nombrePsicologo = '';
                $video = '';
                $celular = '';
                $especialidad_id = '';
                $introduccion = '';

                if($usuario['rol'] == 'psicologo'){
                    $psicologo = $psicologoController->getPsicologoByIdUser($usuario['id']);
                    if($psicologo != null){
                        $nombrePsicologo = $psicologo['NombrePsicologo'] ?? '';
                        $video = $psicologo['video'] ?? '';
                        $celular = $psicologo['celular'] ?? '';
                        $introduccion = $psicologo['introduccion'] ?? '';
                        $especialidad_id = $especialidadesController->getEspecialidadById($psicologo['especialidad_id'])['id'] ?? '';
                    }
                }
            ?>

            <tr class="user_data" id="<?= htmlspecialchars($usuario['id']) ?>">
                <td><?= htmlspecialchars($usuario['id']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><img src="<?= htmlspecialchars($usuario['fotoPerfil']) ?>" alt="Foto Perfil" width="50"></td>
                <td><?= htmlspecialchars($usuario['rol']) ?></td>
                <td class="acciones">
                    <form action="usuarios.php" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="submit" value="Eliminar" style="background-color: #e74c3c; color: white;">
                    </form>
                    <form action="usuarios.php" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
                        <input type="hidden" name="accion" value="actualizar">
                        <input type="text" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                        <input type="password" name="password" value="<?= htmlspecialchars($usuario['password']) ?>" required>
                        <input type="url" name="fotoPerfil" value="<?= htmlspecialchars($usuario['fotoPerfil']) ?>" required>
                        <select name="rol" required onchange="toggleShowLabelsPyscho(this)">
                            <option value="psicologo" <?= $usuario['rol'] == 'psicologo' ? 'selected' : '' ?>>Psicologo</option>
                            <option value="paciente" <?= $usuario['rol'] == 'paciente' ? 'selected' : '' ?>>Paciente</option>
                            <option value="administrador" <?= $usuario['rol'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
                        </select>
                        
                        <!-- Campos específicos para Psicologo -->
                        <textarea name="introduccion_user" id="introduccion_user_<?= htmlspecialchars($usuario['id']) ?>" placeholder="Introducción" style="display: <?= $usuario['rol'] == 'psicologo' ? 'block' : 'none' ?>;"><?= htmlspecialchars(trim($introduccion)) ?></textarea>
                        
                        <select name="especialidad_user" id="especialidad_user_<?= htmlspecialchars($usuario['id']) ?>" style="display: <?= $usuario['rol'] == 'psicologo' ? 'block' : 'none' ?>;">
                            <?php foreach ($especialidadesController->getEspecialidades() as $especialidad): ?>
                            <option value="<?= $especialidad['id'] ?>" <?= $especialidad_id == $especialidad['id'] ? 'selected' : '' ?>><?= $especialidad['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                        <input type="text" name="nombrePsicologo" id="nombrePsicologo_<?= htmlspecialchars($usuario['id']) ?>" value="<?= htmlspecialchars($nombrePsicologo) ?>" placeholder="Nombre Psicologo" style="display: <?= $usuario['rol'] == 'psicologo' ? 'block' : 'none' ?>;">
                        <input type="url" name="video" id="video_<?= htmlspecialchars($usuario['id']) ?>" value="<?= htmlspecialchars($video) ?>" placeholder="Video URL" style="display: <?= $usuario['rol'] == 'psicologo' ? 'block' : 'none' ?>;">
                        <input type="tel" name="celular" id="celular_<?= htmlspecialchars($usuario['id']) ?>" value="<?= htmlspecialchars($celular) ?>" placeholder="Celular" style="display: <?= $usuario['rol'] == 'psicologo' ? 'block' : 'none' ?>;">
                        <input type="submit" value="Actualizar" style="background-color: #3498db; color: white;">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
    <script>
        // Función para mostrar u ocultar campos basados en el rol seleccionado
        function toggleShowLabelsPyscho(selectElement) {
            const parentForm = selectElement.parentNode;
            const selectedRole = selectElement.value;
            const psychoSpecificFields = parentForm.querySelectorAll("[id^='nombrePsicologo'], [id^='video'], [id^='celular'], [id^='especialidad_user'], [id^='introduccion_user']");

            psychoSpecificFields.forEach(field => {
                if (selectedRole === 'psicologo') {
                    field.style.display = 'block';
                } else {
                    field.style.display = 'none';
                }
            });
        }

        // Evento para el formulario de creación de usuarios
        document.getElementById('rol_new_user').addEventListener('change', function () {
            const selectedRole = this.value;
            const elementsToShow = ['speciality_new_user', 'nombrePsicologo', 'video', 'celular', 'introduccion_new_user'];

            elementsToShow.forEach(id => {
                document.querySelector(`[name=${id}]`).style.display = selectedRole === 'psicologo' ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>
<?php } else { ?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php } ?>
