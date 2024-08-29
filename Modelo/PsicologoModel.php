<?php
// Incluir el controlador de la base de datos
include 'Controlador/DatabaseController.php';
function generarBotonWhatsApp($numero_telefono, $codigo_pais = '51')
{
    // Limpia el número de teléfono (elimina espacios y caracteres no numéricos)
    $numero_limpio = preg_replace('/[^0-9]/', '', $numero_telefono);

    // Valida el número de teléfono (asume un formato de 9 dígitos, ajusta según necesites)
    if (strlen($numero_limpio) === 9) {
        $numero_completo = $codigo_pais . $numero_limpio;
        $url_whatsapp = 'https://api.whatsapp.com/send?phone=' . urlencode($numero_completo);

        return '<a href="' . htmlspecialchars($url_whatsapp, ENT_QUOTES, 'UTF-8') . '" 
                   target="_blank" rel="noopener noreferrer" class="wsp-button">
                   ¡Contáctame por WhatsApp!
                </a>';
    } else {
        return '<span class="error">Número de teléfono no válido</span>';
    }
}
try {
    // Crear una instancia de DatabaseController
    $dbController = new DatabaseController();

    // Obtener la conexión PDO
    $conn = $dbController->getConnection();

    // Parámetros de paginación
    $results_per_page = 6; // Número de resultados por página
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $start_from = ($page - 1) * $results_per_page;

    // Obtener el número total de resultados
    $total_sql = "SELECT COUNT(*) FROM psicologo";
    $total_stmt = $conn->query($total_sql);
    $total_results = $total_stmt->fetchColumn();
    $total_pages = ceil($total_results / $results_per_page);

    // Realizar la consulta SQL con LIMIT y OFFSET
    $sql = "SELECT NombrePsicologo, celular, email, video, introduccion, Especialidad FROM vista_psicologo_info LIMIT $start_from, $results_per_page";
    $stmt = $conn->query($sql);

    if ($stmt !== false && $stmt->rowCount() > 0) {
        // Salida de datos de cada fila
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Extraer el ID del video de YouTube de la URL
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $row["video"], $matches);
            $video_id = isset($matches[1]) ? $matches[1] : null;

            echo "<div class='psicologo-container'>";
            echo "<div class='psicologo-header'>";
            echo "<h3 class='psicologo-nombre'>" . htmlspecialchars($row["NombrePsicologo"]) . "</h3>";
            echo "<span class='psicologo-tag'>" . htmlspecialchars($row["Especialidad"]) . "</span>";
            echo "</div>";

            if ($video_id) {
                echo "<div class='psicologo-video-container' style='position:relative;cursor: pointer;'>";
                echo "<iframe class='psicologo-video' width='100%' height='200' src='https://www.youtube.com/embed/$video_id' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                echo "<div class='psicologo-video-overlay' style='position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: transparent;'></div>";
                echo "</div>";
            } else {
                echo "<p class='psicologo-video-not-found'>Video no disponible.</p>";
            }

            echo "<p class='psicologo-introduction'>" . htmlspecialchars($row["introduccion"]) . "</p>";

            // Botón de WhatsApp mejorado
            $whatsapp_number = preg_replace('/[^0-9]/', '', $row['celular']); // Limpia el número
            $whatsapp_url = "https://api.whatsapp.com/send?phone=51" . urlencode($whatsapp_number);
            echo "<a href='" . htmlspecialchars($whatsapp_url, ENT_QUOTES, 'UTF-8') . "' target='_blank' rel='noopener noreferrer' class='wsp-button'>¡Contáctame!</a>";
            echo "</div>";
        }
    } else {
        echo "0 resultados";
    }

    // Cerrar conexión
    $conn = null;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.wsp-button').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            window.open(this.href, '_blank');
        });
    });
});
</script>