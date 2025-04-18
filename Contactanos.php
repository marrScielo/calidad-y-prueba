<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link el="stylesheet" href="css/styles.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
<a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank" aria-label="Contáctanos por WhatsApp">
    <i class="fab fa-whatsapp" aria-hidden="true"></i>
</a>

    
</body>

</html>
