<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Servicio Eficiente - Agilizamos el proceso de acceso a los servicios de psicología, agrupando los mejores psicólogos en una misma plataforma." />
    <title>Servicio Eficiente - Contigo Voy</title>
    <style>
        :root {
            --color-light: #ffffff;
            --color-light-pink: #f2b8b8;
            --color-light-green: #6ed3c7;
            --color-description: #534489;
        }

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body, html {
            scroll-behavior: smooth;
            font-family: Arial, sans-serif;
        }

        .sectionService {
            background-image: url("ContigoVoyAssets/fondos/servicio-eficiente.jpg");
            background-size: 100% 100%; /* Ajusta el ancho al 100% y la altura de manera proporcional */
            width: 100%;
            max-width: 1980px; 
            margin: 0 auto;
            overflow: hidden;
            position: relative;
        }


        .sliderContainer {
            display: flex;
            transition: transform 0.5s ease-in-out;
            /* width: 300%;  *//* Ajuste para hacer que el contenedor se ajuste al ancho del contenedor principal */
        }

        .sliderContainer__slide {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 4em 0;
        }

        .sliderContainer__slide--box {
            width: 90%;
            padding: 5em 0;
            display: flex;
            flex-flow: row wrap;
        }

        .service__content,
        .service__image {
            flex: 1;
            padding: 0 3em;
        }

        .service__content {
            display: flex;
            flex-direction: column;
            gap: 2em;
            justify-content: center;
            /* align-items: center; */
        }

        .service__title {
            font-size: 2.8em;
            color: var(--color-light);
        }

        .service__description {
            text-wrap: pretty;
            font-size: 1.5em;
            text-align: start;
            color: var(--color-description);
        }

        .service__image {
            display: flex;
            justify-content: center;
        }

        .service__image-content {
            width: 20em;
            height: auto;
        }

        .sliderButtons {
            position: absolute;
            bottom: 10px;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .sliderDot {
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            border-radius: 50%;
            width: 1em;
            height: 1em;
            margin: 0 0.5em;
            cursor: pointer;
        }

        .sliderDot.active {
            background-color: var(--color-light);
        }

        @media (max-width: 1000px) {
            .sliderContainer {
                text-align: center;
            }
            .sliderContainer__slide--box {
                padding: 0 3em;
                text-align: center;
                flex-direction: column;
                gap: 3em;
            }
            .service__content, .service__image {
                padding: 0;
            }
            .service__description {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <section class="sectionService">
        <ol class="sliderContainer">
            <li class="sliderContainer__slide">
                <div class="sliderContainer__slide--box">
                    <div class="service__content">
                        <h2 class="service__title">Servicio Eficiente</h2>
                        <p class="service__description">Agilizamos el proceso de acceso a los servicios de psicología, agrupando los mejores psicólogos en una misma plataforma.</p>
                    </div>
                    <div class="service__image">
                        <img class="service__image-content" src="ContigoVoyAssets/recursos/2.png" alt="Representación de servicio eficiente" />
                    </div>
                </div>
            </li>
<!--             <li class="sliderContainer__slide">
                <div class="sliderContainer__slide--box">
                    <div class="service__content">
                        <h2 class="service__title">Consulta Psicológica</h2>
                        <p class="service__description">Desbloquea una experiencia de terapia sin complicaciones con nuestra innovadora plataforma. Desde la comodidad de tu hogar, puedes explorar perfiles detallados de psicólogos expertos.</p>
                    </div>
                    <div class="service__image">
                        <img class="service__image-content" src="ContigoVoyAssets/recursos/1_2.png" alt="Representación de consulta psicológica" />
                    </div>
                </div>
            </li>
            <li class="sliderContainer__slide">
                <div class="sliderContainer__slide--box">
                    <div class="service__content">
                        <h2 class="service__title">Confidencialidad y Seguridad</h2>
                        <p class="service__description">Tu bienestar es nuestra prioridad. En nuestra plataforma, la confidencialidad y la seguridad son esenciales. Cada sesión de terapia se lleva a cabo en un entorno encriptado y protegido.</p>
                    </div>
                    <div class="service__image">
                        <img class="service__image-content" src="ContigoVoyAssets/recursos/1_3.png" alt="Representación de confidencialidad y seguridad" />
                    </div>
                </div>
            </li> -->
        </ol>
        <!-- <div class="sliderButtons">
            <button class="sliderDot active" data-slide="0"></button>
            <button class="sliderDot" data-slide="1"></button>
            <button class="sliderDot" data-slide="2"></button>
        </div> -->
    </section>

    <script>
        /* const sliderContainer = document.querySelector(".sliderContainer");
        const slides = document.querySelectorAll(".sliderContainer__slide--box");
        const dots = document.querySelectorAll(".sliderDot");
        let currentIndex = 0;
        let interval = setInterval(autoSlide, 3000); 

        function updateSliderPosition() {
            sliderContainer.style.transform = `translateX(-${currentIndex * 100 / slides.length}%)`;
        }

        function updateDots() {
            dots.forEach(dot => dot.classList.remove('active'));
            dots[currentIndex].classList.add('active');
        }

        function autoSlide() {
            currentIndex++;
            if (currentIndex === slides.length) {
                currentIndex = 0;
            }
            updateSliderPosition();
            updateDots();
        }

        function resetInterval() {
            clearInterval(interval);
            interval = setInterval(autoSlide, 3000);
        }

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                currentIndex = parseInt(dot.getAttribute('data-slide'));
                updateSliderPosition();
                updateDots();
                resetInterval(); 
            });
        }); */

    </script>

</body>
</html>
