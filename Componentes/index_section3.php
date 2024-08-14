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
                --darkGreen: #9897d1;
                --darkPink: #9897d1;
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
            .section-bg {
                max-width: 1980px;
                margin: 0 auto;
                max-height: 1500px;
                background-image: url("ContigoVoyAssets/fondos/comopodemosrecursonuevo.jpg");
                
                /* padding: 3em 0; */
                display: flex;
                flex-flow: column;
                gap: 1em;
                background-size: cover;
                padding-bottom: 7em;
                padding-top: 7em;
            }
            .section-bg__title {
                margin: 0 !important;
                padding: 0 !important;
            }
            .section-bg__image {
                align-self: center;
                width: 10em;
            }
            .section-bg__content {
                /* padding: 150px; */
                display: flex;
                flex-flow: row wrap;
                gap: 1.5em;
                width: 90%;
                align-self: center;

            }
            .section-bg__text {
                flex: 1;
                padding: 7em 3em;
                display: flex;
                flex-flow: column;
                gap: 2em;
                color: var(--darkGreen);
            }
            .section-bg__text h2 {
                font-size: 2.8em;
            }
            .section-bg__text p {
                font-size: 1.5em;
                text-wrap: balance;
            }
            .section-bg__list {
                flex: 1;
                padding: 7em 0em;
                display: flex;
                justify-content: center;
            }
            .section-bg__list-content {
                gap: 1em;
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(min(20em, 100%), 1fr));
            }
            .section-bg__list ol {
                list-style-type: none;
                display: flex;
                flex-flow: row;
                gap: 2em;
                
            }
            .section-bg__list ol:nth-child(2) {
                position: relative;
                right: 2em;
            }
            .section-bg__list ol + ol {
                margin-left: -4px; 
            }
            .section-bg__list li {
                height: fit-content;
                text-align: center;
                color: var(--light);
                padding: 0.8em 1.5em;
                border-radius: 0.7em;
                background-color: var(--darkPink);
            }

            @media (width<=1250px) {
                html,
                body {
                    font-size: 0.8em;
                }
                .section-bg {
                    background-position-x: -0.5em;
                    background-position-y: 0em;
                }
                .section-bg__content {
                    flex-flow: column;
                    text-align: center;
                }
                .section-bg__text,
                .section-bg__list {
                    padding: 1em 1em;
                }
                .section-bg__list {
                    display: block;
                }
                .section-bg__list-content {
                    padding: 0;
                }
                .section-bg__list ol {
                    flex-flow: column;
                }
                .section-bg__list ol:nth-child(2) {
                    right: 0;
                }
            }

            @media (max-width: 1260px) {
                .section-bg__list-content {
                    padding: 0 18em;
                    grid-template-columns: repeat(auto-fill, minmax(20em, 1fr));
                }
            }

            @media (max-width: 1100px) {
                .section-bg__list-content {
                    padding: 0 16em;
                    grid-template-columns: repeat(auto-fill, minmax(18em, 1fr));
                }
            }

            @media (max-width: 1000px) {
                .section-bg__list-content {
                    padding: 0 15em;
                    grid-template-columns: repeat(auto-fill, minmax(16em, 1fr));
                }
            }

            @media (max-width: 900px) {
                .section-bg__list-content {
                    grid-template-columns: repeat(auto-fill, minmax(12em, 1fr));
                }
            }

            @media (max-width: 800px) {
                .section-bg__list-content {
                    padding: 0 10em;
                    grid-template-columns: repeat(auto-fill, minmax(15em, 1fr));
                }
            }

            @media (max-width: 700px) {
                .section-bg__list-content {
                    padding: 0 3em;
                    grid-template-columns: repeat(auto-fill, minmax(15em, 1fr));
                }
            }

            @media (max-width: 600px) {
                .section-bg__list-content {
                    padding: 0 2em;
                    grid-template-columns: repeat(auto-fill, minmax(13em, 1fr));
                }
            }

            @media (max-width: 500px) {
                .section-bg__list-content {
                    padding: 0 2em;
                    grid-template-columns: repeat(auto-fill, minmax(11em, 1fr));
                }
            }

            @media (max-width: 450px) {
                .section-bg__list-content {
                    padding: 0 2em;
                    grid-template-columns: repeat(auto-fill, minmax(9em, 1fr));
                }
            }

            @media (max-width: 400px) {
                .section-bg__list-content {
                    padding: 0 2em;
                    grid-template-columns: repeat(auto-fill, minmax(8em, 1fr));
                }
            }

            @media (max-width: 350px) {
                .section-bg__list-content {
                    padding: 0 1em;
                    grid-template-columns: repeat(auto-fill, minmax(15em, 1fr));
                }
            }

            @media (width<=1900px) {
                .section-bg {
                    background-position-y: 0em;
                }
            }
        </style>
    </head>
    <body>
        <section class="section-bg">
            <!-- <img class="section-bg__image" src="ContigoVoyAssets/recursos/Recurso_8.png" /> -->

            <div class="section-bg__content">
                <span class="section-bg__text">
                    <h2>¿Cómo podemos ayudarte?</h2>
                    <p>
                        Nuestros psicologos online cuentan con distintas especialidades. Las sesiones se adaptan a las necesidades de cada paciente
                    </p>
                </span>

                <span class="section-bg__list">
                    <div class="section-bg__list-content">
                        <ol>
                            <li>Adicciones</li>
                            <li>Ansiedad</li>
                            <li>Atencion</li>
                            <li>Crianza</li>
                        </ol>

                        <ol>
                            <li>Depresion</li>
                            <li>Estres</li>
                            <li>Impulsividad</li>
                            <li>Top</li>
                        </ol>

                        <ol>
                            <li>Ira</li>
                            <li>Sexualidad</li>
                            <li>Traumas</li>
                            <li style="white-space: nowrap;">Riesgo Sexual</li>
                        </ol>
                    </div>
                </span>
            </div>
        </section>
    </body>
</html>


<!-- FLEX  -->
<!-- 
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
            .bgSection3 {
                max-width: 1980px;
                margin: 0 auto;
                max-height: 1500px;
                background-image: url("ContigoVoyAssets/fondos/comoPodemosAyudarte.jpg");
                background-size: cover;
                background-position-y: -5em;
                padding: 3em 0;
                display: flex;
                flex-flow: column;
                gap: 1.5em;
                h1,
                h2 {
                    margin: 0 !important;
                    padding: 0 !important;
                }
                img {
                    align-self: center;
                    width: 10em;
                }
                div {
                    padding-top: 0em;
                    display: flex;
                    flex-flow: row wrap;
                    gap: 2em;

                    span {
                        flex: 1;
                        padding: 7em 3em;
                        justify-content: center;
                    }

                    span:nth-child(1) {
                        display: flex;
                        flex-flow: column;
                        gap: 2em;
                        color: var(--darkGreen);
                        h2 {
                            font-size: 3em;
                        }
                        p {
                            font-size: 1.3em;
                        }
                    }

                    span:nth-child(2) {
                        display: flex;
                        justify-content: center;
                        div {
                            display: flex;
                            flex-flow: column;
                            gap: 1em;
                            ol {
                                display: flex;
                                flex-flow: row;
                                gap: 2em;
                            }
                            ol:nth-child(2) {
                                position: relative;
                                right: 2em;
                            }
                            li {
                                text-align: center;
                                color: var(--light);
                                padding: 0.8em 1.5em;
                                border-radius: 0.7em;
                                background-color: var(--darkGreen);
                            }
                        }
                    }
                }
            }

            @media (width<=1250px) {
                .bgSection3 {
                    div {
                        flex-flow: column;
                        text-align: center;
                    }
                }
            }

            @media (width<=1250px) {
                html, body{
                    font-size: .8em;
                }
                .bgSection3 {
                    background-position-x: -.5em;
                    background-position-y: 0em;
                    div {
                        padding-top: 0;
                        span {
                        flex: 1;
                        padding: 1em 1em;
                    }
                        span:nth-child(2) {
                            padding: 0;
                            div {
                                ol {
                                    flex-flow: column;
                                }
                                ol:nth-child(2) {
                                    right: 0;
                                }
                            }
                        }
                    }
                }
            }

            @media (width<=1900px) {

                .bgSection3 {
                    background-position-y: 0em;
                }
            }
        </style>
    </head>
    <body>
        <section class="bgSection3">
            <img src="ContigoVoyAssets/recursos/Recurso_8.png" />

            <div>
                <span>
                    <h2>¿Como podemos ayudarte?</h2>
                    <p>
                        Nuestros psicologos online cuentan con distintas especialidades. Las sesiones se adaptan a las necesidades de cada paciente
                    </p>
                </span>

                <span>
                    <div>
                        <ol>
                            <li>Adicciones</li>
                            <li>Ansiedad</li>
                            <li>Atencion</li>
                            <li>Crianza</li>
                        </ol>

                        <ol>
                            <li>Depresion</li>
                            <li>Estres</li>
                            <li>Impulsividad</li>
                            <li>Top</li>
                        </ol>

                        <ol>
                            <li>Ira</li>
                            <li>Sexualidad</li>
                            <li>Traumas</li>
                            <li>Riesgo Sexual</li>
                        </ol>
                    </div>
                </span>
            </div>
        </section>
    </body>
</html>


-->

<!-- GRID  -->
<!-- <!DOCTYPE html>
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
            .bgSection3 {
                max-width: 1980px;
                margin: 0 auto;
                max-height: 1500px;
                background-image: url("ContigoVoyAssets/fondos/comoPodemosAyudarte.jpg");
                background-size: cover;
                background-position-y: -3em;
                padding: 3em 0;
                display: flex;
                flex-flow: column;
                gap: 1.5em;
                h1,
                h2 {
                    margin: 0 !important;
                    padding: 0 !important;
                }
                img {
                    align-self: center;
                    width: 10em;
                }
                div {
                    padding-top: 0em;
                    display: flex;
                    flex-flow: row wrap;
                    gap: 2em;

                    span {
                        flex: 1;
                        padding: 7em 3em;
                  
                    }

                    span:nth-child(1) {
                        display: flex;
                        flex-flow: column;
                        justify-content: center;
                        gap: 2em;
                        color: var(--darkGreen);
                        h2 {
                            font-size: 3em;
                        }
                        p {
                            font-size: 1.3em;
                        }
                    }

                    span:nth-child(2) {
                        display: flex;
                            ol{
                                list-style-type: none;
                                width: 100%;
                                display: grid;
                                grid-template-columns: repeat(auto-fill, minmax(min(10em, 100%), 1fr));
                                grid-template-rows: min-content;
                                gap: 1.5em;
                                li {
                                height: fit-content;
                                text-align: center;
                                color: var(--light);
                                padding: 0.8em 1.5em;
                                border-radius: 0.7em;
                                background-color: var(--darkGreen);
                            }
                            }
                    }
                }
            }

            @media (width<=1200px) {
                html, body{
                    font-size: .8em;
                }
                .bgSection3 {
                    background-position-x: -.5em;
                    background-position-y: 0em;
                    div {
                        flex-flow: column;
                        text-align: center;
                        padding-top: 0;
                        span {
                        flex: 1;
                        padding: 1em 1em;
                    }
                }
               
            }
        }

            @media (width<=1900px) {

                .bgSection3 {
                    background-position-y: 0em;
                }
            }
        </style>
    </head>
    <body>
        <section class="bgSection3">
            <img src="ContigoVoyAssets/recursos/Recurso_8.png" />

            <div>
                <span>
                    <h2>¿Como podemos ayudarte?</h2>
                    <p>
                        Nuestros psicologos online cuentan con distintas especialidades. Las sesiones se adaptan a las necesidades de cada paciente
                    </p>
                </span>

                <span>
                <ol>
                            <li>Adicciones</li>
                            <li>Ansiedad</li>
                            <li>Atencion</li>
                            <li>Crianza</li>
                            <li>Depresion</li>
                            <li>Estres</li>
                            <li>Impulsividad</li>
                            <li>Top</li><li>Ira</li>
                            <li>Sexualidad</li>
                            <li>Traumas</li>
                            <li>Riesgo Sexual</li>
                </ol>
                </span>
            </div>
        </section>
    </body>
</html>
 -->
