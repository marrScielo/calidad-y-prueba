<?php

require_once './Controlador/BlogController.php';
require_once './Modelo/BlogModel.php';

$db = new DatabaseController();
$db->getConnection();

$blogControlador = new BlogController($db);

$limit = 6;  // Número de blogs por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$blogs = $blogControlador->show($limit, $offset);
$totalBlogs = $blogControlador->getTotalBlogs();
$totalPages = ceil($totalBlogs / $limit);

$especialidades = [
    "Adicciones", "Ansiedad", "Atención", "Autoestima", "Crianza",
    "Depresión", "Enfermedades Cronicas", "Estrés", "Impulsividad", "Top",
    "Ira", "Terapia de Pareja", "Sexualidad", "Traumas", "Riesgo Suicida",
    "Sentido de vida", "Orientación Vocacional", "Problemas de sueño", "Problemas alimenticios",
    "Relaciones Interpersonales"
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/inicio-header1.css">
    <link rel="stylesheet" href="css/blog1.css">
    <link rel="icon" href="img/logo-actual.png">
    <link rel="stylesheet" href="css/boton-wsp.css">
</head>

<body>

    <?php include 'Componentes/header.php'; ?>

    <div class="container-blog">
        <div class="container-rosado">
            <h2 onclick="toggleDropdownBlog()">Filtrar por Especialidad</h2>
            <form class="filter-form" id="filter-form">
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Buscar...">
                    <button type="button" id="search-button">Buscar</button>
                </div>
                <?php
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
            <div id="mensaje-no-blogs" class="mensaje-no-blogs">
                No se encontraron blogs con la especialidad seleccionada.
            </div>
            <div class="blog-posts" id="blog-posts">
                <?php
                if (empty($blogs)) {
                    echo "No se encontraron blogs registrados.";
                } else {
                    foreach ($blogs as $post) {
                        echo '<div class="blog-post" data-especialidad="' . htmlspecialchars($post['post_especialidad']) . '">';
                        echo '<a href="blog-details.php?id=' . intval($post['post_id']) . '">';
                        echo '<img src="' . htmlspecialchars($post['post_imagen']) . '" alt="' . htmlspecialchars($post['post_tema']) . '">';
                        echo '<h2>' . htmlspecialchars($post['post_tema']) . '</h2>';
                        echo '</a>';
                        echo '<p><strong>Especialidad:</strong> ' . htmlspecialchars($post['post_especialidad']) . '</p>';
                        echo '<p>' . htmlspecialchars($post['post_descripcion']) . '</p>';
                        echo '<p><strong>Publicado por Lic. </strong> ' . htmlspecialchars($post['psicologo_nombre']) . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>



            <!-- Paginación -->
            <div class="pagination">
                <?php if ($page > 1) : ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="page-link">&laquo; Anterior</a>
                <?php else : ?>
                    <span class="page-link disabled">&laquo; Anterior</span>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?php echo $i; ?>" class="page-link<?php if ($i == $page) echo ' active'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                <?php if ($page < $totalPages) : ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="page-link">Siguiente &raquo;</a>
                <?php else : ?>
                    <span class="page-link disabled">Siguiente &raquo;</span>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('filter-form').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.especialidad-checkbox');
            const selectedEspecialidades = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);

            const posts = document.querySelectorAll('.blog-post');
            let blogsEncontrados = false;
            posts.forEach(post => {
                const postEspecialidad = post.getAttribute('data-especialidad');
                if (selectedEspecialidades.length === 0 || selectedEspecialidades.includes(postEspecialidad)) {
                    post.style.display = 'block';
                    blogsEncontrados = true;
                } else {
                    post.style.display = 'none';
                }
            });
            if (!blogsEncontrados && selectedEspecialidades.length > 0) {
                mostrarMensajeNoBlogs();
            } else {
                ocultarMensajeNoBlogs();
            }
            if (selectedEspecialidades.length === 0) {
                ocultarMensajeNoBlogs();
            }
        });

        function mostrarMensajeNoBlogs() {
            document.getElementById("mensaje-no-blogs").style.display = "block";
        }

        function ocultarMensajeNoBlogs() {
            document.getElementById("mensaje-no-blogs").style.display = "none";
        }

        document.getElementById('search-button').addEventListener('click', function() {
            const searchInput = document.getElementById('search-input').value.toLowerCase();
            const posts = document.querySelectorAll('.blog-post');
            let blogsEncontrados = false;
            posts.forEach(post => {
                const postTitle = post.querySelector('h2').textContent.toLowerCase();
                const postDescription = post.querySelector('p').textContent.toLowerCase();
                if (postTitle.includes(searchInput) || postDescription.includes(searchInput)) {
                    post.style.display = 'block';
                    blogsEncontrados = true;
                } else {
                    post.style.display = 'none';
                }
            });
            if (!blogsEncontrados) {
                mostrarMensajeNoBlogs();
            } else {
                ocultarMensajeNoBlogs();
            }
        });
    </script>
    <script src="js/navabar.js"></script>
    <a href="https://wa.me/51915205726" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/filtroEspecialidadBlog.js"></script>

</body>

</html>