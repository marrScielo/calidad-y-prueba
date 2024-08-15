<?php
require_once './Controlador/BlogController.php';
require_once './Modelo/BlogModel.php';

$db = new DatabaseController();
$db->getConnection();

$blogControlador = new BlogController($db);

$limit = 6;  // Número de blogs por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$especialidadesSeleccionadas = isset($_GET['especialidades']) ? explode(',', $_GET['especialidades']) : [];
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$blogs = $blogControlador->show($limit, $offset, $especialidadesSeleccionadas, $searchTerm);
$totalBlogs = $blogControlador->getTotalBlogs($especialidadesSeleccionadas, $searchTerm);
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <meta name="description" content="Explora nuestro blog donde psicólogos profesionales comparten artículos, consejos y recursos sobre salud mental, bienestar emocional, terapia y más. Mantente informado y mejora tu calidad de vida con nuestros contenidos especializados.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/blog1.css">
    <link rel="icon" href="img/Logo.png">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        @media (max-width: 768px) {
            .filter-form {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }

            .blog-post {
                width: 17rem;
            }

            .blog-posts {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .pagination .page-link:not(.active):not(.disabled) {
                display: none;
            }

            .pagination .page-link.active {
                display: inline-block;
            }

            .pagination .page-link:first-child,
            .pagination .page-link:last-child {
                display: inline-block;
            }

            .pagination .page-link:first-child+.page-link,
            .pagination .page-link:last-child+.page-link {
                display: inline-block;
            }

            .pagination .page-link:first-child+.page-link+.page-link,
            .pagination .page-link:last-child+.page-link+.page-link {
                display: inline-block;
            }

            .pagination .page-link:first-child+.page-link+.page-link+.page-link,
            .pagination .page-link:last-child+.page-link+.page-link+.page-link {
                display: none;
            }

            .pagination .page-link:first-child+.page-link+.page-link+.page-link+.page-link {
                display: inline-block;
            }

            .pagination .page-link:last-child+.page-link+.page-link+.page-link+.page-link {
                display: inline-block;
            }
        }

        @media (max-width: 550px) {
            .container-rosado {
                box-shadow: none !important;
            }

            .container-celeste {
                padding: 0px !important;
            }

            .blog-post {
                text-align: center;
                width: 90%;
                margin: 0 auto;
            }

            .blog-posts {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                gap: 20px;
            }

            .filter-option {
                display: none;
            }

            .pagination .page-link:not(.active):not(.disabled) {
                display: none;
            }

            .pagination .page-link.active {
                display: inline-block;
            }

            .pagination .page-link:first-child,
            .pagination .page-link:last-child {
                display: inline-block;
            }

            .pagination .page-link:first-child+.page-link,
            .pagination .page-link:last-child+.page-link {
                display: inline-block;
            }

            .pagination .page-link:first-child+.page-link+.page-link,
            .pagination .page-link:last-child+.page-link+.page-link {
                display: inline-block;
            }

            .pagination .page-link:first-child+.page-link+.page-link+.page-link,
            .pagination .page-link:last-child+.page-link+.page-link+.page-link {
                display: none;
            }

            .pagination .page-link:first-child+.page-link+.page-link+.page-link+.page-link {
                display: inline-block;
            }

            .pagination .page-link:last-child+.page-link+.page-link+.page-link+.page-link {
                display: inline-block;
            }
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php include 'Componentes/header.php'; ?>

    <section class="descripcion-blog">
        <h1>Blog de psicología</h1>
        <p>Contigo Voy es una plataforma de terapia online que cuenta con un amplio equipo de psicólogos expertos en terapia psicológica. En nuestro blog de Psicología encontrarás los mejores artículos de Salud Mental. Aquí están disponibles los mejores consejos para superar problemas emocionales y los mejores recursos para mejorar tu salud mental. Nuestro blog de Psicología es un espacio de conexión con el bienestar mental y el crecimiento personal. </p>
    </section>

    <div class="container-blog">
        <div class="container-right">
            <!-- <h2>Filtrar por Especialidad</h2> -->
            <form class="filter-form" id="filter-form">
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Buscar...">
                </div>

               <!-- Dropdown para las categorías -->
                <div class="dropdown">
                    <button type="button" class="dropbtn">CATEGORÍA &#9660;</button> <!-- Botón desplegable -->
                    <div class="dropdown-content">
                        <?php foreach ($especialidades as $especialidad) : ?>
                            <div class="filter-option">
                                <input style="cursor: pointer;" type="checkbox" class="especialidad-checkbox" id="<?= htmlspecialchars($especialidad); ?>" value="<?= htmlspecialchars($especialidad); ?>">
                                <label for="<?= htmlspecialchars($especialidad); ?>"><?= htmlspecialchars($especialidad); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </form>
        </div>

        <div class="container-left">
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
                        echo '<p>✍ ' . htmlspecialchars($post['psicologo_nombre']) . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

            <!-- Paginación -->
            <div class="pagination">
                <?php if ($page > 1) : ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="page-link">&laquo;</a> <!-- Símbolo de anterior -->
                <?php else : ?>
                    <span class="page-link disabled">&laquo;</span> <!-- Símbolo de anterior deshabilitado -->
                <?php endif; ?>

                <?php if ($page > 3) : ?>
                    <a href="?page=1" class="page-link">1</a>
                    <span class="page-link">...</span>
                <?php endif; ?>

                <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++) : ?>
                    <a href="?page=<?php echo $i; ?>" class="page-link<?php if ($i == $page) echo ' active'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages - 2) : ?>
                    <span class="page-link">...</span>
                    <a href="?page=<?php echo $totalPages; ?>" class="page-link"><?php echo $totalPages; ?></a>
                <?php endif; ?>

                <?php if ($page < $totalPages) : ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="page-link">&raquo;</a> <!-- Símbolo de siguiente -->
                <?php else : ?>
                    <span class="page-link disabled">&raquo;</span> <!-- Símbolo de siguiente deshabilitado -->
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'Componentes/footer_new.php'; ?>

    <script>
        document.querySelector('.dropbtn').addEventListener('click', function () {
            const dropdownContent = document.querySelector('.dropdown-content');
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        });

        document.getElementById('filter-form').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('.especialidad-checkbox');
            const selectedEspecialidades = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);
            const searchTerm = document.getElementById('search-input').value.toLowerCase();

            // Construir la query string
            let queryString = `?page=1`;
            if (selectedEspecialidades.length > 0) {
                queryString += `&especialidades=${selectedEspecialidades.join(',')}`;
            }
            if (searchTerm) {
                queryString += `&search=${encodeURIComponent(searchTerm)}`;
            }

            // Recargar la página con los filtros aplicados
            window.location.href = window.location.pathname + queryString;
        });

        function mostrarMensajeNoBlogs() {
            document.getElementById("mensaje-no-blogs").style.display = "block";
        }

        function ocultarMensajeNoBlogs() {
            document.getElementById("mensaje-no-blogs").style.display = "none";
        }
    </script>

    <script src="js/navabar.js"></script>
    <a href="https://wa.me/51915205726" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/filtroEspecialidadBlog.js"></script>
</body>

</html>