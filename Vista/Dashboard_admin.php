<?php
session_start();
if (isset($_SESSION['logeado'])) {
    // Incluir el controlador
    require("../Controlador/UsuariosController.php");

    $usuariosController = new UsuariosController();
    $usuarios = $usuariosController->mostrarUsuarios();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Usuarios</title>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
        <link rel="icon" href="../img/favicon.png">
        <link rel="stylesheet" href="../Issets/css/main_usuarios.css">
        <link rel="stylesheet" href="../Issets/css/tabla_usuarios.css">
    </head>

    <body>
        <main class="main">
            <?php require_once '../Componentes/administrador/tabla_usuarios.php'; ?>
        </main>
    </body>

    </html>
<?php
} else {
    header("Location: ../Index.php");
}
?>