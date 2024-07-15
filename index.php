<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContigoVoy</title>
    <link rel="icon" href="img/logo-actual.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/estilos-banner.css">
    <link rel="stylesheet" href="css/inicio-header1.css">
    <link rel="stylesheet" href="css/estilos-especialidades.css">
    <link rel="stylesheet" href="css/blog-inicio.css">
    <link rel="stylesheet" href="css/estilos-footer1x.css">
    <link rel="stylesheet" href="css/estilos-footer2.css">
    <link rel="stylesheet" href="css/boton-wsp.css">
</head>
<body>

    <?php include 'Componentes/header.php'; ?>

    <div class="banner">
        <div class="banner-content">
            <h1>DESCUBRE TU MEJOR <br> VERSIÓN</h1>
            <p>Encuentra equilibrio <br> y bienestar emocional <br> aquí</p>
            <a href="psicologos.php" class="btn">Solicitar Servicio</a>
        </div>
    </div>
   

    <?php include 'Componentes/slider.php'; ?>

    <?php include 'Componentes/especialidades.php'; ?>

    <div class="image-container">
        <img src="img/fondo-blog.webp" alt="Fondo Blog">
        <div class="image-content">
            <h3>Visita nuestro Blog</h3>
            <p>Nuestros psicólogos escriben artículos que adaptan la psicología a tus necesidades, ayudándote a entender, cambiar y vivir mejor.</p>
            <a href="Blog.php">VER BLOG</a>
        </div>
    </div>

    <?php include 'Componentes/opiniones.php'; ?>

    <?php include 'Componentes/plus.php'; ?>

    <?php include 'Componentes/footer_new.php'; ?>

    <!-- Botón flotante de WhatsApp -->
    <a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/navabar.js"></script>
</body>

</html>