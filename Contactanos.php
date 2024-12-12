<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link el="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/estilo-footer.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contactanos-seccion-completa.css">
    <link rel="icon" href="img/favicon.png">
    <title>Contáctanos</title>
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
                    <img style="height" src="img/mensaje.png" alt="email">
                    <p>CONTIGO.VOY@gmail.com</p>
                </div>
                
            </div>

            <div>
                <form class="contact-form" action="Controlador/ContactoController.php" method="post">
                    <label for="nombre">Nombre</label>
                    <div class="input-group">
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Ingrese su apellido" required>
                    </div>
                    <label for="email">Numero de telefono</label>
                    <input type="text" id="phone" name="phone" placeholder="Ingrese su numero de telefono" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <label for="comentario">Comentario o mensaje</label>
                    <textarea id="comentario" name="comentario" placeholder="Ingrese su comentario o mensaje" required></textarea>
                    <button type="submit">Enviar</button>
                </form>
            </div>
    </section>

    <?php include_once 'Componentes/footer_new.php'; ?>
    <script src="js/navabar.js"></script>
</body>

</html>