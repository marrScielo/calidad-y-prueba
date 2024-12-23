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
                    //Validacion de contraseña
                    $password = $_POST['password'];
                    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=]).{8,}$/';

                    if (!preg_match($pattern, $password)) {
                        $_SESSION['error'] = "La contraseña debe contener al menos una letra mayúscula, un símbolo, un número y tener al menos 8 caracteres.";
                        break;
                    }

                    //validacion si gmail ya existe
                    $email = $_POST['email'];
                    $stmt = $usuariosController->buscarPorEmail($email);
                    if ($stmt) {
                        $_SESSION['error'] = "El correo ya esta registrado, intenta con otro.";
                        break;
                    }

                    //Validacion de celular solo para psicologos
                    if ($_POST['rol'] == 'psicologo') {
                        if (!is_numeric($_POST['celular']) || strlen($_POST['celular']) != 9) {
                            $_SESSION['error'] = "El campo celular debe ser un número de 9 dígitos.";
                            break;
                        }
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
                    //Validacion de contraseña , cuando esta vacio el campo, se mantendra la contraseña actual, pero si se llena se validara.
                    if (!empty($_POST['password'])) {
                        $password = $_POST['password'];
                        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=]).{8,}$/';

                        if (!preg_match($pattern, $password)) {
                            $_SESSION['error'] = "La contraseña debe contener al menos una letra mayúscula, un símbolo, un número y tener al menos 8 caracteres.";
                            break;
                        }
                    }
                    
                      //Validacion de celular solo para psicologos
                      if ($_POST['rol'] == 'psicologo') {
                        if (!is_numeric($_POST['celular']) || strlen($_POST['celular']) != 9) {
                            $_SESSION['error'] = "El campo celular debe ser un número de 9 dígitos.";
                            break;
                        }
                    }
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
    <meta name="description" content="Gestión de usuarios en Contigo Voy">
    <title>Contigo Voy: Gestión de Usuarios</title>
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header class="header">
    <div class="container header-content">
        <div class="header-marca">
            <img src="img/favicon.png" alt="Logo" width="40" height="40">
            <h2>Contigo Voy</h2>
        </div>
        <form id="searchForm" method="GET" class="search-form">
            <input type="text" placeholder="Buscar por email" name="email" id="searchEmail">
            <button type="submit" class="btn" aria-label="Buscar">
                <i class="fa fa-search"></i> Buscar 
            </button>
        </form>
        <form action="usuarios.php" method="POST">
            <input type="hidden" name="accion" value="cerrar_sesion">
            <button type="submit" class="btn btn-logout" aria-label="Cerrar sesión">
                <i class="fa fa-sign-out-alt"></i> Cerrar sesión
            </button>
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
                <form action="usuarios.php" method="POST" enctype="multipart/form-data" onsubmit="return validateUserForm()">
                    <input type="hidden" name="accion" value="agregar">
                    <div class="form-group">
                        <label for="email">Email<span style="color: red;">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Example@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña<span style="color: red;">*</span></label>
                        <input type="password" id="password" name="password" placeholder="Introduce una contraseña de 8 digitos" >
                    </div>
                    <div class="form-group">
                        <label for="fotoPerfil">Foto de Perfil<span style="color: red;">*</span></label>
                        <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/*"  onchange="previewImage(event, 'preview')">
                        <img id="preview" src="#" alt="Vista previa de la imagen" style="display:none; max-width: 200px; margin-top: 10px;">
                    </div>
                    <div class="form-group">
                        <label for="rol_new_user">Rol<span style="color: red;">*</span></label>
                        <select name="rol" id="rol_new_user" >
                            <option value="" disabled selected>Seleccione un rol</option>
                            <option value="administrador">Administrador</option>
                            <option value="psicologo">Psicólogo</option>
                            <option value="marketing">Marketing</option>
                        </select>
                    </div>
                    <div id="psicologo_fields" style="display:none;">
                        <div class="form-group">
                            <label for="speciality_new_user">Especialidad<span style="color: red;">*</span></label>
                            <select name="speciality_new_user" id="speciality_new_user">
                                <option value="" disabled selected>Seleccione una especialidad</option>
                                <?php foreach ($especialidadesController->getEspecialidades() as $especialidad): ?>
                                    <option value="<?= htmlspecialchars($especialidad['id']) ?>"><?= htmlspecialchars($especialidad['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombrePsicologo">Nombre del Psicólogo<span style="color: red;">*</span></label>
                            <input type="text" id="nombrePsicologo" name="nombrePsicologo" placeholder="Introduce el nombre del psicólogo">
                        </div>
                        <div class="form-group">
                            <label for="video">URL del Video<span style="color: red;">*</span></label>
                            <input type="url" id="video" name="video" placeholder="Introduce la URL del video">
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular<span style="color: red;">*</span></label>
                            <input type="tel" id="celular" name="celular" placeholder="Introduce el número de celular">
                        </div>
                        <div class="form-group">
                            <label for="introduccion_new_user">Introducción<span style="color: red;">*</span></label>
                            <textarea id="introduccion_new_user" name="introduccion_new_user" placeholder="Escribe una breve introducción"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn" aria-label="Agregar Usuario"><i class="fas fa-user-plus"></i> Agregar Usuario</button>
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
                            <?php $usuarioCompleto = $usuariosController->buscarPorId($usuario['id']); ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['id']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><img src="<?= htmlspecialchars($usuario['fotoPerfil']) ?>" alt="Foto Perfil" class="user-image" width="40" height="40"></td>
                                <td><?= htmlspecialchars($usuario['rol']) ?></td>
                                <td>
                                    <button onclick="openEditModal(<?= htmlspecialchars(json_encode($usuarioCompleto)) ?>)" class="btn" aria-label="Editar Usuario"><i class="fas fa-edit"></i></button>
                                    <button onclick="openDeleteModal(<?= htmlspecialchars($usuario['id']) ?>)" class="btn btn-danger" aria-label="Eliminar Usuario"><i class="fas fa-trash-alt"></i></button>
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
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Editar Usuario</h2>
        <form id="editForm" action="usuarios.php" method="POST" enctype="multipart/form-data" onsubmit="return validateUserForm(true)">
            <input type="hidden" name="accion" value="actualizar">
            <input type="hidden" name="id" id="edit_id">
            <input type="hidden" name="fotoPerfilActual" id="fotoPerfilActual">
            <div class="form-group">
                <label for="edit_email">Email</label>
                <input type="email" id="edit_email" name="email" required>
            </div>
            <div class="form-group">
                <label for="edit_password">Nueva Contraseña (dejar en blanco para mantener la actual)</label>
                <input type="password" id="edit_password" name="password">
            </div>
            <div class="form-group">
                <label for="edit_fotoPerfil">Foto de Perfil</label>
                <input type="file" id="edit_fotoPerfil" name="fotoPerfil" accept="image/*" onchange="previewImage(event, 'edit_preview')">
                <img id="edit_preview" src="#" alt="Vista previa de la imagen" style="display:none; max-width: 200px; margin-top: 10px;">
            </div>
            <div class="form-group">
                <label for="edit_rol">Rol</label>
                <select name="rol" id="edit_rol" required onchange="toggleEditPsychologistFields(this.value)">
                    <option value="administrador">Administrador</option>
                    <option value="psicologo">Psicólogo</option>
                    <option value="marketing">Marketing</option>
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
            <button type="submit" class="btn" aria-label="Actualizar Usuario">
                <i class="fa fa-refresh"></i> Actualizar Usuario
            </button>
        </form>
    </div>
</div>

<!-- Modal de Eliminación -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2 style="text-align: center;">Confirmar Eliminación</h2>
        <p style="text-align: center;">¿Está seguro de que desea eliminar este usuario?</p>
        <form id="deleteForm" action="usuarios.php" method="POST" style="text-align: center;">
            <input type="hidden" name="accion" value="eliminar">
            <input type="hidden" name="id" id="delete_id">
            <button type="submit" class="btn btn-danger" style="margin: 10px;" aria-label="Eliminar Usuario"><i class="fas fa-trash-alt"></i> Eliminar</button>
            <button type="button" onclick="closeDeleteModal()" class="btn" style="margin: 10px;" aria-label="Cancelar Eliminación"><i class="fas fa-times"></i> Cancelar</button>
        </form>
    </div>
</div>

<script>
function validateUserForm(isEdit = false) {
    const email = document.getElementById(isEdit ? 'edit_email' : 'email');
    const password = document.getElementById(isEdit ? 'edit_password' : 'password');
    const fotoPerfil = document.getElementById(isEdit ? 'edit_fotoPerfil' : 'fotoPerfil');
    const rol = document.getElementById(isEdit ? 'edit_rol' : 'rol_new_user').value;
    const nombrePsicologo = document.getElementById(isEdit ? 'edit_nombrePsicologo' : 'nombrePsicologo');
    const video = document.getElementById(isEdit ? 'edit_video' : 'video');
    const celular = document.getElementById(isEdit ? 'edit_celular' : 'celular');
    const introduccion = document.getElementById(isEdit ? 'edit_introduccion_user' : 'introduccion_new_user');
    const speciality = document.getElementById(isEdit ? 'edit_especialidad_user' : 'speciality_new_user').value;

    let isValid = true;

        // Validacion de email
        if (email.value === '') {
            email.placeholder = 'Email es obligatorio';
            email.classList.add('error-placeholder');
            isValid = false;
        } else {
            email.classList.remove('error-placeholder');
        }

         // Validacion de contraseña solo para agregar usuario
        if (!isEdit || (isEdit && password.value !== '')) {
            if (password.value === '') {
                password.placeholder = 'Contraseña es obligatoria';
                password.classList.add('error-placeholder');
                isValid = false;
            } else if (password.value.length < 8) {
                password.placeholder = 'Contraseña debe tener al menos 8 caracteres';
                password.classList.add('error-placeholder');
                isValid = false;
            } else {
                password.classList.remove('error-placeholder');
            }
        }


        if (rol === 'psicologo') {
            // Validacion de campos de psicologo
            if (nombrePsicologo.value === '') {
                nombrePsicologo.placeholder = 'Nombre del psicólogo es obligatorio';
                nombrePsicologo.classList.add('error-placeholder');
                isValid = false;
            } else {
                nombrePsicologo.classList.remove('error-placeholder');
            }

            // Validacion de video
            if (video.value === '') {
                video.placeholder = 'URL del video es obligatoria';
                video.classList.add('error-placeholder');
                isValid = false;
            } else {
                video.classList.remove('error-placeholder');
            }

            // Validacion de celular
            if (celular.value === '') {
                celular.placeholder = 'Celular es obligatorio';
                celular.classList.add('error-placeholder');
                isValid = false;
            } else {
                celular.classList.remove('error-placeholder');
            }

            // Validacion de introduccion
            if (introduccion.value === '') {
                introduccion.placeholder = 'Introducción es obligatoria';
                introduccion.classList.add('error-placeholder');
                isValid = false;
            } else {
                introduccion.classList.remove('error-placeholder');
            }

        
        }

        return isValid;
    }

function clearValidationMessages(isEdit = false) {
    const email = document.getElementById(isEdit ? 'edit_email' : 'email');
    const password = document.getElementById(isEdit ? 'edit_password' : 'password');
    const nombrePsicologo = document.getElementById(isEdit ? 'edit_nombrePsicologo' : 'nombrePsicologo');
    const video = document.getElementById(isEdit ? 'edit_video' : 'video');
    const celular = document.getElementById(isEdit ? 'edit_celular' : 'celular');
    const introduccion = document.getElementById(isEdit ? 'edit_introduccion_user' : 'introduccion_new_user');

    email.classList.remove('error-placeholder');
    password.classList.remove('error-placeholder');
    nombrePsicologo.classList.remove('error-placeholder');
    video.classList.remove('error-placeholder');
    celular.classList.remove('error-placeholder');
    introduccion.classList.remove('error-placeholder');

    email.placeholder = 'Example@gmail.com';
    password.placeholder = 'Introduce una contraseña de 8 digitos';
    nombrePsicologo.placeholder = 'Introduce el nombre del psicólogo';
    video.placeholder = 'Introduce la URL del video';
    celular.placeholder = 'Introduce el número de celular';
    introduccion.placeholder = 'Escribe una breve introducción';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function openEditModal(usuario) {
    clearValidationMessages(true);
    document.getElementById('edit_id').value = usuario.id;
    document.getElementById('edit_email').value = usuario.email;
    document.getElementById('edit_rol').value = usuario.rol;
    document.getElementById('edit_preview').src = usuario.fotoPerfil;
    document.getElementById('edit_preview').style.display = 'block';
    document.getElementById('fotoPerfilActual').value = usuario.fotoPerfil;
    toggleEditPsychologistFields(usuario.rol);
    if (usuario.rol === 'psicologo') {
        document.getElementById('edit_especialidad_user').value = usuario.especialidad_id || '';
        document.getElementById('edit_nombrePsicologo').value = usuario.NombrePsicologo || '';
        document.getElementById('edit_video').value = usuario.video || '';
        document.getElementById('edit_celular').value = usuario.celular || '';
        document.getElementById('edit_introduccion_user').value = usuario.introduccion || '';
    }
    document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
    clearValidationMessages(true);
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

// Función para previsualizar la imagen seleccionada
function previewImage(event, previewId) {
    const preview = document.getElementById(previewId);
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function() {
        preview.src = reader.result;
        preview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
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