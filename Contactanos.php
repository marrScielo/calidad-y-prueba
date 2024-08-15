<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link el="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/estilos-footer.css">
    <link rel="icon" href="img/Logo.png">
    <title>Contáctanos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;

        }

        .container-contact{
            display: flex;
            flex-direction: row;
            width: 90%;
            justify-content: center;
            align-items: center;
            margin: auto;
            max-width: 1200px;
            color: #534489;
        }

        .parrafo-principal{
            text-wrap: balance;
            padding-top: 2em;
            padding-bottom: 2em;
        }

        .icon-name {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .redes {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .redes ul {
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
            list-style: none;
            margin-right: 5px;
            gap: 5px;
        }

        .redes ul li {
            width: 35px;
            height: 35px;
            background-color: white;
            border-radius: 100%;
        }

        .redes ul li img {
            width: 100%;
            height: 100%;
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
       <div>
            <p class="parrafo-principal">"La psicología es como una lupa para entender 
                ómo funcionan nuestras mentes y cómo nos 
                omportamos, y nos da herramientas geniales
                para mejorar nuestra vida y nuestras relaciones."
            </p>
            <div class="icon-name">
                <img src="ContigoVoyAssets/recursos/2.png" alt="Luana Farela" width="60px">
                <p>Luana farela</p>
            </div>
            <div>
                <img src="" alt="">
                <p>Luana farela@outlook.com</p>
            </div>
            <div class="redes">
                <ul>
                    <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 11-8.png" alt="Facebook"></a></li>
                    <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 12-8.png" alt="Twitter"></a></li>
                    <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 13-8.png" alt="Instagram"></a></li>
                    <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 14-8.png" alt="YouTube"></a></li>
                    <li><a href=""><img src="../../ContigoVoy/img/ICONOS REDES SOCIALES/Recurso 16-8.png" alt="TikTok"></a></li>
                </ul>
            </div>
        </div>
        
    </section>
    <!-- <section class="contactanos-contenedor">
        <div class="contactanos-contenido">
            <div class="texto-contactanos">
                <h2>Contáctanos</h2>
                <p>Estamos a su disposición para cualquier duda o consulta. En menos de 24h te respondemos.</p>
            
                <img src="img/plus.webp" alt="Imagen de contacto" class="imagen-contacto">
            </div>
            <div class="contacto-formulario">
                <h1 class="title"></h1>
                <form id="contactForm" class="contact-form row">
                    <div class="form-field col x-50">
                        <input id="name" class="input-text js-input" type="text" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="Ingresar solo letras">
                        <label class="label" for="name">Nombre</label>
                    </div>
                    <div class="form-field col x-50">
                        <input id="phone" class="input-text js-input" type="tel" pattern="\d{9}" maxlength="9" required title="Ingresar solo números">
                        <label class="label" for="phone">Teléfono</label>
                    </div>
                    <div class="form-field col x-100">
                        <input id="email" class="input-text js-input" type="email" required>
                        <label class="label" for="email">E-mail</label>
                    </div>

                    <div class="form-field col x-100">
                        <input id="message" class="input-text js-input" type="text" required>
                        <label class="label" for="message">Mensaje</label>
                    </div>
                    <div class="form-field col x-100 align-center">
                        <input class="submit-btn" type="submit" value="Enviar Mensaje">
                    </div>
                </form>
            </div>
        </div>
    </section> -->

    <script src="js/navabar.js"></script>

    <script>
       /*  document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.input-text');

            inputs.forEach(input => {
                // Restaura el estado inicial cuando la página se carga
                if (input.value.trim() !== '') {
                    input.classList.add('has-content');
                } else {
                    input.classList.remove('has-content');
                }

                // Maneja el evento de entrada del campo
                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.classList.add('has-content');
                    } else {
                        this.classList.remove('has-content');
                    }
                });
            });

        }); */
    </script>
   <!--  <?php include 'Componentes/footer_new.php'; ?> -->

</body>
</html>
