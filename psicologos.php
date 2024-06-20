<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inicio-header.css">
    <link rel="stylesheet" href="css/estilos-psicologos.css">
    <title>Psicologos</title>
</head>
<body>
    <?php include 'Componentes/header.php'; ?>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Buscar...">
        <button type="button" id="searchButton">Buscar</button>
    </div>

    <div class="section-container">
        <div class="left-section">
            <h2>¿Por qué consultar a un Psicólogo?</h2>
            <p><span class="icon">&#x1F468;</span> Profesionalismo y apoyo emocional.</p>
            <p><span class="icon">&#x1F4AC;</span> Confidencialidad y seguridad.</p>
            <p><span class="icon">&#x1F4DA;</span> Mejora en la calidad de vida.</p>
            <p><span class="icon">&#x1F64F;</span> Atención personalizada y empática.</p>
            <p><span class="icon">&#x1F496;</span> Ayuda en la resolución de problemas.</p>

            <div class="testimonial">
                <h3>Testimonios de Pacientes</h3>
                <div class="testimonial-container">
                    <div class="testimonial-item" style="background-color: #1E90FF; color: white; padding: 10px; border-radius: 5px;">
                        <h4>Juan Pérez</h4>
                        <p>"Me siento muy agradecido con el equipo de ContigoVoy por su apoyo incondicional."</p>
                    </div>
                </div>
                <br>
                <div class="testimonial-item" style="background-color: #1E90FF; color: white; padding: 10px; border-radius: 5px;">
                <h4>María Gutiérrez</h4>
                <p>"Estoy muy contenta con la atención recibida por el equipo de ContigoVoy. Han sido de gran ayuda en mi proceso."</p>
                </div>

                <br>
                <div class="testimonial-item" style="background-color: #1E90FF; color: white; padding: 10px; border-radius: 5px;">
                <h4>Carlos Rodríguez</h4>
                <p>"Quiero expresar mi gratitud hacia ContigoVoy por su apoyo constante y profesionalismo. Me han ayudado a enfrentar mis problemas de una manera muy efectiva."</p>
                 </div>

            </div>
        </div>

        <div class="right-section">
            <h2>Nuestro Equipo ContigoVoy</h2>
            <div id="psicologos-container" class="psicologo-row">
                <?php
                // Conexión a la base de datos y consulta
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
</body>
</html>
