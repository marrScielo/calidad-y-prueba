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
<style>

</style>
<!-- El resto de tu código HTML y JavaScript -->
<div class="top <?php echo ($theme === 'dark') ? 'dark-mode' : ''; ?>" id="top_fixed">
    <button id="menu-btn" style="display: none;">
        <span class="material-symbols-sharp" translate="no">menu</span>
    </button>
    <div class="theme-toggler">
        <span class="material-symbols-sharp active" data-theme="light" translate="no">light_mode</span>
        <span class="material-symbols-sharp" data-theme="dark" translate="no">dark_mode</span>
    </div>

    <div id="fixed_settings_container">
        <div id="fixed_settings">
            <a class="ajuste-info">
                <span class="material-symbols-sharp" translate="no">settings</span>
            </a>
        </div>
    </div>
    <div class="profile" id="profile_fixed">
        <div class="info">
            <div></div>
            <p><?= $_SESSION['NombrePsicologo'] ?></p>
            <div></div>
        </div>
    </div>
    <a href="../Issets/views/Salir.php">
        <h3 class="cerrar-info">Cerrar Sesion</h3>
    </a>
</div>
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

// Initialize theme when the document is loaded
document.addEventListener('DOMContentLoaded', initializeTheme);

// Add event listeners to the theme toggle buttons
document.querySelector('.theme-toggler span[data-theme="light"]').addEventListener('click', () => {
    // Si el botón de modo claro es clicado, cambiar a oscuro
    setTheme('dark');
});

document.querySelector('.theme-toggler span[data-theme="dark"]').addEventListener('click', () => {
    // Si el botón de modo oscuro es clicado, cambiar a claro
    setTheme('light');
});

</script>