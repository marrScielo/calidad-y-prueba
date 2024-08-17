
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
            padding-top: 100px;
            position: relative;
            place-items: center;
            height: 100vh;
            max-height: 500px;
            background-image: url("ContigoVoyAssets/recursos/Recursonuevo.jpg");
            background-position: center;
            background-size: cover;
            display: grid;.
        }
        .info{
            position:relative;
            left:500px; 
            display:flex;
            justify-content: flex-end;
            border: 2px solid black;
            text-decoration: none;
            color: #FFFFFF;
            background-color: transparent;
            border-radius: 0.5em;
            font-weight: bold;
            padding: 1em 2em;
            font-size: 1em;
            
        }
        
        

        .hero::before {
            place-items: center;
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .hero__content {
            place-items: center;
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
            /* -webkit-text-stroke: 1px black;
            color: white;
            text-shadow:
                2px 2px 0 #000,
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000; */
            font-size:3.5em;
            margin: 0;
            padding: 0;
            place-items: center;
        }

        .hero__subtitle {
            place-items: center;
            font-size: 1.3em;
            margin: 0;
            padding: 0;
        }

        .hero__cta {
            place-items: center;
            text-transform: uppercase;
            text-decoration: none;
            color: var(--color-light);
            background-color: var(--color-light-pink);
            border-radius: 0.5em;
            font-weight: bold;
            padding: 1em 2em;
            font-size: 0.8em;
            transition: all 0.25s ease-in-out;
        }

        .hero__cta:hover {
            color: var(--color-light-pink);
            background-color: var(--color-light);
        }
        @media (max-width: 1920px) {
            .info{                
                top:-70px; 
            }
        }
        
         @media (max-width: 1300px) {
            .info{                
                top:auto; 
                left: 300px;
            }
         }
        
        @media (max-width:900px) {
            .info{
                left: auto;
                top:auto;
            }
            
        }    
        
        
    </style>

<body>
    <section class="hero">
        <div class="hero__content">
            <h1 class="hero__title">
                Descubre tu <u>mejor</u><br>
                versión
            </h1>
            <h2 class="hero__subtitle">
                Encuentra equilibrio<br>
                y bienestar emocional aquí
            </h2>
            <a href="psicologos.php" class="hero__cta">Solicitar Servicio</a>
            <a href="psicologos.php"class="info">Mas información aqui..</a>
        </div>
        
    </section>
