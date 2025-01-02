<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link el="stylesheet" href="css/styles.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/estilo-footer.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contactanos-seccion-completa.css">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <link rel="icon" href="img/favicon.png">
    <title>Contáctanos</title>
    <style>
        .login-box {
        width: 400px;
        padding: 40px;
        margin: 20px auto;
        background: #483285;
        box-sizing: border-box;
        box-shadow: 0 15px 25px #483285;
        border-radius: 10px;
        margin-left: 30px;
        }

        .login-box p:first-child {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        letter-spacing: 1px;
        }

        .login-box .user-box {
        position: relative;
        margin-bottom: 30px;
        }

        .login-box .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        /* margin-bottom: 30px; */
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
        }

        .login-box .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
        }

        .login-box .user-box input:focus ~ label,
        .login-box .user-box input.has-value ~ label {
            top: -20px;
            left: 0;
            color: #fff;
            font-size: 12px;
        }

        .login-box form a {
        position: relative;
        display: inline-block;
        padding: 15px 20px;
        font-weight: bold;
        color: #fff;
        font-size: 16px;
        text-decoration: none;
        text-transform: uppercase;
        overflow: hidden;
        transition: .5s;
        margin-top: 40px;
        letter-spacing: 3px;
        width: 100%;
        text-align: center;
        }

        .login-box a:hover {
        background: #fff;
        color: #272727;
        border-radius: 5px;
        }

        .login-box a span {
        position: absolute;
        display: block;
        }

        .login-box a span:nth-child(1) {
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #fff);
        animation: btn-anim1 1.5s linear infinite;
        }

        @keyframes btn-anim1 {
        0% {
            left: -100%;
        }

        50%,100% {
            left: 100%;
        }
        }

        .login-box a span:nth-child(2) {
        top: -100%;
        right: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, transparent, #fff);
        animation: btn-anim2 1.5s linear infinite;
        animation-delay: .375s
        }

        @keyframes btn-anim2 {
        0% {
            top: -100%;
        }

        50%,100% {
            top: 100%;
        }
        }

        .login-box a span:nth-child(3) {
        bottom: 0;
        right: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(270deg, transparent, #fff);
        animation: btn-anim3 1.5s linear infinite;
        animation-delay: .75s
        }

        @keyframes btn-anim3 {
        0% {
            right: -100%;
        }

        50%,100% {
            right: 100%;
        }
        }

        .login-box a span:nth-child(4) {
        bottom: -100%;
        left: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(360deg, transparent, #fff);
        animation: btn-anim4 1.5s linear infinite;
        animation-delay: 1.125s
        }

        @keyframes btn-anim4 {
        0% {
            bottom: -100%;
        }

        50%,100% {
            bottom: 100%;
        }
        }

        .login-box p:last-child {
        color: #aaa;
        font-size: 14px;
        }

        .login-box a.a2 {
        color: #fff;
        text-decoration: none;
        }

        .login-box a.a2:hover {
        background: transparent;
        color: #aaa;
        border-radius: 5px;
        }
    .error-message {
    color:rgb(255, 42, 0) !important;
    font-size: 12px;
    font-weight: bold;
    margin: 5px 0 10px;
    display: none;
    text-align: center;
}


    </style>
</head>

<body>
    <?php include 'Componentes/header.php'; ?>
    <section>
        <div>
            <img src="img/contactanos.JPG" alt="Hero contactanos" width="100%">
        </div>
        <div class="container-contact">
            <div class="container-left">
                <p class="parrafo-principal">"La psicología es como una lupa para entender
                    cómo funcionan nuestras mentes y cómo nos
                    comportamos, y nos da herramientas geniales
                    para mejorar nuestra vida y nuestras relaciones."
                </p>
                <div class="icon-name">
                    <img src="ContigoVoyAssets/recursos/2.png" alt="Luana Farela" width="60px">
                    <p>Luana farela</p>
                </div>
                <div class="email-name">
                    <img src="img/mensaje.svg" alt="email">
                    <p>CONTIGO.VOY@gmail.com</p>
                </div>
                
            </div>

            <div>
                <div class="login-box">
                <form id="myForm" action="Controlador/ContactoController.php" method="post">
                    <div class="user-box">
                    <input name="nombre" type="text" autocomplete="off" id="Nombre" data-error-target="error-nombre">
                    <span class="error-message" id="error-nombre"></span>
                    <label>Nombres</label>
                    </div>
                    <div class="user-box">
                    <input name="apellidos" type="text" autocomplete="off" id="Apellidos" data-error-target="error-apellidos">
                    <span class="error-message" id="error-apellidos"></span>
                    <label>Apellidos</label>
                    </div>
                    <div class="user-box">
                    <input  name="phone" type="text" autocomplete="off" id="TelefonoContacto" data-error-target="error-telefono" onpaste="return false">
                    <span class="error-message" id="error-telefono"></span>
                    <label>Número de telefono</label>
                    </div>
                    <div class="user-box">
                    <input  name="email" type="text" autocomplete="off" data-error-target="error-Email" id="Email"
                    >
                    <span class="error-message" id="error-Email"></span>
                    <label>Email</label>
                    </div>
                    <div class="user-box" style="margin-bottom: 0;">
                    <input  name="comentario" type="text" autocomplete="off" id="Comentario" data-error-target="error-comentario">
                    <span class="error-message" id="error-comentario"></span>
                    <!-- <textarea name="comentario"></textarea> -->
                    <label>Comentario</label>
                    </div>

                    
                    <button type="submit" style="background-color: transparent;border: none;width: 100%;cursor: pointer;">
                    <a>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Enviar
                    </a></button>
                </form>
                </div>
            </div>
            
    </section>

    <?php include_once 'Componentes/footer_new.php'; ?>
    <script src="js/navabar.js"></script>
    <!-- Script en línea -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./Issets/js/validationMessageGeneral.js" defer></script>
<script src="./js/ubicacion.js"></script>
<script>
    // Llamada a la función que está en el archivo externo
    const fieldsConfig = {
        TelefonoContacto: 'El teléfono es obligatorio.',
        Email: 'El correo electrónico es obligatorio.',
        Comentario: 'El comentario es obligatorio.',
        Nombre: 'El nombre es obligatorio.',
        Apellidos: 'El apellido es obligatorio.',
        
    }

    document
        .getElementById('myForm')
        .addEventListener('submit', function (e) {
            e.preventDefault()
            if (validateForm(fieldsConfig)) {
                e.target.submit()
            }
        })
</script>
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('#myForm input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.classList.add('has-value');
                });

                input.addEventListener('blur', () => {
                    if (!input.value) {
                        input.classList.remove('has-value');
                    }
                });
            });
        });
    </script>

<?php include_once 'Componentes/chatbot.php'; ?>
	<a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="1.2em"
    fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
    </a>
    
</body>

</html>
