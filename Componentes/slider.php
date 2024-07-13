<body>
    <style>
        .bx-wrapper {
            border: 0 !important; /* Elimina cualquier borde */
            box-shadow: none !important; /* Elimina cualquier sombra */
            margin: 0 !important; /* Ajusta el margen si es necesario */
            padding: 0 !important; /* Ajusta el padding si es necesario */
        }
        .carousel-item {
            display: flex;
            align-items: center;
            height: 500px; 
        }
        .carousel-caption {
            display: flex;
            flex-direction: column;
            width: 50%;
            height: 100%;
            padding-left: 40px;
            justify-content: center;
            align-items: left;
            background-color: #F19294;
            color: white;
        }
        .carousel-caption h3{
            width: 90%;
            font-size: 2.5em;
        }

        .carousel-caption p{
            width: 90%;
            font-size: 1.5em;
        }
        
        .carousel-item img {
            width: 50%;
            height: 100%;
        }

        @media (max-width: 768px) {
            .carousel-caption h3 {
                font-size: 1.5em;
            }
            .carousel-caption p {
                font-size: 1em;
            }
            .carousel-caption{
                padding-left: 20px;
            }
            .carousel-item {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .carousel-caption h3 {
                font-size: 1em;
            }
            .carousel-caption p {
                font-size: 0.8em;
            }
        }
    </style>
    <div>
        <div class="slider">
            <div >
                <div class="carousel-item"> 
                    <div class="carousel-caption">
                        <h3>Especialidades</h3>
                        <p>Contamos con un grupo de psicologos especializados en una amplia variedad de temas, garantizando
                            que puedan recibir la ayuda adecuada y especifica para sus problemas.</p>
                    </div>
                    <img src="img/beneficio1.webp" alt="Especialidades">
                </div>
                
            </div>
            <div >
                <div class="carousel-item">
                <div class="carousel-caption">
                    <h3>Servicio Eficiente</h3>
                    <p>Agilizamos el proceso de acceso a los servicios de psicologia, agrupando los mejores psicologos
                        en una misma plataforma.</p>
                </div>
                <img src="img/beneficio2.webp" alt="Servicio-eficiente">
                </div>
                
            </div>
            <div >
                <div class="carousel-item">
                <div class="carousel-caption">
                    <h3>Beneficios</h3>
                    <p>Conoce los beneficios que podemos dar tanto a los psicologos como a sus pacientes.</p>
                </div>
                <img style="height: 100vh" src="img/beneficio4.webp" alt="Beneficios">
                </div>
                
            </div>
            <div >
                <div class="carousel-item">
                <div class="carousel-caption">
                    <h3>Atención de calidad</h3>
                    <p>Contamos con un grupo de psicologos especializados en una amplia variedad de temas, garantizando
                        que puedan recibir la ayuda adecuada y especifica para sus problemas.</p>
                </div>
                <img src="img/beneficio3.webp" alt="Atención-de-calidad">
                </div>
                
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bxslider@4.2.17/dist/jquery.bxslider.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bxslider@4.2.17/dist/jquery.bxslider.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.slider').bxSlider({
                auto:true,
                speed:500,
                pager:false
            });
        });
    </script>


</body>