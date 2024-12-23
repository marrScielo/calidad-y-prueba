<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <!--  Estilos propios -->
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/estilos-footer.css">
    <link rel="stylesheet" href="css/reservar-cita-psicologos.css">
    <link rel="icon" href="img/favicon.png">
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
                    echo "<a href='?page=" . ($page - 1) . "' class='prev'>&laquo; </a>";
                } else {
                    echo "<span class='prev disabled'>&laquo; </span>";
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
                    echo "<a href='?page=" . ($page + 1) . "' class='next'> &raquo;</a>";
                } else {
                    echo "<span class='next disabled'> &raquo;</span>";
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
    <?php include_once 'Componentes/chatbot.php'; ?>
	<a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="1.2em"
    fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
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
    <?php include 'Componentes/footer_new.php'; ?>
</body>

</html>