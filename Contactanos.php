<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header-style.css">
    <title>Contáctanos</title>
    <style>
        @import url('css/styles.css');

        * {
            padding: 0;
            margin: 0;

        }

        .contactanos-contenedor {
            height: calc(100vh - 4.5rem);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contactanos-contenido {
            display: flex;
            margin: 0 3rem;
            border: solid #56B9B3 2px;
            width: 90%;
            align-items: flex-start;
            justify-content: space-between;
            padding: 2rem;
            gap: 2rem;
            box-sizing: border-box;
        }

        .texto-contactanos {
            padding: 0 3rem;
            max-width: 40%;
        }

        .texto-contactanos h2 {
            margin-top: 0;
            color: #56B9B3;
        }

        .contactanos-contenido>form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem 0.5rem;
            padding: 0 2rem;
            width: 50%;
            box-sizing: border-box;
        }

        .formulario-contactanos>input,
        .formulario-contactanos #mensaje {
            padding: 0.5rem;
            border: solid #56B9B3 1px;
            border-radius: 0.3rem;
        }

        .formulario-contactanos #email {
            grid-column: span 2;
        }

        .formulario-contactanos #mensaje {
            grid-column: span 2;
            height: 6rem;
            resize: vertical;
        }

        .formulario-contactanos #enviar {
            grid-column: span 2;
            background-color: #F19394;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .contactanos-contenido {
                flex-direction: column;
                gap: 3rem 0;
            }

            .contactanos-contenido>form {
                padding: 0 3rem;
                width: 100%;
            }

            .texto-contactanos {
                padding: 0 1.5rem;
                max-width: 100%;
            }
        }

        .imagen-contacto {
            max-width: 100%;
            width: 30rem;
            height: auto;
            margin-top: 1rem;
            border: 2px solid #56B9B3;
            border-radius: 0.3rem;
        }

        #enviar {
            color: white;
            transition: 0.5s ease-in-out all;
        }

        #enviar:hover {
            background: #E07A74;
        }

        .contactanos-contenido {
            border-radius: 15px;
            box-shadow: 10px 10px 20px #babecc,
                -10px -10px 20px #ffffff;
        }

        /* Importación de fuentes */
        @import url('https://fonts.googleapis.com/css?family=Raleway:300');
        @import url('https://fonts.googleapis.com/css?family=Lusitana:400,700');





        .texto-contactanos {
            flex: 1;
            /* Permite que el texto ocupe el espacio disponible */
            padding-right: 20px;
            /* Espaciado derecho para separar del formulario */
        }

        .imagen-contacto {
            max-width: 100%;
            /* Asegura que la imagen no se desborde del contenedor */
            height: auto;
            /* Mantiene la proporción de la imagen */
        }

        /* Estilos para el formulario de contacto en esta sección específica */
        .contacto-formulario {
            max-width: 500px;
            /* Ajusta el ancho máximo del formulario de contacto */
            margin: 0;
            /* Elimina los márgenes predeterminados */
            padding: 20px;
            /* Espaciado interior para el formulario */
            background-color: #ffffff;
            /* Fondo blanco para el formulario */
            border-radius: 8px;
            /* Bordes redondeados */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Sombra sutil para el contenedor */
        }

        .contacto-formulario .title {
            text-align: center;
            font-family: Raleway, sans-serif;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 36px;
            line-height: 48px;
            padding-bottom: 48px;
        }

        /* Estilos para el formulario */
        .contacto-formulario .contact-form {
            display: flex;
            flex-wrap: wrap;
            /* Permite que los elementos se envuelvan en la siguiente línea si es necesario */
            gap: 20px;
            /* Espaciado entre los elementos del formulario */
            margin: 0;
            /* Elimina los márgenes predeterminados */
        }

        .contacto-formulario .contact-form .form-field {
            position: relative;
            margin-bottom: 20px;
            /* Espaciado inferior entre los campos del formulario */
            width: calc(50% - 20px);
            /* Ancho del campo con espaciado ajustado */
        }

        .contacto-formulario .contact-form .form-field.col.x-100 {
            width: 100%;
            /* Ancho completo para columnas de 100% */
        }

        .contacto-formulario .contact-form .input-text {
            display: block;
            width: 100%;
            height: 36px;
            border-width: 0 0 2px 0;
            border-color: #000;
            font-family: Lusitana, serif;
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;

        }

        .contacto-formulario .contact-form .input-text:focus {
            outline: none;
            /* Elimina el contorno al enfocar el campo */
        }

        .contacto-formulario .contact-form .input-text:focus+.label,
        .contacto-formulario .contact-form .input-text.not-empty+.label {
            transform: translateY(-24px);
            /* Mueve la etiqueta hacia arriba al enfocar el campo */
        }

        .input-text.has-content:not(:focus)+.label {
            opacity: 0;
        }

        .contacto-formulario .contact-form .label {
            position: absolute;
            left: 20px;
            bottom: 11px;
            font-family: Lusitana, serif;
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
            color: #888;
            cursor: text;
            transition: transform 0.2s ease-in-out, font-size 0.5s ease-in-out, color 0.2s ease-in-out;
            /* Transición suave para el movimiento de la etiqueta */
        }

        .contacto-formulario .contact-form .submit-btn {
            display: inline-block;
            background-color: #000;
            color: #fff;
            font-family: Raleway, sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 16px;
            line-height: 24px;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            /* Cambia el cursor a mano al pasar sobre el botón */
        }

        /* Alineación centrada */
        .contacto-formulario .align-center {
            text-align: center;
            /* Centra el contenido dentro del campo */
        }
    </style>
</head>

<body>
    <?php include 'Componentes/header.php'; ?>
    <section class="contactanos-contenedor">
        <div class="contactanos-contenido">
            <div class="texto-contactanos">
                <h2>Contáctanos</h2>
                <p>Estamos a su disposición para cualquier duda o consulta. En menos de 24h te respondemos.</p>
                <!-- Imagen agregada debajo del texto -->
                <img src="img/plus.webp" alt="Imagen de contacto" class="imagen-contacto">
            </div>
            <div class="contacto-formulario">
                <h1 class="title"></h1>
                <form class="contact-form row">
                    <div class="form-field col x-50">
                        <input id="name" class="input-text js-input" type="text" required>
                        <label class="label" for="name">Nombre</label>
                    </div>
                    <div class="form-field col x-50">
                        <input id="phone" class="input-text js-input" type="tel" pattern="\d{9}" required>
                        <label class="label" for="phone">Telefono</label>
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
                        <input class="submit-btn" type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="js/navabar.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>

</body>

</html>