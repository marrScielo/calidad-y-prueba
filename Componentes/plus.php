<style>
    .container_plus {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        background-color: #ffffff;
        background-image: url('ContigoVoyAssets/fondos/porque-confiar.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .column_Info {
        display: flex;
        flex-direction: column;
        gap: 1em;
    }

    .content-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 2.5rem;
        padding: 4rem 0;
    }

    .column {
        flex: 1;
    }

    .image-column {
        flex: 1;
    }

    .image-column img {
        width: 70%;
        max-height: 700px;
        object-fit: contain;
        border-radius: 1.5em;
        transform: scaleX(-1);
    }

    .text-column h2 {
        margin-top: 0;
        color: #FFFF;
        font-size: 2.8em;
    }

    .text-column h3 {
        margin-top: 0;
        color: #FFFF;
        font-size: 2.8em;
        text-align: end;

    }

    .text-p {
        text-wrap: balance;
        color: #fff;
        font-size: 1.5em;
    }

    .text-column .benefits {
        list-style-type: none;
        padding: 0;
        color: #fff;
    }

    .text-column .benefits li {
        margin: 10px 0;
        padding-left: 20px;
        position: relative;
    }

    .text-column .benefits li::before {
        content: "+";
        color: #fff;
        position: absolute;
        left: 0;
        top: 0;
    }

    .cards {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
    }

    .card {
        flex: 1;
        margin: 0 10px;
        padding: 20px;
        background-color: #f0f0f0;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .card h3 {
        margin-top: 0;
    }

    .cta-button {
        font-family: Montserrat, sans-serif;
        display: inline-block;
        padding: 10px 20px;
        background-color: #9897d1;
        color: #ffffff;
        text-align: center;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        width: max-content;

    }

    .cta-button:hover {
        background-color: #6e6d95;
    }

    /* Responsive Styles */
    @media (max-width: 1024px) {
        .container_plus {
            flex-direction: column;
            align-items: flex-start;
        }

        .cards {
            flex-direction: column;
            align-items: center;
        }

        .card {
            margin: 10px 0;
            width: 100%;
            max-width: 400px;
        }
    }

    @media (max-width: 768px) {
        .container_plus {
            flex-direction: column;
            align-items: flex-start;
        }

        .content-wrapper {
            max-width: 90%;
        }

        .cards {
            flex-direction: column;
            align-items: center;
        }

        .card {
            margin: 10px 0;
            width: 100%;
            max-width: 300px;
        }

        .column {
            padding: 10px;
        }

        .cta-button {
            width: 100%;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .content-wrapper {
            max-width: 95%;
            flex-direction: column;
            align-items: center;
        }

        .image-column {
            order: -1;
            width: 100%;
        }

        .image-column img {
            max-width: 80%;
            /* Aumentar el tamaño de la imagen */
        }

        .text-column {
            width: 100%;
            text-align: center;
        }

        .text-column h2 {
            font-size: 2.4rem;
            padding-bottom: .6rem;
        }

        .text-p {
            font-size: 1.1rem;
        }

        .cards {
            flex-direction: column;
            align-items: center;
        }

        .card {
            margin: 10px 0;
            width: 100%;
            max-width: 100%;
        }

        .cta-button {

            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container_plus">
    <div class="content-wrapper container-section">
        <div class="column image-column">
            <img src="img/confia-nosotros.jpg" alt="Psicologo Plus">
        </div>
        <div class="column text-column column_Info">
            <h2>¿Por qué confiar en ContigoVoy?</h2>
            <p class="text-p">Nuestros psicólogos son profesionales colegiados con un trato cercano. Ya han ayudado a
                miles de pacientes a mejorar su calidad de vida.</p>
            <ul class="benefits">
                <li class="text-p">Sesiones privadas, confidenciales y seguras</li>
                <li class="text-p">Ahorra tiempo y desplazamientos</li>
                <li class="text-p">Tú decides donde y cuándo realizar las sesiones</li>
            </ul>
            <button class="cta-button" onclick="window.location.href='psicologos.php';">Pide cita</button>
        </div>
    </div>
</div>