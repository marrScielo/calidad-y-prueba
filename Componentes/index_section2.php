<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
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
            }
            .bgSection2 {
                max-width: 1980px;
                margin: 0 auto;
                max-height: 1500px;
                background-image: url("ContigoVoyAssets/fondos/servicioEficiente.jpg");
                background-position: center;
                background-size: cover;

                padding: 5em 0;
                display: flex;
                flex-flow: row wrap;
                h1,
                h2 {
                    margin: 0 !important;
                    padding: 0 !important;
                }
                span {
                    padding: 0 3em;
                    flex: 1;
                }
                span:nth-child(1) {
                    display: flex;
                    flex-flow: column;
                    gap: 2em;
                    justify-content: center;
                    align-items: center;
                    h2 {
                        font-size: 3em;
                        color: var(--light);
                    }
                    p {
                        font-size: 1.3em;
                        color: var(--darkGreen);
                    }
                }
                span:nth-child(2) {
                    display: flex;
                    justify-content: center;
                    img {
                        width: 20em;
                    }
                }
            }

            @media (width<=1000px) {
                .bgSection2 {
                    display: flex;
                    flex-flow: column;
                    text-align: center;
                    gap: 2em;
                    span {
                        padding: 0;
                    }
                }
            }
        </style>
    </head>
    <body>
        <section class="bgSection2">
            <span>
                <h2>Servicio Eficiente</h2>
                <p>Agilizamos el proceso de acceso a los servicios de psicologia, agrupando los mejores psicologos en una misma plataforma.</p>
            </span>
            <span>
                <img src="ContigoVoyAssets/recursos/1_1.png" />
            </span>
        </section>
    </body>
</html>
