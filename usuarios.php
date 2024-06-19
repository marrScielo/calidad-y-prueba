<?php
// Incluir el controlador
require_once 'Controlador/UsuariosController.php';

// Crear una instancia del controlador
$usuariosController = new UsuariosController();

// Verificar las acciones CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregar':
                $usuariosController->agregarUsuario($_POST['email'], $_POST['password'], $_POST['fotoPerfil'], $_POST['rol']);
                break;
            case 'actualizar':
                $usuariosController->actualizarUsuario($_POST['id'], $_POST['email'], $_POST['password'], $_POST['fotoPerfil'], $_POST['rol']);
                break;
            case 'eliminar':
                $usuariosController->eliminarUsuario($_POST['id']);
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
        .form-container form select {
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
        .acciones form input[type=url] {
            padding: 5px;
            margin-top: 5px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
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
                <select name="rol" required>
                    <option value="psicologo">Psicologo</option>
                    <option value="paciente">Paciente</option>
                    <option value="administrador">Administrador</option>
                </select>
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
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
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
                        <select name="rol" required>
                            <option value="psicologo" <?= $usuario['rol'] == 'psicologo' ? 'selected' : '' ?>>Psicologo</option>
                            <option value="paciente" <?= $usuario['rol'] == 'paciente' ? 'selected' : '' ?>>Paciente</option>
                            <option value="administrador" <?= $usuario['rol'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
                        </select>
                        <input type="submit" value="Actualizar" style="background-color: #3498db; color: white;">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
