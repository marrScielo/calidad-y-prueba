<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContigoVoy</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/inicio-header.css">
	<link rel="stylesheet" href="css/estilos-banner.css">
	<link rel="stylesheet" href="css/estilos-carrusel.css">
	<link rel="stylesheet" href="css/estilos-especialidades.css">
	<link rel="stylesheet" href="css/estilos-blog.css">
	<link rel="stylesheet" href="css/estilos-footer.css">
	<link rel="stylesheet" href="css/estilos-footer2.css">
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
            <img src="img/beneficio1.jpg" alt="">
            <div class="carousel-caption">
                <h3>Texto para beneficio 1</h3>
                <p>Descripción adicional para beneficio 1.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/beneficio2.jpg" alt="">
            <div class="carousel-caption">
                <h3>Texto para beneficio 2</h3>
                <p>Descripción adicional para beneficio 2.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/beneficio4.jpg" alt="">
            <div class="carousel-caption">
                <h3>Texto para beneficio 4</h3>
                <p>Descripción adicional para beneficio 4.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/beneficio3.jpg" alt="">
            <div class="carousel-caption">
                <h3>Texto para beneficio 3</h3>
                <p>Descripción adicional para beneficio 3.</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" onclick="prevSlide()">&#10094;</a>
    <a class="carousel-control-next" onclick="nextSlide()">&#10095;</a>
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
</div>
</body>
</html>