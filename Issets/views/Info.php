<?php
$theme = 'light';
if (isset($_COOKIE['theme'])) {
    $theme = $_COOKIE['theme'];
}

// Incluye tus archivos con las clases necesarias
require_once('../Controlador/Paciente/ControllerPaciente.php');
require_once('../Modelo/Paciente/ModelPaciente.php');

// Crea una instancia del controlador y del modelo
$Psi = new usernameControlerPaciente();
$psicologo = $Psi->showPsicologo($_SESSION['IdPsicologo']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardarCambios'])) {
    // Obtén el ID del psicólogo desde el formulario
    $idPsicologo = $_POST['idPsicologo'];

    // Obtén otros datos del formulario
    $nombre = $_POST['nombreInput'];
    $usuario = $_POST['usuarioInput'];
    $correo = $_POST['correoInput'];
    $celular = $_POST['celularInput'];
    $contrasena = $_POST['contrasenaInput'];
    $video = $_POST['videoInput'];

    // Crea una instancia del controlador y utiliza el método para actualizar los datos
    $Psi = new usernameControlerPaciente();
    $result = $Psi->updatePsicologo($idPsicologo, $nombre, $usuario, $correo, $celular, $contrasena, $video);

    // Verificar el resultado de la actualización
    if ($result) {
        // Redirigir a Dashboard.php con los nuevos datos como parámetros GET
        header("Location: ../Vista/Dashboards.php?nombre=" . urlencode($nombre));
        exit();
    } else {
        // Manejar el caso en que la actualización falle
        echo "Error al actualizar los datos.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<style>
    .top {
        margin-right: 0 !important;
    }

    .hidden {
        display: none;
    }

    @media (max-width: 768px) {
        #menu-btn {
            display: flex;
        }

        #external-mode-control,
        #fixed_settings,
        #profile_fixed,

        #nom-user {
            display: none;
        }
    }

    @media (min-width: 769px) {
        #menu-btn {
            display: none;
        }

        #external-mode-control,
        #fixed_settings,
        #profile_fixed,
        #nom-user {
            display: flex;
        }
    }



    #menu-content {
        list-style-type: none;
        padding: 20px;
        margin: 0;
        position: fixed;
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        overflow-y: auto;
    }

    #menu-content .menu-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    #menu-content .menu-item:last-child {
        border-bottom: none;
    }

    #menu-content .menu-item .icon {
        margin-right: 10px;
    }

    .hidden {
        display: none;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    #menu-btn {
        align-items: center;
        justify-content: center;
        padding: 5px;
        background-color: transparent;
        /* Fondo transparente */
        color: #534489;
        border: 2px solid #534489;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        transition: background-color 0.3s, color 0.3s;
    }

    #menu-btn:hover {
        background-color: #534489;
        color: white;
    }

    .nom-psicologo {
        font-size: 20px;
        font-weight: bold;
        color: #534489;
        margin-bottom: 20px;
    }

    .nom-opti {
        font-size: 16px;
        font-weight: semibold;
        color: black;
        margin-left: 5px;
    }
</style>

<body>
    <!-- El resto de tu código HTML y JavaScript -->


    <div class="top <?php echo ($theme === 'dark') ? 'dark-mode' : ''; ?>" id="top_fixed">

        <div class="theme-toggler" id="external-mode-control">
            <span class="material-symbols-sharp" data-theme="dark" translate="no">dark_mode</span>
            <span class="material-symbols-sharp active" data-theme="light" translate="no">light_mode</span>
        </div>

        <div id="fixed_settings">
            <a class="ajuste-info">
                <span class="material-symbols-sharp" translate="no">settings</span>
            </a>
        </div>

        <div class="profile" id="profile_fixed">
            <div class="info">
                <div></div>
                <p translate="no"><?= $_SESSION['NombrePsicologo'] ?></p>
                <div></div>
            </div>
        </div>
        <a href="../Issets/views/Salir.php" id="nom-user">
            <h3 class="cerrar-info" translate="no">Cerrar Sesion</h3>
        </a>

        <button id="menu-btn">
            <span class="material-symbols-sharp" translate="no">menu</span>
        </button>

        <!-- Contenido del listado de opciones para la vista movil -->

        <div id="menu-content" class="hidden <?php echo ($theme === 'dark') ? 'dark-mode' : ''; ?>">
            <button class="close-btn" onclick="toggleMenu()">✖</button>
            <p class="nom-psicologo" translate="no"><?= $_SESSION['NombrePsicologo'] ?></p>
            <div class="menu-item">
                <div class="theme-toggler" id="internal-mode-control">
                    <span class="material-symbols-sharp" data-theme="dark" translate="no">dark_mode</span>
                    <span class="material-symbols-sharp active" data-theme="light" translate="no">light_mode</span>
                </div>
            </div>
            <div class="menu-item">
                <a class="ajuste-info2">
                    <span class="material-symbols-sharp" translate="no">settings</span>
                    <a class="nom-opti">Ajustes</a>
                </a>
            </div>
            <div class="menu-item" onclick="cerrarSesion()">
                <a class="cerrar-info">
                    <span class="material-symbols-sharp" translate="no">logout</span>
                    <a class="nom-opti">Cerrar Sesion</a>
                </a>
            </div>

        </div>
    </div>

    <!-- Formulario de settings -->
    <div class="navigation">
        <div class="form-info">
            <a href="#" class="closeaaa">&times;</a> <!-- La X para cerrar el modal o la sección -->
            <div style="display:flex;margin:1em;gap:20px">
                <div>
                    <h2><?= $_SESSION['Usuario'] ?></h2>
                    <h1 style="margin-top:-10px;text-align:center">#<?= $_SESSION['IdPsicologo'] ?></h1>
                </div>
            </div>
            <form method="post" action="">
                <div style="margin:20px">
                    <div>
                        <h3 style="color:#49c691;font-size:17px; text-align:start;" for="nombreInput">Nombre</h3>
                        <div style="display: flex; gap:30px;">
                            <input id="nombreInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px; margin-bottom: 10px;" type="text" name="nombreInput" value="<?= $psicologo['NombrePsicologo'] ?>" readonly />
                            <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('nombreInput')">Editar</a>
                        </div>
                    </div>
                    <div>
                        <h3 style="color:#49c691;font-size:17px;text-align:start;" for="usuarioInput">Usuario</h3>
                        <div style="display: flex; gap:30px;">
                            <input id="usuarioInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="text" name="usuarioInput" value="<?= $psicologo['Usuario'] ?>" readonly />
                            <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('usuarioInput')">Editar</a>
                        </div>
                    </div>
                    <div>
                        <h3 style="color:#49c691;font-size:17px;text-align:start;" for="correoInput">Correo</h3>
                        <div style="display: flex; gap:30px;">
                            <input id="correoInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="text" name="correoInput" value="<?= $psicologo['email'] ?>" readonly />

                            <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('correoInput')">Editar</a>
                        </div>
                    </div>
                    <div>
                        <h3 style="color:#49c691;font-size:17px;text-align:start;" for="celularInput">Celular / Telefono</h3>
                        <div style="display: flex; gap:30px;">
                            <input id="celularInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="text" name="celularInput" value="<?= $psicologo['celular'] ?>" readonly />
                            <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('celularInput')">Editar</a>
                        </div>
                    </div>
                    <div>
                        <h3 style="color:#49c691;font-size:17px;text-align:start;" for="contrasenaInput">Contraseña</h3>
                        <div style="display: flex; gap:30px;">
                            <input id="contrasenaInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="password" name="contrasenaInput" autocomplete="cc-number" value="<?= $psicologo['Passwords'] ?>" readonly />
                            <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('contrasenaInput')">Editar</a>
                        </div>
                    </div>

                    <div>
                        <h3 style="color:#49c691;font-size:17px;text-align:start;" for="videoInput">Link de Video:</h3>
                        <div style="display: flex; gap:30px;">
                            <input id="videoInput" style="background-color: #f6f6f9;padding:10px 15px; width:340px;border-radius:8px;margin-bottom: 10px;" type="text" name="videoInput" autocomplete="cc-number" value="<?= $psicologo['video'] ?>" readonly />
                            <a style="font-size:15px; padding:2px 15px" class="search Codigo" onclick="habilitarEdicion('videoInput')">Editar</a>
                        </div>
                    </div>


                    <!-- Agrega el siguiente botón de guardar al final del formulario -->
                    <input type="hidden" name="idPsicologo" value="<?= $_SESSION['IdPsicologo'] ?>">

                    <button style="font-size:15px; padding:2px 15px; margin-top:10px;" class="search Codigo" type="submit" name="guardarCambios" onclick="guardarCambios()">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

</body>


<script>
    // Mover el botón de cambio de tema al menú en pantallas pequeñas
    window.addEventListener('resize', function() {
        const externalModeControl = document.getElementById('external-mode-control');
        const internalModeControl = document.getElementById('internal-mode-control');
        const menuContent = document.getElementById('menu-content');

        if (window.innerWidth <= 768) {
            if (!menuContent.contains(externalModeControl)) {
                menuContent.appendChild(externalModeControl);
            }
        } else {
            if (!document.body.contains(externalModeControl)) {
                document.body.appendChild(externalModeControl);
            }
        }
    });

    // Ejecutar al cargar la página para asegurar que el botón esté en el lugar correcto
    window.dispatchEvent(new Event('resize'));
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('menu-btn').addEventListener('click', function() {
            toggleMenu();
        });
    });

    function toggleMenu() {
        var menuContent = document.getElementById('menu-content');
        menuContent.classList.toggle('hidden');
    }

    function cerrarSesion() {
        // Redirigir a la página de cierre de sesión
        window.location.href = '../Issets/views/Salir.php';
    }
</script>

<script>
    function habilitarEdicion(inputId) {
        var input = document.getElementById(inputId);
        input.readOnly = false;
    }

    function guardarCambios() {
        // Puedes agregar lógica adicional aquí si es necesario
        // Deshabilita la edición en todos los campos
        document.getElementById('nombreInput').readOnly = true;
        document.getElementById('usuarioInput').readOnly = true;
        document.getElementById('correoInput').readOnly = true;
        document.getElementById('celularInput').readOnly = true;
        document.getElementById('contrasenaInput').readOnly = true;
        document.getElementById('videoInput').readOnly = true;
        // ... (Deshabilita otros campos)
    }
</script>

<script>
    // Añade un evento para restablecer los campos a solo lectura al cerrar el modal
    document.querySelector('.closeaaa').addEventListener('click', function() {
        document.getElementById('nombreInput').readOnly = true;
        document.getElementById('usuarioInput').readOnly = true;
        document.getElementById('correoInput').readOnly = true;
        document.getElementById('celularInput').readOnly = true;
        document.getElementById('contrasenaInput').readOnly = true;
        document.getElementById('videoInput').readOnly = true;
        // ... (Restablece otros campos a solo lectura)
    });
</script>

<script>
    function setTheme(theme) {
        // Agregar o quitar la clase del tema oscuro según el tema
        document.documentElement.classList.toggle('dark-theme-variables', theme === 'dark');

        // Actualizar el estado activo de los botones
        const lightButton = document.querySelector('.theme-toggler span[data-theme="light"]');
        const darkButton = document.querySelector('.theme-toggler span[data-theme="dark"]');

        // Cambiar la clase 'active' y asegurarse de que los botones no se activen ambos
        if (theme === 'dark') {
            lightButton.classList.remove('active');
            darkButton.classList.add('active');
        } else {
            darkButton.classList.remove('active');
            lightButton.classList.add('active');
        }

        // Guardar el tema seleccionado en localStorage
        localStorage.setItem('theme', theme);
    }

    function initializeTheme() {
        // Leer el tema desde localStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
    }

    // Inicializar el tema cuando el documento se carga
    document.addEventListener('DOMContentLoaded', initializeTheme);

    // Añadir event listeners a los botones de cambio de tema
    document.querySelector('.theme-toggler span[data-theme="light"]').addEventListener('click', () => {
        setTheme('light');
    });
    document.querySelector('.theme-toggler span[data-theme="dark"]').addEventListener('click', () => {
        setTheme('dark');
    });
</script>

</html>