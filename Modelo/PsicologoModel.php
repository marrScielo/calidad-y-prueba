<?php
// Archivo: consultar_psicologos.php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contigovoy3";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Realizar la consulta, limitando a 9 resultados inicialmente
$sql = "SELECT NombrePsicologo, celular, email, video FROM psicologo LIMIT 9";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
        // Extraer el ID del video de YouTube de la URL
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $row["video"], $matches);
        $video_id = $matches[1];
        echo "<div class='psicologo-container'>";
        echo "<p style='text-align: center; font-weight: bold;'>" . $row["NombrePsicologo"]. "</p>";
        echo "<p><strong>Contacto: +51</strong> " . $row["celular"]. "<br>";
        echo "<strong>Email:</strong> " . $row["email"]. "</p>";
        echo "<iframe width='100%' height='200' src='https://www.youtube.com/embed/$video_id' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
        // Botón de WhatsApp con el número del psicólogo
        echo "<a href='https://api.whatsapp.com/send?phone=51{$row["celular"]}' target='_blank'><button style='background-color: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer;'>Contactar por WhatsApp</button></a>";
        echo "</div>";
    }
} else {
    echo "0 resultados";
}

// Cerrar conexión
$conn->close();
?>
