<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContigoVoy</title>
    <link rel="icon" href="img/logo-actual.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="css/inicio-header1.css">
    <link rel="stylesheet" href="css/estilos-carrusel.css">
    <link rel="stylesheet" href="css/estilos-especialidades.css">
    <link rel="stylesheet" href="css/estilos-blog.css">
    <link rel="stylesheet" href="css/estilos-footer.css">
    <link rel="stylesheet" href="css/estilos-footer2.css">
    <link rel="stylesheet" href="css/boton-wsp.css">
</head>
<style>
    /* Estilos para el banner */
.banner {
    position: relative;
    width: 100%;
    height: 100vh; /* Ocupa toda la altura de la pantalla */
    background-image: url('img/fondo-baner.jpg'); /* Imagen de fondo */
    background-size: cover; /* Asegura que la imagen cubra todo el contenedor */
    background-position: center; /* Centra la imagen de fondo */
    background-repeat: no-repeat; /* No repite la imagen */
}

.banner-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white; /* Asegúrate de que el texto sea visible sobre la imagen */
}

.banner h1 {
    margin: 0;
    font-size: 3.75rem;
    line-height: 1;
}

.banner p {
    margin: 1rem 0;
    font-size: 1.5em;
}

.banner .btn {
    display: inline-block;
    padding: 0.5rem 2rem;
    background-color: rgba(241, 146, 148, 1); /* Color del botón */
    color: white;
    text-decoration: none;
    border-radius: 0.375rem;
    margin-top: 2rem;
    transition: background-color 0.3s;
    font-size: 1.125rem;
    line-height: 1.75rem; 
    font-weight: 500;
}

.banner .btn:hover {
    background-color: #fe9594;
}

</style>
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
                <img src="img/beneficio1.jpg" alt="">
                <div class="carousel-caption">
                    <h3>Especialidades</h3>
                    <p>Contamos con un grupo de psicologos especializados en una amplia variedad de temas, garantizando que puedan recibir la ayuda adecuada y especifica para sus problemas.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/beneficio2.jpg" alt="">
                <div class="carousel-caption">
                    <h3>Servicio Eficiente</h3>
                    <p>Agilizamos el proceso de acceso a los servicios de psicologia, agrupando los mejores psicologos en una misma plataforma.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/beneficio4.jpg" alt="">
                <div class="carousel-caption">
                    <h3>Beneficios</h3>
                    <p>Conoce los beneficios que podemos dar tanto a los psicologos como a sus pacientes.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/beneficio3.jpg" alt="">
                <div class="carousel-caption">
                    <h3>Atención de calidad</h3>
                    <p>Contamos con un grupo de psicologos especializados en una amplia variedad de temas, garantizando que puedan recibir la ayuda adecuada y especifica para sus problemas.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">&#10094;</span>
            <span class="visually-hidden"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true">&#10095;</span>
            <span class="visually-hidden"></span>
        </button>
    </div>
    <script src="js/carrusel.js"></script>

    <?php include 'Componentes/especialidades.php'; ?>

    <div class="image-container">
        <img src="img/fondo-blog.jpg" alt="Fondo Blog">
        <div class="image-content">
            <h3>Visitar nuestro Blog</h3>
            <p>Nuestros psicólogos escriben artículos <br> que adaptan la psicología a tus <br> necesidades, ayudándote a entender, <br> cambiar y vivir mejor.</p>
            <a href="blog.php">VER BLOG</a>
        </div>
    </div>

    <?php include 'Componentes/footer.php'; ?>

    <!-- Botón flotante de WhatsApp -->
    <a href="https://wa.me/51915205726" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="js/navabar.js"></script>

</body>

</html>
