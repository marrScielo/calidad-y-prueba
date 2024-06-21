<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContigoVoy</title>
    <link rel="icon" href="img/logo-actual.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/estilos-banner.css">
    <link rel="stylesheet" href="css/inicio-header1.css">   
    <link rel="stylesheet" href="css/estilos-especialidades.css">
    <link rel="stylesheet" href="css/estilos-blog.css">
    <link rel="stylesheet" href="css/estilos-footer.css">
    <link rel="stylesheet" href="css/estilos-footer2x.css">
    <link rel="stylesheet" href="css/boton-wsp.css">
</head>
<style>

.container {
    width: 90%;
    margin: auto;
}

.carousel {
    position: relative;
    width: 100%;
    overflow: hidden;
    margin: 0;
    padding: 0;
}

.carousel-inner {
    display: flex;
    transition: transform 0.5s ease-in-out;
    height: 100%; /* Ocupa toda la altura del viewport */
}

.carousel-item {
    min-width: 100%;
    box-sizing: border-box;
    position: relative;
}

.carousel img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Asegura que la imagen cubra todo el contenedor */
}

.carousel-caption {
    position: absolute;
    top: 15%; /* Ajustar según la necesidad */
    left: 10%; /* Ajustar según la necesidad */
    color: white;
    padding: 10px;
    text-align: left;
    border-radius: 5px;
    max-width: 300px; /* Ajustar según la necesidad */
}

.carousel-caption h3 {
    margin: 0;
    font-size: 2.5em;
}

.carousel-caption p {
    margin: 20px 0 0 0; /* Ajustar márgenes según necesidad */
    font-size: 1.5em;
}

.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
    user-select: none;
    z-index: 5; /* Asegura que los controles estén sobre las imágenes */
}

.carousel-control-prev {
    left: 10px; /* Ajusta la posición izquierda */
}

.carousel-control-next {
    right: 10px; /* Ajusta la posición derecha */
}

/* Ajustes responsivos */
@media (max-width: 768px) {
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
        top: 50%; /* Alinea los botones verticalmente en el centro */
        transform: translateY(-50%); /* Ajusta la posición vertical */
    }
}

@media (max-width: 480px) {
    .carousel-control-prev,
    .carousel-control-next {
        width: 30px;
        height: 30px;
        top: 50%; /* Alinea los botones verticalmente en el centro */
        transform: translateY(-50%); /* Ajusta la posición vertical */
    }
}
@media (max-width: 768px) {
    .carousel-caption h3 {
        font-size: 1.2em; /* Ajusta el tamaño del título */
    }

    .carousel-caption p {
        font-size: 0.9em; /* Ajusta el tamaño del párrafo */
    }
}

@media (max-width: 480px) {
    .carousel-caption h3 {
        font-size: 1em; /* Ajusta el tamaño del título */
    }

    .carousel-caption p {
        font-size: 0.8em; /* Ajusta el tamaño del párrafo */
    }
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
    <script src = "js/carrusel.js"></script>
</body>

</html>
