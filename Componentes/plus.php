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
            margin: 20px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .column {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .image-column img {
            max-width: 100%;
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
            content: "✔";
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
            background-color: #56B9B3;
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
            <img src="img/plus.webp" alt="Psicologo Plus">
        </div>
        <div class="column text-column">
            <h2>¿Por qué confiar en ContigoVoy Plus?</h2>
            <p>En ContigoVoy Plus, nos dedicamos a brindar el mejor servicio de apoyo psicológico con los siguientes beneficios:</p>
            <ul class="benefits">
                <li>Sesiones privadas, confidenciales y seguras</li>
                <li>Ahorra tiempo y desplazamientos</li>
                <li>Tú decides donde y cuándo realizar las sesiones</li>
            </ul>
            <div class="cards">
                <div class="card">
                    <h3>+10000</h3>
                    <p>Citas realizadas</p>
                </div>
                <div class="card">
                    <h3>+10</h3>
                    <p>Años de experiencia</p>
                </div>
                <div class="card">
                    <h3>100%</h3>
                    <p>Psicólogos colegiados</p>
                </div>
            </div>
            <button class="cta-button" onclick="window.location.href='psicologos.php';">Pide Cita</button>
        </div>
    </div>
</body>
</html>
