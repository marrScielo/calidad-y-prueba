<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header-style.css">
    <title>Contáctanos</title>
    <style>
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

        #enviar{
            color: white;
            transition: 0.5s ease-in-out all;
        }

        #enviar:hover{
            background: #E07A74;
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
            <form class="formulario-contactanos" action="./Controlador/ContactoController.php?action=create" method="post">
                <input id="nombre" type="text" placeholder="Nombre" name="nombre">
                <input id="telefono" type="number" placeholder="Telefono" name="telefono">
                <input id="email" type="email" placeholder="Email" name="email">
                <textarea id="mensaje" type="text" placeholder="Mensaje" name="mensaje"></textarea>
                <input id="enviar" type="submit" value="Enviar">
            </form>
        </div>
    </section>
    <script src="js/navabar.js"></script>
</body>

</html>
