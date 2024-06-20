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
        <link rel="stylesheet" href="blogpsico.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .form-container {
                background-color: #e0f7fa;
                padding: 20px;
                border-radius: 10px;
                max-width: 600px;
                margin: 20px auto;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-group label {
                display: block;
                margin-bottom: 5px;
            }
            .form-group input, .form-group select, .form-group textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            button {
                display: block;
                width: 100%;
                padding: 10px;
                background-color: #49c691;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            button:hover {
                background-color: #45a67d;
            }
        </style>
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
                    <form action="submit_blog.php" method="POST">
                        <div class="form-group">
                            <label for="topic">Tema:</label>
                            <input type="text" id="topic" name="topic" required>
                        </div>
                        <div class="form-group">
                            <label for="specialty">Especialidad:</label>
                            <select id="specialty" name="specialty" required>
                                <option value="Adicciones">Adicciones</option>
                                <option value="Ansiedad">Ansiedad</option>
                                <option value="Atención">Atención</option>
                                <option value="Autoestima">Autoestima</option>
                                <option value="Crianza">Crianza</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen URL:</label>
                            <input type="url" id="image" name="image" required>
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
