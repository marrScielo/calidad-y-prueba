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
            Estamos aquí para ayudarle a alcanzar su máximo bienestar emocional. Nuestro equipo está formado por
            profesionales altamente capacitados en diversas áreas de la psicología, listos para brindarle el apoyo que
            necesita. ¡Cada uno de nuestros psicólogos tiene una vasta experiencia en tratamientos y terapias que
            abarcan desde problemas emocionales y de conducta hasta orientación y asesoramiento en todas las etapas de
            la vida! ¡Permítanos ser su guía hacia una vida más equilibrada y feliz!
        </p>
        <div id="psicologos-container" class="psicologo-row">
            <?php include 'Modelo/PsicologoModel.php'; ?>
        </div>

        <div class="pagination">
            <?php
            // Parámetros de paginación
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
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
    document.getElementById("searchButton").addEventListener("click", function () {
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
<?php
// include_once 'Componentes/footer_new.php';
include_once 'modales/modal-video.php';
?>
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
        videoModalSource.src = video.src + '?autoplay=1';
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