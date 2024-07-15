<?php
include 'conexion/conexion.php';
$conexion = new Conexion();
$pdo = $conexion->getPDO();

if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $query = "SELECT * FROM posts WHERE id = :post_id";

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

        if ($intervalo->h < 1) {
            $tiempoTranscurrido = $intervalo->i . ' minutos';
        } elseif ($intervalo->h < 24) {
            $tiempoTranscurrido = $intervalo->h . ' horas';
        } else {
            $dias = $intervalo->d;
            $tiempoTranscurrido = $dias . ($dias > 1 ? ' días' : ' día');
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
    <link rel="stylesheet" href="css/inicio-header1.css">
    <link rel="icon" href="img/logo-actual.webp">
    <link rel="stylesheet" href="css/boton-wsp.css">
</head>

<body>
    <?php include 'Componentes/header.php'; ?>
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .blog-post {
            text-align: center;
        }

        .blog-post img.image-post {
            max-width: 100%;
            height: 15rem !important;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .blog-post h2 {
            font-size: 2em;
            margin: 10px 0;
            color: #333;
        }

        .blog-post p {
            font-size: 1em;
            line-height: 1.6;
            color: #666;
            margin: 10px 0;
        }

        .blog-post p strong {
            color: #333;
        }

        .recommended-articles {
            display: flex;
             flex-direction: row;
             justify-content: space-between;
        }

        .recommended-articles h3 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .recommended-articles .article {
            margin-bottom: 20px;
            text-align: left;
            width: 30%;
        }
        .recommended-articles img {
            width: 100%;
        }

        .recommended-articles .article h4 {
            font-size: 1.2em;
            color: #333;
        }

        .recommended-articles .article p {
            font-size: 1em;
            color: #666;
        }

        .recommended-articles .article a {
            text-decoration: none;
            color: #007BFF;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            .blog-post h2 {
                font-size: 1.5em;
            }

            .blog-post p {
                font-size: 0.9em;
            }

            .recommended-articles h3 {
                font-size: 1.2em;
            }

            .recommended-articles .article h4 {
                font-size: 1em;
            }

            .recommended-articles .article p {
                font-size: 0.8em;
            }
        }

        .informacion {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .especialidad_style {
            background: #56B9B3;
            color: black;
            padding: 0.2rem 2rem;
            border-radius: 1rem;
        }

        .container_fecha {
            display: flex;
            justify-content: space-between;
        }

        .content_blog{
            text-align: justify;
            line-height: 1rem;
        }
    </style>
    <div class="container">
        <span class="especialidad_style"><?php echo htmlspecialchars($post['especialidad']); ?></span>
        <div class="blog-post">
            <h2><?php echo htmlspecialchars($post['tema']); ?></h2>
            <img class="image-post" src="<?php echo htmlspecialchars($post['imagen']); ?>" alt="<?php echo htmlspecialchars($post['tema']); ?>">
            <hr>
            <div class="container_fecha">
                <div>
                    <p>Publicado: <?php echo htmlspecialchars($fechaFormateada); ?></p>
                </div>
                <div>
                    <p><?php echo htmlspecialchars($tiempoTranscurrido); ?></p>
                </div>
            </div>
            <hr>
            <div class="informacion">
                <?php if (!empty($post['fotoPerfil'])): ?>
                    <img src="<?php echo htmlspecialchars($post['fotoPerfil']); ?>" alt="Foto de perfil" style="width: 50px; height: 50px; border-radius: 50%;">
                <?php endif; ?>
                <p>By <?php echo htmlspecialchars($post['psicologo_nombre']); ?></p>
            </div>
            <hr>
            <h2><?php echo htmlspecialchars($post['tema']); ?></h2>
            <p class="content_blog"><?php echo htmlspecialchars($post['descripcion']); ?></p>
        </div>
        <hr>
        <h3>Artículos Recomendados</h3>
        <div class="recommended-articles">
            <?php foreach ($recommendedPosts as $recommendedPost): ?>
                <div class="article">
                    <h4><a href="blog-details.php?id=<?php echo intval($recommendedPost['id']); ?>"><?php echo htmlspecialchars($recommendedPost['tema']); ?></a></h4>
                    <img class="image-post" src="<?php echo htmlspecialchars($recommendedPost['imagen']); ?>" alt="<?php echo htmlspecialchars($recommendedPost['tema']); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
