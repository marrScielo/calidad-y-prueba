<style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    body,
    html {
        scroll-behavior: smooth;
    }

    .bgSection1 {
        height: 100svh;
        max-height: 1500px;
        --opacidad-negro: 0.25;
        background-image: linear-gradient(rgba(0, 0, 0, var(--opacidad-negro)), rgba(0, 0, 0, var(--opacidad-negro))), url("ContigoVoyAssets/recursos/Recurso_6.png");
        background-position: center;
        background-size: cover;
        display: grid;
        place-items: center;

        h1,
        h2 {
            margin: 0 !important;
            padding: 0 !important;
        }

        div {
            display: flex;
            flex-flow: column;
            align-items: center;
            text-align: center;
            gap: 1.5em;
            color: var(--light);
            padding: 0 1em;
        }

        h1 {
            font-size: 4em;
        }

        a {
            text-decoration: none;
            text-transform: uppercase;
            color: var(--light);
            background-color: var(--lightPink);
            border-radius: 0.5em;
            font-weight: bolder;
            padding: 1em 2em;
            font-size: 1em;
            transition: all 0.25s ease-in-out;
        }

        a:hover {
            color: var(--lightPink);
            background-color: var(--light);
        }
    }
</style>
</head>

<body>
    <section class="bgSection1">
        <div>
            <h1>
                Descubre tu mejor <br />
                version
            </h1>
            <h2>
                Encuentra equilibrio <br />
                y bienestar emocional aqui
            </h2>
            <a href="">Solicitar Servicio</a>
        </div>
    </section>
</body>

</html>