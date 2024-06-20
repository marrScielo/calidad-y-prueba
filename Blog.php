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
    <link rel="stylesheet" href="css/blog-principal1.css">
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
                    "Depresión", "Enfermedades Cronicas", "Estrés", "Impulsividad", "Top",
                    "Ira", "Terapia de Pareja", "Sexualidad", "Traumas", "Riesgo Suicida",
                    "Sentido de vida", "Orientación Vocacional", "Problemas de sueño", "Problemas alimenticios", 
                    "Relaciones Interpersonales"
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
