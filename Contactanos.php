<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo-contactanos.css">
    <link rel="stylesheet" href="css/inicio-header1.css">
    <title>Contáctanos</title>
</head>

<body>
    <?php include 'Componentes/header.php'; ?>
    <section class="contactanos-contenedor">
        <div class="contactanos-contenido">
            <div class="texto-contactanos">
                <h2>Contáctanos</h2>
                <p>Estamos a su disposición para cualquier duda o consulta. En menos de 24h te respondemos.</p>
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
</body>

</html>