<style>
    :root {
        --light: white;
        --lightPink: #f2b8b8;
        --lightGreen: #6ed3c7;
        --darkGreen: #57bab5;
    }

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    body,
    html {
        scroll-behavior: smooth;
        font-family: Arial, sans-serif;
    }

    .slider {
        max-width: 1980px;
        width: 100%;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
    }

    .slider-container {
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: 300%;
        /* Adjusted for three slides */
    }

    .slide {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-size: cover;
        background-position: center;
        padding: 5em 0;
        max-height: 1500px;
        height: 100vh;
    }

    .slide-content {
        width: 80%;
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
        align-items: center;
    }

    .slide-content span {
        padding: 0 3em;
        flex: 1;
    }

    .slide-content:nth-child(1) span:nth-child(1),
    .slide-content:nth-child(2) span:nth-child(1),
    .slide-content:nth-child(3) span:nth-child(1) {
        display: flex;
        flex-flow: column;
        gap: 2em;
        justify-content: center;
        align-items: center;
    }

    .slide-content:nth-child(1) span:nth-child(2),
    .slide-content:nth-child(2) span:nth-child(2),
    .slide-content:nth-child(3) span:nth-child(2) {
        display: flex;
        justify-content: center;
    }

    .slide img {
        width: 20em;
    }

    .slide h2 {
        font-size: 3em;
        color: var(--light);
    }

    .slide p {
        font-size: 1.3em;
        color: var(--darkGreen);
    }

    @media (max-width: 1000px) {
        .slide-content {
            text-align: center;
            flex-flow: column;
            gap: 2em;
        }

        .slide-content span {
            padding: 0;
        }
    }

    .slider-dots {
        position: absolute;
        bottom: 10px;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .slider-dot {
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        margin: 0 5px;
        cursor: pointer;
    }

    .slider-dot.active {
        background-color: var(--light);
    }
</style>

<div class="slider">
    <div class="slider-container">
        <section class="slide" style="background-image: url('ContigoVoyAssets/fondos/servicioEficiente.jpg');">
            <div class="slide-content">
                <span>
                    <h2>Servicio Eficiente</h2>
                    <p>Agilizamos el proceso de acceso a los servicios de psicologia, agrupando los mejores psicologos en una misma plataforma.</p>
                </span>
                <span>
                    <img src="ContigoVoyAssets/recursos/1_1.png" alt="Psychology Service" />
                </span>
            </div>
        </section>
        <section class="slide" style="background-image: url('ContigoVoyAssets/fondos/servicioEficiente.jpg');">
            <div class="slide-content">
                <span>
                    <h2>Servicio Eficiente</h2>
                    <p>Agilizamos el proceso de acceso a los servicios de psicologia, agrupando los mejores psicologos en una misma plataforma.</p>
                </span>
                <span>
                    <img src="ContigoVoyAssets/recursos/1_1.png" alt="Psychology Service" />
                </span>
            </div>
        </section>
        <section class="slide" style="background-image: url('ContigoVoyAssets/fondos/servicioEficiente.jpg');">
            <div class="slide-content">
                <span>
                    <h2>Servicio Eficiente</h2>
                    <p>Agilizamos el proceso de acceso a los servicios de psicologia, agrupando los mejores psicologos en una misma plataforma.</p>
                </span>
                <span>
                    <img src="ContigoVoyAssets/recursos/1_1.png" alt="Psychology Service" />
                </span>
            </div>
        </section>
    </div>
    <div class="slider-dots">
        <button class="slider-dot active" data-slide="0"></button>
        <button class="slider-dot" data-slide="1"></button>
        <button class="slider-dot" data-slide="2"></button>
    </div>
</div>

<script>
    const sliderContainer = document.querySelector('.slider-container');
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    let currentIndex = 0;

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            currentIndex = parseInt(dot.getAttribute('data-slide'));
            updateSliderPosition();
            updateDots();
        });
    });

    function updateSliderPosition() {
        sliderContainer.style.transform = `translateX(-${currentIndex * 100 / slides.length}%)`;
    }

    function updateDots() {
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }
</script>