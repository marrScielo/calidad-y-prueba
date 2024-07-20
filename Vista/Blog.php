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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />
        <link rel="stylesheet" href="../Issets/css/historial.css">
        <link rel="stylesheet" href="../Issets/css/main.css">
        <link rel="stylesheet" href="../Issets/css/blogpsico.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <title>Blog</title>
        <style>
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


            /* Media queries para dispositivos móviles */
            @media only screen and (max-width: 600px) {
                .form-container {
                    padding: 10px;
                    margin: 1px;
                    margin-left: -30px;
                    max-width: 100%;
                    box-shadow: none;
                }

                .form-group label {
                    font-size: 14px;
                }

                .form-group input,
                .form-group select,
                .form-group textarea {
                    font-size: 14px;
                    padding: 8px;
                }

                button {
                    font-size: 14px;
                    padding: 8px;
                }

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
                .form-container {
                    padding: 15px;
                    margin: 15px;
                    max-width: 90%;
                    box-shadow: none;
                }

                .form-group label {
                    font-size: 16px;
                }

                .form-group input,
                .form-group select,
                .form-group textarea {
                    font-size: 16px;
                    padding: 10px;
                }

                button {
                    font-size: 16px;
                    padding: 10px;
                }

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
                    <h4 style="color: #49c691;">Blog</h4>
                    <?php
                    require_once '../Issets/views/Info.php';
                    ?>
                </div>
                <div class="form-container">
                    <a class="button-arriba" style="padding: 10px 30px; font-size: 15px;" href="PanelBlog.php">
                        <i id="edit-icon" class="fas fa-edit" style="margin-right: 10px;"></i>Editar y Ver Blogs
                    </a>
                    <form action="submit_blog.php" method="POST">
                        <div class="form-group">
                            <label for="topic">Tema:</label>
                            <input type="text" id="topic" name="topic" placeholder="Ingrese tema" required>
                        </div>
                        <div class="form-group">
                            <label for="specialty">Especialidad:</label>
                            <select id="specialty" name="specialty" required>
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
                        <div style="text-align: start" id="formtext" class="form-group">
                            <label style="text-align: center;" for="description">Descripción:</label>
                            <!--<textarea id="description" name="description" rows="4" required></textarea>-->
                            <textarea style="text-align: start;" id="summernote" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen:</label>
                            <input type="url" id="image" name="image" placeholder="Ingrese URL de imagen" required>
                        </div>
                        <button style="
                            display: block;
                            width: 100%;
                            padding: 10px;
                            background-color: #49c691;
                            color: #fff;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer; " id="#button1" type="submit">Enviar</button>
                    </form>
                </div>
            </main>

        </div>
        <script src="../Issets/js/dashboard.js"></script>
        <script>
            $('#summernote').summernote({
                placeholder: 'Comienza a ecribir tu post',
                tabsize: 2,
                height: 180,
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
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
}
?>