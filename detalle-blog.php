<?php
include 'conexion/conexion.php';
$conexion = new Conexion();
$pdo = $conexion->getPDO();

if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $query = "SELECT posts.*, psicologo.NombrePsicologo AS psicologo_nombre, usuarios.fotoPerfil
              FROM posts
              LEFT JOIN psicologo ON posts.psicologo_id = psicologo.idPsicologo
              LEFT JOIN usuarios ON psicologo.usuario_id = usuarios.id
              WHERE posts.id = :post_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        // Formatear la fecha
        $fechaOriginal = $post['fecha'];
        $fechaFormateada = date("d/m/Y", strtotime($fechaOriginal));

        // Calcular el tiempo transcurrido desde la publicación
        $fechaPublicacion = new DateTime($fechaOriginal);
        $fechaActual = new DateTime();
        $intervalo = $fechaPublicacion->diff($fechaActual);

        if ($intervalo->d > 0) {
            $tiempoTranscurrido = ($intervalo->d * 24) + $intervalo->h . ' horas';
        } elseif ($intervalo->h > 0) {
            $tiempoTranscurrido = $intervalo->h . ' horas';
        } else {
            $tiempoTranscurrido = $intervalo->i . ' minutos';
        }

        // Fetch recommended articles
        $recommendedQuery = "SELECT * FROM posts WHERE id != :post_id ORDER BY RAND() LIMIT 3";
        $recommendedStmt = $pdo->prepare($recommendedQuery);
        $recommendedStmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $recommendedStmt->execute();
        $recommendedPosts = $recommendedStmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "No se encontró el blog.";
        exit;
    }
} else {
    echo "ID de blog no proporcionado.";
    exit;
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="icon" href="img/Logo.png">
    <link rel="stylesheet" href="css/estilos-footer1x.css">
    <link rel="stylesheet" href="css/estilos-footer2.css">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            /* background-color: #f2f7fa; */
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .articulo-img img {
            border-radius: 40px;
            width: 200px;
            height: 100%;
            object-fit: cover;
            margin-right: 20px;
        }

        .content {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            overflow: hidden;
            padding: 20px;
            display: flex;
            flex-direction: column;
            background-color: #63D3C7;
        }

        .content img.image-post {
            width: 100%;
            background-size: cover;
            object-fit: cover;
            height: 20rem;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .content h2 {
            text-align: center;
            font-size: 2em;
            margin: 10px 0;
            color: #fff;
        }

        .content p {
            font-size: 1em;
            line-height: 1.6;
            color: #fff;

            margin: 10px 0;
        }

        .content p strong {
            color: #fff;

        }

        hr {
            width: 100%;
            border-top: 4px solid #fff;
        }

        .sidebar {
            max-width: 300px;
            width: 100%;
            margin-left: 20px;
        }

        .sidebar .widget {
            background-color: #63D3C7;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .widget p {
            color: white;
        }

        .recommended-articles ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .recommended-articles li {
            padding: 0;
        }

        .recommended-articles li a {
            text-decoration: none;
            color: #939393;
            display: block;
        }

        .recommended-articles li a:hover {
            text-decoration: underline;
        }


        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .content,
            .sidebar {
                margin-right: 0;
                width: 100%;
            }

            .recommended-articles .article {
                width: 100%;
            }
        }

        .informacion {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .informacion img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .informacion p {
            margin: 0;
        }

        .especialidad_style {
            background: #98d8df;
            color: #333;
            padding: 0.2rem 2rem;
            border-radius: 1rem;
        }

        .container_fecha {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .content_blog {
            text-align: justify;
            line-height: 1.6;
            color: #666;
        }

        .logo-container {
            text-align: center;
            display: flex;
            justify-content: center;
            margin: 0 auto;
        }

        .logo {
            filter: brightness(0) invert(1);
            width: 150px;
        }
    </style>
</head>

<body>
    <?php include 'Componentes/header.php'; ?>
    <div class="container">
        <div class="articulo-img">
            <img loading="lazy" class="image-post" src="<?php echo htmlspecialchars($post['imagen']); ?>" alt="<?php echo htmlspecialchars($post['tema']); ?>">
        </div>
        <div class="content">
            <h2><?php echo htmlspecialchars($post['tema']); ?></h2>
            <hr />
            <div class="container_fecha">
                <p>Publicado: <?php echo htmlspecialchars($fechaFormateada); ?></p>
                <p><?php echo htmlspecialchars($tiempoTranscurrido); ?></p>
            </div>
            <hr />
            <div class="informacion">
                <p>By <?php echo htmlspecialchars($post['psicologo_nombre']); ?></p>
            </div>
            <hr />
            <p class="content_blog"><?php echo nl2br(htmlspecialchars($post['descripcion'])); ?></p>
        </div>
        <div class="sidebar recommended-articles">
            <div class="widget">
                <div class="logo-container">
                    <img src="img/logo-actual.webp" alt="Logo" class="logo bn">
                </div>
                <p>¿Buscas Psicólogos?</p>

            </div>
            <h4>Últimos artículos:</h4>
            <ul>
                <?php foreach ($recommendedPosts as $recommendedPost) : ?>
                    <li>
                        <a href="blog-details.php?id=<?php echo intval($recommendedPost['id']); ?>">
                            <?php echo htmlspecialchars($recommendedPost['tema']); ?>
                        </a>
                        <br>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php include 'Componentes/footer_new.php'; ?>
</body>

</html>