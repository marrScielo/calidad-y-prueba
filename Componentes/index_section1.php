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
            font-family: Arial, sans-serif;
        }

        .hero {
            position: relative;
            height: 100vh;
            max-height: 1500px;
            background-image: url("ContigoVoyAssets/recursos/Recurso_6.png");
            background-position: center;
            background-size: cover;
            display: grid;
            place-items: center;
        }
        
        .hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    z-index: 1;
}

        .hero__content {
            position: relative;
            z-index: 2;
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
            text-transform: uppercase;
            text-decoration: none;
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
            <a href="psicologos.php" class="hero__cta">Solicitar Servicio</a>
        </div>
    </section>
</body>
</html>