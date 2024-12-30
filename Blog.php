<?php
require_once './Controlador/BlogController.php';
require_once './Modelo/BlogModel.php';

$db = new DatabaseController();
$db->getConnection();

$blogControlador = new BlogController($db);

$limit = 6;  // Número de blogs por página
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$especialidadesSeleccionadas = isset($_GET['especialidades']) ? explode(',', $_GET['especialidades']) : [];
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$blogs = $blogControlador->show($limit, $offset, $especialidadesSeleccionadas, $searchTerm);
$totalBlogs = $blogControlador->getTotalBlogs($especialidadesSeleccionadas, $searchTerm);
$totalPages = ceil($totalBlogs / $limit);

$especialidades = [
    "Adicciones",
    "Ansiedad",
    "Atención",
    "Autoestima",
    "Crianza",
    "Depresión",
    "Enfermedades Cronicas",
    "Estrés",
    "Impulsividad",
    "Top",
    "Ira",
    "Terapia de Pareja",
    "Sexualidad",
    "Traumas",
    "Riesgo Suicida",
    "Sentido de vida",
    "Orientación Vocacional",
    "Problemas de sueño",
    "Problemas alimenticios",
    "Relaciones Interpersonales"
];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <meta name="description"
        content="Explora nuestro blog donde psicólogos profesionales comparten artículos, consejos y recursos sobre salud mental, bienestar emocional, terapia y más. Mantente informado y mejora tu calidad de vida con nuestros contenidos especializados.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/blog-seccion-principal.css">
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<style>
    .search-container h2 {
        margin-top: 10px;
        color: #a19ebb;
    }

    .dropdown-content.open {
        display: block;
    }
    
</style>

<body>
    <?php include 'Componentes/header.php'; ?>

    <section class="descripcion-blog">
        <h1>Blog de psicología</h1>
        <p>Contigo Voy es una plataforma de terapia online que cuenta con un amplio equipo de psicólogos expertos en
            terapia psicológica. En nuestro blog de Psicología encontrarás los mejores artículos de Salud Mental. Aquí
            están disponibles los mejores consejos para superar problemas emocionales y los mejores recursos para
            mejorar tu salud mental. Nuestro blog de Psicología es un espacio de conexión con el bienestar mental y el
            crecimiento personal. </p>
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
                    <div class="search-container">
                        <h2>Filtrar por Especialidad</h2>
                    </div>


                    <button type="button" class="dropbtn">CATEGORÍA <span class="arrow">&#9660;</span></button>
                    <div class="dropdown-content open">
                        <?php foreach ($especialidades as $especialidad): ?>
                            <div class="filter-option">
                                <input style="cursor: pointer;" type="checkbox" class="especialidad-checkbox"
                                    id="<?= htmlspecialchars($especialidad); ?>"
                                    value="<?= htmlspecialchars($especialidad); ?>">
                                <label
                                    for="<?= htmlspecialchars($especialidad); ?>"><?= htmlspecialchars($especialidad); ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </form>
        </div>

        <div class="container-left">
        <div id="mensaje-no-blogs-search" class="mensaje-no-blogs">
            No se encontró ningún blog en la búsqueda.
            </div>
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
                        // echo '<h3>' . htmlspecialchars($post['post_especialidad']) . '</h2>';
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
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="page-link">&laquo;</a> <!-- Símbolo de anterior -->
                <?php else: ?>
                    <span class="page-link disabled">&laquo;</span> <!-- Símbolo de anterior deshabilitado -->
                <?php endif; ?>

                <?php if ($page > 3): ?>
                    <a href="?page=1" class="page-link">1</a>
                    <span class="page-link">...</span>
                <?php endif; ?>

                <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="page-link<?php if ($i == $page)
                                                                            echo ' active'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages - 2): ?>
                    <span class="page-link">...</span>
                    <a href="?page=<?php echo $totalPages; ?>" class="page-link"><?php echo $totalPages; ?></a>
                <?php endif; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="page-link">&raquo;</a> <!-- Símbolo de siguiente -->
                <?php else: ?>
                    <span class="page-link disabled">&raquo;</span> <!-- Símbolo de siguiente deshabilitado -->
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'Componentes/footer_new.php'; ?>



    <script>
        document.addEventListener('DOMContentLoaded', function(e) {
        
          const searchInput = document.getElementById('search-input');
          const blogPosts = document.querySelectorAll('.blog-post');
          const noMessage = document.getElementById('mensaje-no-blogs-search');
          const especialidadCheckboxes = document.querySelectorAll('.especialidad-checkbox');

          searchInput.addEventListener('keydown', (e) => {
           if (e.key === 'Enter') e.preventDefault();
           });
          
         // Filtrar los posts según los filtros seleccionados
        function filterPosts() {
           const query = searchInput.value.toLowerCase();

        // Obtener las especialidades seleccionadas
        const selectedEspecialidades = Array.from(especialidadCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value.toLowerCase());

        let hasVisiblePosts = false;

        // Filtrar los posts por especialidad
        blogPosts.forEach(post => {
            const title = post.querySelector('h2').textContent.toLowerCase();
            const especialidad = post.getAttribute('data-especialidad').toLowerCase();

            // Verificar si el post coincide con los filtros
            const matchesEspecialidad = selectedEspecialidades.length === 0 || selectedEspecialidades.includes(especialidad);
            const matchesSearch = title.includes(query);

            // Mostrar u ocultar el post según los filtros
            if (matchesEspecialidad && matchesSearch) {
                post.style.display = 'block';
                hasVisiblePosts = true;
            } else {
                post.style.display = 'none';
            }
        });

        // Mostrar o ocultar el mensaje si no se encontraron resultados
        noMessage.style.display = hasVisiblePosts ? 'none' : 'block';
    }

    searchInput.addEventListener('input', filterPosts);
    document.getElementById('filter-form').addEventListener('change', filterPosts);

    // Filtrar los posts al cargar la página, para aplicar los filtros iniciales
    filterPosts();
});
    </script>

    <script src="js/navabar.js"></script>
    <?php include_once 'Componentes/chatbot.php'; ?>
	<a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="1.2em"
    fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
    </a>

    <!-- <script src="js/filtroEspecialidadBlog.js"></script> -->
</body>

</html>