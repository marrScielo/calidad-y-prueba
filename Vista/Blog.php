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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Blog</title>
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
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen:</label>
                            <input type="url" id="image" name="image" placeholder="Ingrese URL de imagen" required>
                        </div>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </main>
            
        </div>
        <script src="../Issets/js/dashboard.js"></script>      
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
}
?>
