<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psicologo Plus</title>
    <style>
        .container_plus {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            max-width: 100%;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-image: url('img/fondo-confia-nosotros.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 3em 0;
            max-width: 123.75rem; /* 1980px convertido a rem (1980/16) */
            margin: 0 auto;
        }

        .column {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .image-column {
            text-align: center;
        }

        .image-column img {
            max-width: 50%;
            border-radius: 8px;
        }

        .text-column h2 {
            margin-top: 0;
        }

        .text-column .benefits {
            list-style-type: none;
            padding: 0;
        }

        .text-column .benefits li {
            margin: 10px 0;
            padding-left: 20px;
            position: relative;
        }

        .text-column .benefits li::before {
            content: "+";
            color: #56B9B3;
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
            display: inline-block;
            padding: 10px 20px;
            background-color: #F2B8B8;
            color: #ffffff;
            text-align: center;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .cta-button:hover {
            background-color: #21758f;
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
</head>
<body>
    <div class="container_plus">
        <div class="column image-column">
            <img src="img/confia-nosotros.jpg" alt="Psicologo Plus" width="40%">
        </div>
        <div class="column text-column">
            <h2>¿Por qué confiar en ContigoVoy?</h2>
            <p>Nuestros psicólogos son profesionales colegiados con un trato cercano. Ya han ayudado a miles de pacientes a mejorar su calidad de vida.</p>
            <ul class="benefits">
                <li>Sesiones privadas, confidenciales y seguras</li>
                <li>Ahorra tiempo y desplazamientos</li>
                <li>Tú decides donde y cuándo realizar las sesiones</li>
            </ul>
            <button class="cta-button" onclick="window.location.href='psicologos.php';">Pide Cita</button>
        </div>
    </div>
</body>
</html>
