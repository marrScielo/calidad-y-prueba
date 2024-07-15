
<body>
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        
        /***** FONTS *****/
        #nivel{
            width: 100%;
            background-color:#FFF1E6;
        }
        ul,
        li {
            list-style: none;
        }

        #container {
            width: 60%;
            margin: 0 20%;
            overflow: auto;
        }

        h1 {
            text-align: center;
            margin: 1em 0;
        }

        
        i {
            margin-right: 1em;
        }

        .faq li {
            padding: 1.25em;
        }

        .faq li.q {
            background-color: #eee;
            font-weight: 500;
            font-size: 120%;
            border-bottom: 1px #ccc solid;
            cursor: pointer;
        }

        .faq li.q:nth-child(1),
        .faq li.q:nth-child(5),
        .faq li.q:nth-child(9) {
            background: #ccc;
        }

        .faq li.a {
            color: darkslategray;
            display: none;
        }

        

       

        /********* MEDIA QUERIES ************/
        @media (max-width: 800px) {
            #container {
                width: 90%;
                margin: 0 5%;
            }

            .title {
                width: 90%;
                margin: 0 5%;
                height: 3.5em;
            }

            .faq li {
                text-align: center;
            }

            .faq li.a {
                width: 85%;
                margin-left: 5%;
            }

        }
    </style>
    <div id="nivel">
    <div id="container">
        <h1>Preguntas Frecuentes F.A.Q.</h1>
        <!--<div class="title">
            <h3>Aqui respondemos sobre preguntas</h3>
        </div>-->

        <ul class="faq">
            <li class="q"><i class="ion-chevron-right"></i>¿Que es la psicologia online?</li>
            <li class="a">La psicología online es la prestación de servicios psicológicos a través de plataformas digitales, como videoconferencias, llamadas telefónicas y mensajería instantánea.
            </li>

            <li class="q"><i class="ion-chevron-right"></i>¿Cómo funciona una sesión de terapia online?</li>
            <li class="a">Las sesiones se realizan a través de videoconferencias seguras. Recibirás un enlace para unirte a la sesión desde tu dispositivo.</li>

            <li class="q"><i class="ion-chevron-right"></i>¿Es efectiva la terapia online?</li>
            <li class="a">Sí, numerosos estudios han demostrado que la terapia online puede ser tan efectiva como la terapia presencial para una variedad de problemas psicológicos.
            </li>

            <li class="q"><i class="ion-chevron-right"></i>¿Cómo puedo agendar una sesión en ContigoVoy?</li>
            <li class="a">Puedes agendar una sesión a través de nuestra página web, llamándonos o enviándonos un correo electrónico.</li>

            <li class="q"><i class="ion-chevron-right"></i>¿Necesito algún equipo especial para la terapia online?</li>
            <li class="a">Solo necesitas un dispositivo con acceso a internet, una cámara y un micrófono funcionales. La mayoría de los smartphones, tabletas y computadoras son adecuados.
            </li>

        </ul>
    </div>
    </div>
    
   

    <script>
        // Accordian
        var action = "click";
        var speed = "500";

        $(document).ready(function () {
            // Question handler
            $('li.q').on(action, function () {
                // Get next element
                $(this).next()
                    .slideToggle(speed)
                    // Select all other answers
                    .siblings('li.a')
                    .slideUp();
            });
        });
    </script>
</body>
