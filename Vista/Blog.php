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
        <link rel="stylesheet" href="../Issets/css/summernote.css">
        <link rel="icon" href="../img/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- summernote -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
            </script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <title>Blog</title>
        <style>
            #form-group input {
                background-color: black;
            }

            .hidden {
                display: none;
            }

            .modal textarea {
                width: 100%;
                height: 100px;
            }

            .cerrar-info:hover {
                color: #49c691;
            }

            #formtext h1,
            #formtext h2,
            #formtext h3,
            #formtext h4,
            #formtext h5,
            #formtext h6 {
                all: unset !important;
                /* Elimina todos los estilos personalizados */
                display: block !important;
                /* Restablece el comportamiento de bloque */
                font-size: revert !important;
                /* Restablece el tamaño de fuente al valor predeterminado del navegador */
                font-weight: revert !important;
                /* Restablece el grosor de la fuente al valor predeterminado */
                margin: revert !important;
                /* Restablece los márgenes al valor predeterminado */
                padding: revert !important;
                /* Restablece el relleno al valor predeterminado */
                color: revert !important;
                /* Restablece el color al valor predeterminado */
                text-align: revert !important;
                /* Restablece la alineación del texto al valor predeterminado */
                line-height: revert;
                /* Restablece la altura de línea al valor predeterminado */
            }

            @media (max-width: 900px) {
                .animate_animated {
                    overflow: auto;
                    padding-left: 5px;
                }
            }

            /* Media queries para dispositivos móviles */
            @media only screen and (max-width: 600px) {

                .modal-content,
                .modal-content-detail {
                    width: 90%;
                    padding: 10px;
                }

                #top_fixed {
                    margin-left: 20px;
                    font-size: 10px;
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 5px;
                    margin-top: 8px;
                }

                #profile_fixed {
                    display: none;
                }

                .cerrar-info {

                    width: 130px;
                    margin-left: 10px;
                }

            }

            /* Media queries para tabletas */
            @media only screen and (min-width: 601px) and (max-width: 1024px) {

                .modal-content,
                .modal-content-detail {
                    width: 80%;
                    padding: 15px;
                }

                #top_fixed {
                    margin-top: 8px;
                }

                #profile_fixed {
                    display: none;
                }    
            }

            .button-arriba {
                max-width: 90%;
                margin-inline: auto;
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
                    <h4 style="color: #534489;">Blog</h4>
                    <?php
                    require_once '../Issets/views/Info.php';
                    ?>
                </div>
                <div class="form-container">
                    <a class="button-arriba" href="PanelBlog.php">
                        <i id="edit-icon" class="fas fa-edit" style="margin-right: 10px;"></i>Editar y Ver Blogs
                    </a>
                    <form class="form__blog" action="submit_blog.php" method="POST">
                        <div class="form-group">
                            <label for="topic">Tema:</label>
                            <input type="text" id="topic" name="topic" placeholder="Ingrese tema" >
                            <span class="error-message" id="error-topic"></span>
                        </div>
                        <div class="form-group">
                            <label for="specialty">Especialidad:</label>
                            <select id="specialty" name="specialty" >
                                <option value="">Selecciona la Especialidad</option>
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
                            <span class="error-message" id="error-specialty"></span>
                        </div>
                        <div style="text-align: start;" id="formtext" class="form-group">
                            <label style="text-align: center;" for="description">Descripción:</label>
                            <div id="summernote">
                            </div>
                            <textarea id="description" name="description" class="hidden"></textarea>
                            <span class="error-message" id="error-description"></span>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen:</label>
                            <input type="url" id="image" name="image" placeholder="Ingrese URL de imagen" >
                            <span class="error-message" id="error-image"></span>
                        </div>
                        <button id="button1" type="submit">Enviar</button>
                    </form>
                </div>
            </main>

        </div>
        <script src="../Issets/js/dashboard.js"></script>
        <script type="module" src="../Issets/js/textarea-function.js"></script>
        <script>
            $('#summernote').summernote({
                placeholder: 'Ingrese la descripción del blog',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });          

            $("#summernote").on("summernote.change", function () {
                var description = $('#summernote').summernote('code');
                const texto = document.querySelector('#description').value = description;
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
        <script src="../Issets/js/validationMessage.js"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../index.php");
}
?>