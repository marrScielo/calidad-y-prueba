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
            flex: 0 1 calc(25% - 20px); /* Calcula el ancho para cuatro columnas */
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .blog-post img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .blog-post h2 {
            margin-top: 0;
            margin-bottom: 5px;
        }
        .blog-post p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php include 'Componentes/header.php'; ?>

    <div class="container">
        <h1>Últimos Artículos del Blog</h1>
        
        <div class="blog-posts">
            <?php
                if( empty($blogs) ){
                    echo "No se encontraron blogs registrados.";
                }
                else{
                    foreach ($blogs as $post) {
                        echo '<div class="blog-post">';
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

    <script src="js/script.js"></script> <!-- Asegúrate de incluir tu archivo JavaScript si lo tienes -->
</body>
</html>
