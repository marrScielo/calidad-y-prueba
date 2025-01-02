<?php
session_start();
if (isset($_SESSION['logeado'])) {
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
        <link rel="icon" href="../img/favicon.png">
        <link rel="stylesheet" href="../Issets/css/main_usuarios.css">
        <link rel="stylesheet" href="../Issets/css/tabla_usuarios.css">
        <style>
            /* Estilo para el modal */
            .modal {
                display: none; /* Oculto por defecto */
                position: fixed; /* Fijo en la pantalla */
                z-index: 1; /* Por encima de otros elementos */
                left: 0;
                top: 0;
                width: 100%; /* Ancho completo */
                height: 100%; /* Altura completa */
                overflow: auto; /* Habilitar scroll si es necesario */
                background-color: rgb(0,0,0); /* Color de fondo */
                background-color: rgba(0,0,0,0.4); /* Fondo con opacidad */
            }

            /* Estilo para el contenido del modal */
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto; /* 15% desde la parte superior y centrado */
                padding: 20px;
                border: 1px solid #888;
                width: 80%; /* Ancho del 80% */
                max-width: 600px; /* Ancho máximo */
                border-radius: 10px; /* Bordes redondeados */
            }

            /* Estilo para el botón de cierre */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            /* Estilo para el formulario dentro del modal */
            #editUserForm {
                display: flex;
                flex-direction: column;
            }

            #editUserForm label {
                margin-top: 10px;
            }

            #editUserForm input {
                padding: 10px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            #editUserForm button {
                margin-top: 20px;
                padding: 10px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            #editUserForm button:hover {
                background-color: #0056b3;
            }

            /* Estilo para el modal de confirmación de eliminación */
            #deleteUserModal {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            #deleteUserModal h2 {
                margin-bottom: 20px;
            }

            #deleteUserModal p {
                margin-bottom: 20px;
                text-align: center;
            }

            #deleteUserModal button {
                margin: 5px;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            #deleteUserModal .confirm-button {
                background-color: #dc3545;
                color: white;
            }

            #deleteUserModal .confirm-button:hover {
                background-color: #c82333;
            }

            #deleteUserModal .cancel-button {
                background-color: #6c757d;
                color: white;
            }

            #deleteUserModal .cancel-button:hover {
                background-color: #5a6268;
            }
        </style>
    </head>

    <body>
    <main class="main">
        <?php require_once '../Componentes/administrador/header_busqueda.php'; ?>
        <?php require_once '../Componentes/administrador/tabla_usuarios.php'; ?>
        <?php require_once '../Componentes/administrador/modal_usuario.php'; ?>
        <div id="userModal" class="modal">
            <div id="modalContent" class="modal-content">
                <!-- Modal content will be loaded here -->
            </div>
        </div>
        <div id="searchModal" class="modal">
            <div id="searchModalContent" class="modal-content">
                <span class="close" onclick="closeSearchModal()">&times;</span>
                <div id="searchResults">
                    <!-- Search results will be loaded here -->
                </div>
            </div>
        </div>


    </main>
    <script>
        function closeSearchModal() {
            document.getElementById('searchModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('searchModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../Index.php");
}
?>