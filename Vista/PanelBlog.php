<?php
session_start();
if (isset($_SESSION['NombrePsicologo'])) {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Issets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="../Issets/css/historial.css">
    <link rel="stylesheet" href="../Issets/css/main.css">
    <link rel="stylesheet" href="../Issets/css/blogpsico.css">
    <link rel="stylesheet" href="../Issets/css/panelblog.css">
    <link rel="icon" href="../img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- summernote -->
     <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>

    <title>Panel de Blogs</title>
    <style>
    /* Estilos para tablets (pantallas de hasta 768px de ancho) */
    @media (max-width: 768px) {
        th,
        td {
            font-size: 14px;
            padding: 8px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .action-buttons a {
            padding: 5px;
            font-size: 14px;
        }

        .modal-content {
            width: 100%;
            padding: 15px;
        }

        .modal-body input,
        .modal-body textarea {
            font-size: 14px;
            padding: 8px;
        }

        .modal-footer button {
            font-size: 14px;
            padding: 8px 15px;
        }

        #profile_fixed {
            display: none;
        }
    }

    /* Media queries para dispositivos móviles */
    @media only screen and (max-width: 600px) {
        th,
        td {
            font-size: 12px;
            padding: 5px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 3px;
        }

        .action-buttons a {
            padding: 3px;
            font-size: 12px;
        }

        .modal-content {
            width: 100%;
            padding: 10px;
        }

        .modal-body input,
        .modal-body textarea {
            font-size: 12px;
            padding: 5px;
        }

        .modal-footer button {
            font-size: 12px;
            padding: 5px 10px;
        }


        .center-divs h4 {
            font-size: 25px;
            width: 250px;
        }

        #top_fixed {
            margin-left: -25px;
            font-size: 10px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 5px;
        }

        #profile_fixed {
            display: none;
        }

        .cerrar-info {
            width: 130px;
            margin-left: -20px;
            margin-right: 5px;
        }


    }
  </style>
</head>

<body>
    <?php
        require_once("../Controlador/Paciente/ControllerPaciente.php");
        $Pac = new usernameControlerPaciente();
        $patients = $Pac->showCompletoAtencion($_SESSION['IdPsicologo']);
        ?>
    <div class="container">
        <?php
            require_once '../Issets/views/Menu.php';
            ?>
        <!----------- end of aside -------->
        <main class="animate_animated animate_fadeIn">
            <div class="center-divs">
                <h4 style="color: #534489;">Panel de Blogs</h4>
                <?php
                    require_once '../Issets/views/Info.php';
                    ?>
            </div>
            <div class="form-container">
                <table class="table__blog">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tema</th>
                            <th>Especialidad</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once '../Controlador/DatabaseController.php';
                            $dbController = new DatabaseController();
                            $conn = $dbController->getConnection();
                            $psicologo_id = $_SESSION['IdPsicologo'];
                            $sql = "SELECT id, tema, especialidad, descripcion, imagen FROM posts WHERE psicologo_id = :psicologo_id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':psicologo_id', $psicologo_id, PDO::PARAM_INT);
                            $stmt->execute();
                            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($posts as $post) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($post['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($post['tema']) . "</td>";
                                echo "<td>" . htmlspecialchars($post['especialidad']) . "</td>";
                                echo "<td><img src='" . htmlspecialchars($post['imagen']) . "' alt='Imagen del blog' class='small-img'></td>";
                                echo "<td class='action-buttons'>";
                                echo "<a href='#' class='edit-button' data-id='" . htmlspecialchars($post['id']) . "' data-tema='" . htmlspecialchars($post['tema']) . "' data-especialidad='" . htmlspecialchars($post['especialidad']) . "' data-descripcion='" . htmlspecialchars($post['descripcion']) . "' data-imagen='" . htmlspecialchars($post['imagen']) . "'>Editar</a>";
                                echo "<a href='delete_blog.php?id=" . htmlspecialchars($post['id']) . "' class='delete-button'>Eliminar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>

                <a class="button-arriba" href="Blog.php">
                    <i id="search-icon" class="fas fa-arrow-circle-left add-icon" style="margin-right: 10px;"></i>Volver
                </a>
            </div>
        </main>
    </div>

    <!-- The Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar Post</h2>
                <span class="close salir" >&times;</span>
            </div>
            <div class="modal-body">
                <form id="editForm" action="edit_blog_process.php" method="post">
                    <input type="hidden" name="id" id="editId">
                    <div class="margen">
                        <label for="editTema">Tema:</label>
                        <input type="text" name="tema" id="editTema">
                    </div>
                    <div class="margen">
                        <label for="editEspecialidad">Especialidad:</label>
                        <select type="text" name="especialidad" id="editEspecialidad">
                            <option value="Adicciones">Selecciona la Especialidad</option>
                            <option value="Adicciones">Adicciones</option>
                            <option value="Ansiedad">Ansiedad</option>
                            <option value="Atención">Atención</option>
                            <option value="Autoestima">Autoestima</option>
                            <option value="Crianza">Crianza</option>
                            <option value="Depresión">Depresión</option>
                            <option value="Enfermedades Cronicas">Enfermedades Cronicas</option>
                            <option value="Estrés">Estrés</option>
                            <option value="Impulsividad">Impulsividad</option>
                            <option value="Top">Top</option>
                            <option value="Ira">Ira</option>
                            <option value="Terapia de Pareja">Terapia de Pareja</option>
                            <option value="Sexualidad">Sexualidad</option>
                            <option value="Traumas">Traumas</option>
                            <option value="Riesgo Suicida">Riesgo Suicida</option>
                            <option value="Sentido de vida">Sentido de vida</option>
                            <option value="Orientación Vocacional">Orientación Vocacional</option>
                            <option value="Problemas de sueño">Problemas de sueño</option>
                            <option value="Problemas alimenticios">Problemas alimenticios</option>
                            <option value="Relaciones Interpersonales">Relaciones Interpersonales</option>
                        </select>
                    </div>
                    <div class="margen">
                        <label for="editDescripcion">Descripción:</label>
                        <!-- NEW CODE -->
                        <div   id="summernote" >
                        </div>
                            <textarea id="editDescripcion" name="descripcion" class="hidden" style="display: none;" ></textarea>
                            <span class="error-message" id="error-description"></span>
                    </div>
                    <div class="margen">
                        <label for="editImagen">Imagen:</label>
                        <input type="text" name="imagen" id="editImagen">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel close"></button>
                        <button type="submit" class="btn-save">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <script type="module" src="../Issets/js/textarea-function.js"></script>
        <script>
            $('#summernote').summernote({
                placeholder: 'Ingrese la descripción del blog',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style','bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript','fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                    ['misc', ['undo', 'redo']]
                ]
            });          

            $("#summernote").on("summernote.change", function () {
                var description = $('#summernote').summernote('code');
                const texto = document.querySelector('#editDescripcion').value = description;
                // console.log(texto);
                validateDescription(description);
            });

            // Función para validar la descripción
            function validateDescription(content) {
                const cleanText = $('<div>').html(content).text().trim();
                
                if (cleanText === '') {
                    $('#error-description').text('Por favor, ingrese una descripción.').show();
                } else {
                    $('#error-description').hide();
                }
            }
        </script>


    <script>
    // JavaScript para manejar el modal de edición

    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("editModal");
        var closeElements = document.getElementsByClassName("close");
        var editButtons = document.querySelectorAll('.edit-button');
        const textDescription = document.querySelector('.note-editable');

        editButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var tema = this.getAttribute('data-tema');
                var especialidad = this.getAttribute('data-especialidad');
                var descripcion = this.getAttribute('data-descripcion');
                var imagen = this.getAttribute('data-imagen');
                console.log(descripcion)
                document.getElementById('editId').value = id;
                document.getElementById('editTema').value = tema;
                document.getElementById('editEspecialidad').value = especialidad;
                document.getElementById('editDescripcion').value = descripcion;
                textDescription.innerHTML = descripcion;
                document.getElementById('editImagen').value = imagen;

                modal.style.display = "flex";
            });
        });

        Array.from(closeElements).forEach(element => {
            element.addEventListener('click', function() {
                modal.style.display = "none";
            });
        });

        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    });
    </script>

    <script src="../Issets/js/dashboard.js"></script>
</body>

</html>
<?php
} else {
    header("Location: ../index.php");
}
?>