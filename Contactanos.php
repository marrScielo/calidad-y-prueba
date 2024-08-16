<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link el="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/estilos-footer.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/Logo.png">
    <title>Contáctanos</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .container-contact{
            font-family: "Montserrat", sans-serif;
            display: flex;
            flex-direction: row;
            width: 90%;
            justify-content: center;
            align-items: center;
            margin: auto;
            max-width: 1200px;
            color: #534489;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .parrafo-principal{
            text-wrap: balance;
            padding-top: 2em;
            padding-bottom: 2em;
            font-size: 1.2em;
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
            align-self: center;
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

        .email-name {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .container-left{
            display: flex;
            flex-direction: column;
            gap: 1em;
            width: 40%;
        }

        .contact-form {
            padding: 20px;
            width: 400px;
        }

        .contact-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #524388;
        }

        .contact-form .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .contact-form textarea {
            height: 150px;
            resize: none;
        }

        .contact-form button {
            padding: 10px;
            background-color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            color: #524388;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact-form button:hover {
            background-color: #e0e0e0;
        }

        @media(max-width: 768px){
            .container-contact {
                flex-direction: column;
                gap: 2rem;
            }

            .container-left {
                width: 100%;
                align-items: center;
                text-align: center;
            }

            .contact-form{
                width: initial;
            }
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
                ómo funcionan nuestras mentes y cómo nos 
                omportamos, y nos da herramientas geniales
                para mejorar nuestra vida y nuestras relaciones."
            </p>
            <div class="icon-name">
                <img src="ContigoVoyAssets/recursos/2.png" alt="Luana Farela" width="60px">
                <p>Luana farela</p>
            </div>
            <div class="email-name">
                <img src="img/email.png" alt="email">
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
        
        <div>
            <form class="contact-form">
                <label for="nombre">Nombre</label>
                <div class="input-group">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos">
                </div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email">
                <label for="comentario">Comentario o mensaje</label>
                <textarea id="comentario" name="comentario" placeholder="Comentario o mensaje"></textarea>
                <button type="submit">Enviar</button>
             </form>
        </div>

    </section>


    <script>

    </script>
   <!--  <?php include 'Componentes/footer_new.php'; ?> -->

</body>
</html>
