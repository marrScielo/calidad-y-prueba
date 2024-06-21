<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/inicio-header.css">
    <link rel="stylesheet" href="css/estilos-psicologos.css">
    <link rel="icon" href="img/logo-actual.png">
    <link rel="stylesheet" href="css/boton-wsp.css">
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
        </div>

        <div class="right-section">
            <h2>Nuestro Equipo ContigoVoy</h2>
            <div id="psicologos-container" class="psicologo-row">
                <?php include 'Modelo/PsicologoModel.php'; ?>
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

</body>
</html>
