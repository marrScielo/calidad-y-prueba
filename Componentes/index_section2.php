<style>
    .sectionService {
        width: 100%;
        margin: 0 auto;
        background-image: url("ContigoVoyAssets/fondos/servicio-eficiente.jpg");
        background-size: 100% 100%;
        padding-block: 3rem;
    }

    .sliderContainer {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .sliderContainer__slide {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .sliderContainer__slide--box {
        padding: 5rem 0;
        display: flex;
        flex-flow: row wrap;
    }

    .service__content,
    .service__image {
        flex: 1;
        /* padding: 0 3em; */
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
            padding: 0 1em;
            text-align: center;
            flex-direction: column;
            gap: 3em;
        }

        .service__description {
            text-align: center;
        }
    }

    @media (max-width: 812px) {
        .service__description {
            font-size: 2 rem;
            padding: 5px 10px;
        }

        .service__title {
            font-size: 2.3em;

        }

        .sliderContainer__slide--box {
            padding: 0;

        }

        .service__content,
        .service__image {
            flex: 1;
            padding: 0 auto;
        }

        .service__image-content {
            width: 15em;
            height: auto;
        }

    }
</style>

<body>
    <section class="sectionService">
        <ol class="sliderContainer container-section">
            <li class="sliderContainer__slide">
                <div class="sliderContainer__slide--box">
                    <div class="service__content">
                        <h2 class="service__title">Servicio Eficiente</h2>
                        <p class="service__description">Agilizamos el proceso de acceso a los servicios de psicología,
                            agrupando los mejores psicólogos en una misma plataforma.</p>
                    </div>
                    <div class="service__image">
                        <img class="service__image-content" src="ContigoVoyAssets/recursos/2.png"
                            alt="Representación de servicio eficiente" />
                    </div>
                </div>
            </li>
        </ol>
    </section>