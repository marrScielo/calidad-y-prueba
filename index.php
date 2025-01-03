<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContigoVoy - Psicólogos en Perú</title>
    <meta name="description" content="ContigoVoy ofrece apoyo emocional y psicológico con psicólogos profesionales en Perú. Terapia online y presencial para tu bienestar.">
    <meta name="keywords" content="psicólogos Perú, terapia online, terapia presencial, apoyo emocional, salud mental">
    <!-- 
    GOOGLE SEARCH CONSOLE
-->
    <meta name="google-site-verification" content="rd_HuMZMXyzCAnm4KNJ4dxbKlKt58T1iOTnnM0iJUss" />
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/estilos-banner.css">
    <link rel="stylesheet" href="css/estilos-especialidades.css">
    <link rel="stylesheet" href="css/blog-inicio.css">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <link rel="stylesheet" href="css/indexseccion.css">
    <link rel="stylesheet" href="css/estilos-footer.css">
    <!-- Iconos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="ContigoVoy - Psicólogos en Perú">
    <meta property="og:description" content="ContigoVoy ofrece apoyo emocional y psicológico con psicólogos profesionales en Perú. Terapia online y presencial para tu bienestar.">
    <meta property="og:image" content="https://res.cloudinary.com/drubtqo3l/image/upload/v1724082656/contigo-voy/dbcczle5tvaq8fpptf8f.png">
    <meta property="og:url" content="https://contigovoy.com/">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ContigoVoy">
    <meta property="og:locale" content="es_ES">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <style>
        #open-chat {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #open-chat:hover {
            background-color: #3a7bc8;
        }

    </style>
</head>

<body>
    <?php include_once 'Componentes/header.php'; ?>
    <main class="">
        <?php 
        include_once 'Componentes/index_section1.php';
        include_once 'Componentes/index_section2.php';
        include_once 'Componentes/index_section3.php';
        // include_once 'Componentes/especialidades.php';
        // include_once 'Componentes/opiniones.php';
        include_once 'Componentes/plus.php'; ?>
    </main>
    <?php include_once 'Componentes/footer_new.php'; ?>
    <?php include_once 'Componentes/chatbot.php'; ?>
    <a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank" aria-label="Contáctanos por WhatsApp">
    <i class="fab fa-whatsapp" aria-hidden="true"></i>
</a>

    <button style="position: fixed; bottom: 165px; right: 1rem; z-index: 102; background-color: #4a90e2; color: white; border: none; padding: 15px 30px; font-size: 18px; cursor: pointer; border-radius: 5px; transition: background-color 0.3s;" id="open-chat" aria-label="button-open-chat">
        <i class="fas fa-robot"></i>
    </button>
    <?php
        include_once 'modales/chatbot.php';
    ?>
    <script src="js/navabar.js"></script>
    <script src="js/chatbot.js"></script>
</body>
</html>