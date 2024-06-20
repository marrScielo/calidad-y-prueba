<?php

require_once './Controlador/BlogController.php';
require_once './Modelo/BlogModel.php';

$db = new DatabaseController();
$db->getConnection();

$blogControlador = new BlogController($db);
$blogs = $blogControlador->show();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="css/inicio-header.css">
    <style>
        /* Estilos específicos para los posts del blog */
        .blog-posts {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Espacio entre los posts */
        }
        .blog-post {
            flex: 0 1 calc(30% - 20px); /* Calcula el ancho para cuatro columnas */
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 10px; /* Bordes redondeados */
            transition: transform 0.2s; /* Transición suave al pasar el ratón */
        }
        .blog-post:hover {
            transform: scale(1.05); /* Agrandar ligeramente al pasar el ratón */
        }
        .blog-post img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 10px; /* Bordes redondeados */
        }
        .blog-post h2 {
            margin-top: 0;
            margin-bottom: 5px;
            font-size: 1.5em;
            color: #333;
        }
        .blog-post p {
            margin-bottom: 10px;
            color: #555;
        }
        .container {
            display: flex;
            gap: 20px; /* Espacio entre los contenedores */
        }
        .container-rosado {
            padding: 20px;
            flex: 1; /* Toma 1 parte del espacio disponible */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
            transition: background-color 0.3s;
        }
        .container-rosado h2 {
            color: #ff6f61; /* Color del texto */
            font-family: 'Arial', sans-serif; /* Fuente personalizada */
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
        }
        .filter-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            background-color: #ffe5e5;
            padding: 10px;
            border-radius: 5px; /* Bordes redondeados */
        }
        .filter-option input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2); /* Agrandar el checkbox */
        }
        .filter-option label {
            font-size: 16px;
            color: #555; /* Color del texto */
            transition: color 0.3s;
        }
        .filter-option:hover label {
            color: #000; /* Color del texto al pasar el ratón */
        }
        .container-celeste {
            padding: 20px;
            flex: 3; /* Toma 3 partes del espacio disponible */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
            transition: background-color 0.3s;
        }
        .container-celeste h1 {
            font-family: 'Arial', sans-serif; /* Fuente personalizada */
            font-size: 2em;
            color: #add8e6;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include 'Componentes/header.php'; ?>

    <div class="container">
        <div class="container-rosado">
            <!-- Contenido del contenedor rosado -->
            <h2>Filtrar por Especialidad</h2>
            <form id="filter-form">
                <?php
                // Generar 20 checkbox para diferentes especialidades
                $especialidades = [
                    "Adicciones", "Ansiedad", "Atención", "Autoestima", "Crianza",
                    "Especialidad 6", "Especialidad 7", "Especialidad 8", "Especialidad 9", "Especialidad 10",
                    "Especialidad 11", "Especialidad 12", "Especialidad 13", "Especialidad 14", "Especialidad 15",
                    "Especialidad 16", "Especialidad 17", "Especialidad 18", "Especialidad 19", "Especialidad 20"
                ];

                foreach ($especialidades as $especialidad) {
                    echo '<div class="filter-option">';
                    echo '<input type="checkbox" class="especialidad-checkbox" value="' . htmlspecialchars($especialidad) . '">';
                    echo '<label>' . htmlspecialchars($especialidad) . '</label>';
                    echo '</div>';
                }
                ?>
            </form>
        </div>
        
        <div class="container-celeste">
            <h1>Últimos Artículos del Blog</h1>
            
            <div class="blog-posts" id="blog-posts">
                <?php
                    if( empty($blogs) ){
                        echo "No se encontraron blogs registrados.";
                    }
                    else{
                        foreach ($blogs as $post) {
                            echo '<div class="blog-post" data-especialidad="' . htmlspecialchars($post['post_especialidad']) . '">';
                            echo '<img src="' . htmlspecialchars($post['post_imagen']) . '" alt="' . htmlspecialchars($post['post_tema']) . '">';
                            echo '<h2>' . htmlspecialchars($post['post_tema']) . '</h2>';
                            echo '<p><strong>Especialidad:</strong> ' . htmlspecialchars($post['post_especialidad']) . '</p>';
                            echo '<p>' . htmlspecialchars($post['post_descripcion']) . '</p>';
                            echo '<p><strong>Publicado por Lic. </strong> ' . htmlspecialchars($post['psicologo_nombre']) . '</p>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        // JavaScript para filtrar los blogs por especialidad
        document.getElementById('filter-form').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.especialidad-checkbox');
            const selectedEspecialidades = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
            
            const posts = document.querySelectorAll('.blog-post');
            posts.forEach(post => {
                const postEspecialidad = post.getAttribute('data-especialidad');
                if (selectedEspecialidades.length === 0 || selectedEspecialidades.includes(postEspecialidad)) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
