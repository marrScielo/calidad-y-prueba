<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/psico-estilo.css">
    <link rel="stylesheet" href="css/estilos-footer.css">
    <link rel="icon" href="img/logo-actual.webp">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <title>Psicologos</title>
    <meta name="description" content="Reserva tu cita con nuestro psicólogo profesional. Encuentra información sobre su especialidad, contacto y disponibilidad. Comienza tu camino hacia el bienestar emocional con una consulta personalizada.">
    <style>
        @media (max-width: 768px) {
            .search-container input[type="text"] {
                width: 80%;
            }

            .section-container {
                flex-direction: column;
            }

            .left-section, .right-section {
                width: 100%;
                padding: 10px;
            }

            .psicologo-container {
                flex: 1 1 100%;
                margin: 10px 0;
            }

            .psicologo-row {
                grid-template-columns: 1fr; /* 1 columna en pantallas pequeñas */
            }
            
            .search-container {
                margin: 10px;
            }
            
            .search-container button {
                margin-top: 10px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .search-container input[type="text"] {
                width: 70%;
            }

            .section-container {
                flex-direction: column;
            }

            .left-section, .right-section {
                width: 100%;
                padding: 15px;
            }

            .psicologo-container {
                flex: 1 1 48%;
                margin: 10px;
            }

            .psicologo-row {
                grid-template-columns: 1fr 1fr; /* 2 columnas en pantallas medianas */
            }
            
            .search-container {
                margin: 15px;
            }
            
            .search-container button {
                margin-top: 5px;
            }
        }

        @media (min-width: 1025px) {
            .psicologo-row {
                display: grid;
                grid-template-columns: repeat(3, 1fr); /* 3 columnas en pantallas grandes */
                grid-gap: 20px;
            }
        }
        
        /* Estilo para las tarjetas */
        .psicologo-container {
            border: 1px solid #ccc;
            padding: 1.5rem;
            margin: 0px;
            border-radius: 10px; /* Borde redondeado */
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra */
            box-sizing: border-box;
            text-align: center; /* Centrar contenido dentro del contenedor */
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1rem;
        }

        .psicologo-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        /* Nuevo estilo */
        .intro-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            width: 300px;
        }

        .search-container button {
            padding: 10px 20px;
            background-color: #f19294;
            color: white;
            border: none;
            cursor: pointer;
        }

        .section-container {
            display: flex;
            justify-content: space-between;
            margin: 20px auto;
        }

        .right-section {
            max-width: 85%;
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php include 'Componentes/header.php'; ?>

    <div class="section-container">
        <div class="right-section">
            <div class="intro-container">
                <h2 class="title">NUESTRO EQUIPO</h2>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Buscar...">
                    <button type="button" id="searchButton">Buscar</button>
                </div>
            </div>
            <p style="font-size: 1.1rem;">
                Conozca a nuestros talentosos psicólogos, dedicados a ayudarle a alcanzar su bienestar emocional. Nuestro equipo está compuesto por profesionales altamente capacitados en diversas áreas de la psicología, listos para brindarle el apoyo que necesita.
                Cada uno de nuestros psicólogos cuenta con una vasta experiencia en tratamientos y terapias que abarcan desde problemas emocionales y de conducta hasta orientación y asesoramiento en diversas etapas de la vida.
            </p>
            <div id="psicologos-container" class="psicologo-row">
                <?php include 'Modelo/PsicologoModel.php'; ?>
            </div>

            <div class="pagination">
                <?php
                // Parámetros de paginación
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                $total_pages = isset($total_pages) ? $total_pages : 1;

                if ($page > 1) {
                    echo "<a href='?page=" . ($page - 1) . "'>&laquo; Anterior</a>";
                } else {
                    echo "<a href='#' class='disabled'>&laquo; Anterior</a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?page=$i'" . ($i == $page ? " class='active'" : "") . ">$i</a>";
                }

                if ($page < $total_pages) {
                    echo "<a href='?page=" . ($page + 1) . "'>Siguiente &raquo;</a>";
                } else {
                    echo "<a href='#' class='disabled'>Siguiente &raquo;</a>";
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
    <script src="js/navabar.js"></script>
    <?php include 'Componentes/footer_new.php'; ?>
</body>
</html>
