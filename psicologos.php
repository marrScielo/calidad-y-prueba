<?php
// Incluir el controlador
require_once 'Controlador/PsicologoController.php';

// Crear una instancia del controlador
$psicologosController = new PsicologosController();

// Verificar si se ha enviado un nombre para buscar
$nombreBuscar = isset($_GET['nombre']) ? $_GET['nombre'] : '';

// Llamar al método del controlador según si se busca por nombre o no
if (!empty($nombreBuscar)) {
    $psicologos = $psicologosController->buscarPorNombre($nombreBuscar);
} else {
    $psicologos = $psicologosController->mostrarPsicologos();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Psicólogos</title>
    <link rel="stylesheet" href="css/inicio-header.css">
    <style>
        /* Estilos generales */
        body, html {
            margin: 0;
            padding: 0;
        }

        /* Estilos para el contenedor de psicólogos */
        #psicologos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Centra los elementos horizontalmente */
            max-width: 1200px; /* Ancho máximo para el contenedor */
            margin: 0 auto; /* Centra el contenedor en la página */
        }

        .psicologo {
            border: 1px solid #ccc;
            padding: 16px;
            margin: 8px;
            width: calc(30% - 16px); /* Ajusta el ancho para cuatro columnas por fila */
            box-sizing: border-box;
            border-radius: 8px;
            background-color: #4CAF50; /* Color celeste */
            color: white; /* Texto blanco */
            text-align: center;
        }

        .psicologo h3 {
            margin-top: 0;
        }

        .psicologo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 8px;
        }

        .whatsapp-link {
            display: block;
            margin-top: 10px;
            background-color: #25D366; /* Color verde WhatsApp */
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .whatsapp-link:hover {
            background-color: #128C7E; /* Color verde más oscuro al hacer hover */
        }

        /* Estilos para el buscador */
        .search-container {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        .search-container input[type=text] {
            padding: 10px;
            width: 300px; /* Ancho fijo para el input de búsqueda */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-container input[type=submit] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container input[type=submit]:hover {
            background-color: #45a049;
        }

        /* Media Query para ajustar a tres columnas por fila en pantallas más pequeñas */
        @media (max-width: 768px) {
            .psicologo {
                width: calc(33.333% - 16px); /* Ancho para tres columnas por fila */
            }
        }
    </style>
</head>
<body>
    <?php include 'Componentes/header.php'; ?>

    <div class="search-container">
        <form action="psicologos.php" method="GET">
            <input type="text" placeholder="Buscar por nombre" name="nombre">
            <input type="submit" value="Buscar">
        </form>
    </div>

    <div id="psicologos-container">
        <?php foreach ($psicologos as $psicologo): ?>
            <div class="psicologo">
                <img src="<?= htmlspecialchars($psicologo['fotoPerfil']) ?>" alt="Foto de <?= htmlspecialchars($psicologo['NombrePsicologo']) ?>">
                <h3><?= htmlspecialchars($psicologo['NombrePsicologo']) ?></h3>
                <p>Celular: <?= htmlspecialchars($psicologo['celular']) ?></p>
                <p>Email: <?= htmlspecialchars($psicologo['email']) ?></p>
                <?php if (!empty($psicologo['precio_virtual'])): ?>
                    <p>Precio Virtual: <?= htmlspecialchars($psicologo['precio_virtual']) ?></p>
                <?php endif; ?>
                <?php if (!empty($psicologo['precio_presencial'])): ?>
                    <p>Precio Presencial: <?= htmlspecialchars($psicologo['precio_presencial']) ?></p>
                <?php endif; ?>
                <p>Sexo: <?= htmlspecialchars($psicologo['sexo']) ?></p>
                <?php
                // Formatear el número de teléfono para el enlace de WhatsApp (Perú)
                $telefono = htmlspecialchars($psicologo['celular']);
                $telefono_link = preg_replace('/[^0-9]/', '', $telefono); // Eliminar caracteres no numéricos
                $mensaje = urlencode("Hola quiero unirme al equipo de ContigoVoy"); // Codificar el mensaje para URL
                ?>
                <a class="whatsapp-link" href="https://wa.me/51<?= $telefono_link ?>?text=<?= $mensaje ?>" target="_blank">Enviar mensaje WhatsApp</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
