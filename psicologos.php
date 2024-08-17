<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--  Estilos propios -->
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/estilos-footer.css">
    <link rel="stylesheet" href="css/psico-estilo.css">
    <link rel="icon" href="img/Logo.png">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Google fonts -->

    <title>Psicologos</title>
    <meta name="description" content="Reserva tu cita con nuestro psicólogo profesional. Encuentra información sobre su especialidad, contacto y disponibilidad. Comienza tu camino hacia el bienestar emocional con una consulta personalizada.">
</head>

<body>
    <?php include 'Componentes/header.php'; ?>

    <div class="section-container">
        <div class="right-section">
            <div class="intro-container">
                <h2 class="title">NUESTRO EQUIPO</h2>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Buscar...">
                    <button type="button" id="searchButton">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <p class="p-introduction">
                Estamos aquí para ayudarle a alcanzar su máximo bienestar emocional. Nuestro equipo está formado por profesionales altamente capacitados en diversas áreas de la psicología, listos para brindarle el apoyo que necesita. ¡Cada uno de nuestros psicólogos tiene una vasta experiencia en tratamientos y terapias que abarcan desde problemas emocionales y de conducta hasta orientación y asesoramiento en todas las etapas de la vida! ¡Permítanos ser su guía hacia una vida más equilibrada y feliz!
            </p>
            <div id="psicologos-container" class="psicologo-row">
                <?php include 'Modelo/PsicologoModel.php'; ?>
            </div>

            <div class="pagination">
                <?php
                // Parámetros de paginación
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                $total_pages = isset($total_pages) ? $total_pages : 1;

                // Botón Anterior
                if ($page > 1) {
                    echo "<a href='?page=" . ($page - 1) . "' class='prev'>&laquo; Anterior</a>";
                } else {
                    echo "<span class='prev disabled'>&laquo; Anterior</span>";
                }

                // Mostrar primer enlace y puntos suspensivos si es necesario
                if ($page > 3) {
                    echo "<a href='?page=1' class='page-link'>1</a>";
                    echo "<span class='page-link'>...</span>";
                }

                // Mostrar enlaces de páginas cercanas
                for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++) {
                    echo "<a href='?page=$i' class='page-link" . ($i == $page ? " active" : "") . "'>$i</a>";
                }

                // Mostrar puntos suspensivos y último enlace si es necesario
                if ($page < $total_pages - 2) {
                    echo "<span class='page-link'>...</span>";
                    echo "<a href='?page=$total_pages' class='page-link'>$total_pages</a>";
                }

                // Botón Siguiente
                if ($page < $total_pages) {
                    echo "<a href='?page=" . ($page + 1) . "' class='next'>Siguiente &raquo;</a>";
                } else {
                    echo "<span class='next disabled'>Siguiente &raquo;</span>";
                }
                ?>
        </div>
    </div>
    </div>

    <script>
        document.getElementById("searchButton").addEventListener("click", function() {
            var input = document.getElementById("searchInput").value.toUpperCase();
            var psicologos = document.querySelectorAll('.psicologo-container');

            for (var i = 0; i < psicologos.length; i++) {
                var psicologo = psicologos[i];
                var nombre = psicologo.querySelector('p').textContent.toUpperCase();

                if (nombre.indexOf(input) > -1) {
                    psicologo.style.display = "";
                } else {
                    psicologo.style.display = "none";
                }
            }
        });
    </script>

    <!-- Botón flotante de WhatsApp -->
    <a href="https://wa.me/51915205726" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
    <?php 
        // include_once 'Componentes/footer_new.php';
        include_once 'modales/modal-video.php';
    ?>
    <script src="js/navabar.js"></script>
    <script>
        let linkVideoSelected = '';
        const modalVideo = document.querySelector('#videoModal');
        const videoModalSource = document.querySelector('#videoModalSource');
        const psicologos = document.querySelector('#psicologos-container');
        const videoModalClose = document.querySelector('#videoModalClose');
        psicologos.addEventListener('click', (e) => {
            e.preventDefault();
            console.log(e.target.className !== 'psicologo-video-overlay');
            if (e.target.className !== 'psicologo-video-overlay') {
                return;
            }
            const video = e.target.previousElementSibling;
            videoModalSource.src = video.src+'?autoplay=1';
            modalVideo.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
        videoModalClose.addEventListener('click', () => {
            modalVideo.style.display = 'none';
            videoModalSource.src = '';
            document.body.style.overflow = 'auto';
            document.body.style.overflowX = 'hidden';
        });
    </script>
</body>

</html>