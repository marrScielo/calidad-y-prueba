<?php
// Incluir el controlador de la base de datos
include 'Controlador/DatabaseController.php';

try {
    // Crear una instancia de DatabaseController
    $dbController = new DatabaseController();

    // Obtener la conexión PDO
    $conn = $dbController->getConnection();

    // Parámetros de paginación
    $results_per_page = 9; // Número de resultados por página
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $start_from = ($page - 1) * $results_per_page;

    // Obtener el número total de resultados
    $total_sql = "SELECT COUNT(*) FROM psicologo";
    $total_stmt = $conn->query($total_sql);
    $total_results = $total_stmt->fetchColumn();
    $total_pages = ceil($total_results / $results_per_page);

    // Realizar la consulta SQL con LIMIT y OFFSET
    $sql = "SELECT NombrePsicologo, celular, email, video FROM psicologo LIMIT $start_from, $results_per_page";
    $stmt = $conn->query($sql);

    if ($stmt !== false && $stmt->rowCount() > 0) {
        // Salida de datos de cada fila
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Extraer el ID del video de YouTube de la URL
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $row["video"], $matches);
            $video_id = isset($matches[1]) ? $matches[1] : null;
            echo "<div class='psicologo-container'>";
            echo "<p class='psicologo-nombre'>" . htmlspecialchars($row["NombrePsicologo"]) . "</p>";
            echo "<p class='psicologo-contacto'><strong>Contacto: +51</strong> " . htmlspecialchars($row["celular"]) . "<br>";
            echo "<strong>Email:</strong> " . htmlspecialchars($row["email"]) . "</p>";
            if ($video_id) {
                echo "<iframe width='100%' height='200' src='https://www.youtube.com/embed/$video_id' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
            } else {
                echo "<p>Video no disponible.</p>";
            }
            // Botón de WhatsApp con el número del psicólogo
            echo "<a href='https://api.whatsapp.com/send?phone=51" . htmlspecialchars($row["celular"]) . "' target='_blank'><button class='wsp-button'>Contactar por WhatsApp</button></a>";
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
