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
                    $usuariosController->agregarUsuario($_POST['email'], $_POST['password'], $_POST['fotoPerfil'], $_POST['rol'], $_POST['introduccion_new_user'], $_POST['speciality_new_user']);
                    break;
                case 'actualizar':
                    $usuariosController->actualizarUsuario($_POST['id'], $_POST['email'], $_POST['password'], $_POST['fotoPerfil'], $_POST['rol'], $_POST['introduccion_user'], $_POST['speciality_new_user']);
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
    <link rel="icon" href="img/Logo.png">
    <style>
        /* Estilos generales */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Estilos para el contenedor principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Estilos para el formulario de búsqueda */
        .search-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .search-container input[type=text] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-container input[type=submit] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container input[type=submit]:hover {
            background-color: #45a049;
        }

        /* Estilos para la tabla de usuarios */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        /* Estilos para el formulario de CRUD */
        .form-container {
            margin-bottom: 30px;
        }

        .form-container form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-container form input[type=text], 
        .form-container form input[type=password], 
        .form-container form input[type=url],
        .form-container form select,
        .form-container form textarea {
            padding: 10px;
            width: 48%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container form input[type=submit] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .form-container form input[type=submit]:hover {
            background-color: #45a049;
        }

        /* Estilos para las acciones */
        .acciones {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .acciones form {
            display: flex;
            flex-direction: column;
            gap: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .acciones form input[type=submit] {
            width: auto;
            padding: 5px 10px;
            margin-top: 5px;
        }

        .acciones form input[type=submit]:hover {
            background-color: #45a049;
        }

        .acciones form select,
        .acciones form input[type=text],
        .acciones form input[type=password],
        .acciones form input[type=url],
        .acciones form textarea
        {
            padding: 5px;
            margin-top: 5px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .logout-button {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .logout-button form input[type=submit] {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-button form input[type=submit]:hover {
            background-color: #c0392b;
        }

        .gestion-contactenos-btn {
            background-color: #f45231; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
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
                    <option value="psicologo">Psicologo</option>
                    <option value="paciente">Paciente</option>
                    <option value="administrador">Administrador</option>
                </select>
                <select name="speciality_new_user" id="speciality_new_user">
                    <?php foreach ($especialidadesController->getEspecialidades() as $especialidad): ?>
                        <option value="<?= $especialidad['id'] ?>"><?= $especialidad['nombre'] ?></option>
                    <?php endforeach; ?>|
                </select>
                <textarea name="introduccion_new_user" id="introduccion_new_user" placeholder="Introducción"></textarea>
                <input type="submit" value="Agregar Usuario">
            </form>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Foto Perfil</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($usuarios as $usuario):
                $usuario['introduccion'] = '';
                if($usuario['rol'] == 'psicologo'){
                    $psicologo = $psicologoController->getPsicologoByIdUser($usuario['id']);
                    if($psicologo != null){
                        $especialidad = $especialidadesController->getEspecialidadById($psicologo['especialidad_id']);
                        $usuario['introduccion'] = $psicologo['introduccion']??'';
                    }
                }
            ?>
                

                <tr class="user_data" id=<?= htmlspecialchars($usuario['id']) ?> >
                    <td><?= htmlspecialchars($usuario['id']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['password']) ?></td>
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
                            <select name="rol" required onchange="toggleIntroduccion(this)">
                                <option value="psicologo" <?= $usuario['rol'] == 'psicologo' ? 'selected' : '' ?>>Psicologo</option>
                                <option value="paciente" <?= $usuario['rol'] == 'paciente' ? 'selected' : '' ?>>Paciente</option>
                                <option value="administrador" <?= $usuario['rol'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
                            </select>
                            <textarea name="introduccion_user" id="introduccion_user_<?= htmlspecialchars($usuario['id']) ?>" placeholder="Introducción" style="display: <?= $usuario['rol'] == 'psicologo' ? 'block' : 'none' ?>;"><?= htmlspecialchars(trim($usuario['introduccion'])) ?>
                            </textarea>
                            <select name="especialidad_user" id="especialidad_user_<?= htmlspecialchars($usuario['id']) ?>"
                            style="display: <?= $usuario['rol'] == 'psicologo' ? 'block' : 'none' ?>;" onchange="toggleIntroduccion(this)">
                                <?php foreach ($especialidadesController->getEspecialidades() as $especialidad): ?>
                                    <option value="<?= $especialidad['id'] ?>" <?= $especialidad['id'] == $especialidad['id'] ? 'selected' : '' ?>><?= $especialidad['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" value="Actualizar" style="background-color: #3498db; color: white;">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
<script>
    console.log('Hola desde el script');
    const rolNewUser = document.getElementById('rol_new_user');
    const specialityNewUser = document.getElementById('speciality_new_user');
    const introduccionNewUser = document.getElementById('introduccion_new_user');
    const introduccionUser = document.getElementById('introduccion_user');
    
    rolNewUser.addEventListener('change', (event) => {
        if (event.target.value === 'psicologo') {
            specialityNewUser.style.display = 'block';
            introduccionNewUser.style.display = 'block';
        } else {
            specialityNewUser.style.display = 'none';
            introduccionNewUser.style.display = 'none';
        }
    });

    function toggleIntroduccion(selectElement) {
        let userId = selectElement.parentElement.querySelector('input[name="id"]').value;
        let introduccionField = document.getElementById('introduccion_user_' + userId);
        let especialidadField = document.getElementById('especialidad_user_' + userId);
        if (selectElement.value === 'psicologo') {
            introduccionField.style.display = 'block';
            especialidadField.style.display = 'block';
        } else {
            introduccionField.style.display = 'none';
            especialidadField.style.display = 'none';
        }
    }
</script>
</html>

<?php
}else{
    header("Location: index.php");
}
?>
