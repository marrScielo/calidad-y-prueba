<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Descubre tu mejor versión</title>
    <style>
        :root {
            --color-light: #ffffff;
            --color-light-pink: #f2b8b8;
        }

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body,
        html {
            scroll-behavior: smooth;
            font-family: "Montserrat", sans-serif;
        }

        .hero {
            height: 100vh;
            max-height: 1500px;
            --opacidad-negro: 0.25;
            background-image: linear-gradient(rgba(0, 0, 0, var(--opacidad-negro)), rgba(0, 0, 0, var(--opacidad-negro))), url("ContigoVoyAssets/recursos/Recurso_6.png");
            background-position: center;
            background-size: cover;
            display: grid;
            place-items: center;
        }

        .hero__content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.5em;
            color: var(--color-light);
            padding: 0 1em;
        }

        .hero__title {
            font-size: 4em;
            margin: 0;
            padding: 0;
        }

        .hero__subtitle {
            font-size: 1.5em;
            margin: 0;
            padding: 0;
        }

        .hero__cta {
            text-decoration: none;
            text-transform: uppercase;
            color: var(--color-light);
            background-color: var(--color-light-pink);
            border-radius: 0.5em;
            font-weight: bold;
            padding: 1em 2em;
            font-size: 1em;
            transition: all 0.25s ease-in-out;
        }

        .hero__cta:hover {
            color: var(--color-light-pink);
            background-color: var(--color-light);
        }
    </style>
</head>

<body>
    <section class="hero">
        <div class="hero__content">
            <h1 class="hero__title">
                Descubre tu mejor<br>
                versión
            </h1>
            <h2 class="hero__subtitle">
                Encuentra equilibrio<br>
                y bienestar emocional aquí
            </h2>
            <a href="#" class="hero__cta">Solicitar Servicio</a>
        </div>
    </section>
</body>

</html>