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
    <link rel="stylesheet" href="css/estilos-blog2.css">
    <link rel="stylesheet" href="css/estilos-footer1x.css">
    <link rel="stylesheet" href="css/estilos-footer2.css">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <link rel="stylesheet" href="css/estilos-carrusel.css">
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
    
    <div class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-caption">
                    <h3>Especialidades</h3>
                    <p>Contamos con un grupo de psicologos especializados en una amplia variedad de temas, garantizando que puedan recibir la ayuda adecuada y especifica para sus problemas.</p>
                </div>
                <img src="img/beneficio1.webp" alt="Especialidades">
            </div>
            <div class="carousel-item">
                <div class="carousel-caption">
                    <h3>Servicio Eficiente</h3>
                    <p>Agilizamos el proceso de acceso a los servicios de psicologia, agrupando los mejores psicologos en una misma plataforma.</p>
                </div>
                <img src="img/beneficio2.webp" alt="Servicio-eficiente">
            </div>
            <div class="carousel-item">
                <div class="carousel-caption">
                    <h3>Beneficios</h3>
                    <p>Conoce los beneficios que podemos dar tanto a los psicologos como a sus pacientes.</p>
                </div>
                <img style="height: 100vh" src="img/beneficio4.webp"  alt="Beneficios">
            </div>
            <div class="carousel-item">
                <div class="carousel-caption">
                    <h3>Atención de calidad</h3>
                    <p>Contamos con un grupo de psicologos especializados en una amplia variedad de temas, garantizando que puedan recibir la ayuda adecuada y especifica para sus problemas.</p>
                </div>
                <img src="img/beneficio3.webp" alt="Atención-de-calidad">
            </div>
        </div>
        <div class="botones">
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true">&#10094;</span>
                <span class="visually-hidden"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true">&#10095;</span>
                <span class="visually-hidden"></span>
            </button>
        </div>
        
    </div>


    <?php include 'Componentes/especialidades.php'; ?>

    <div class="image-container">
        <img src="img/fondo-blog.webp" alt="Fondo Blog">
        <div class="image-content">
            <h3>Visitar nuestro Blog</h3>
            <p>Nuestros psicólogos escriben artículos <br> que adaptan la psicología a tus <br> necesidades, ayudándote a entender, <br> cambiar y vivir mejor.</p>
            <a href="Blog.php">VER BLOG</a>
        </div>
    </div>

    <?php include 'Componentes/footer.php'; ?>

    <!-- Botón flotante de WhatsApp -->
    <a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/navabar.js"></script>
    <script src="js/carrusel.js"></script>
</body>

</html>