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

        if ($intervalo->d > 0) {
            // Si han pasado días, mostramos el tiempo en horas
            $tiempoTranscurrido = ($intervalo->d * 24) + $intervalo->h . ' horas';
        } elseif ($intervalo->h > 0) {
            // Si han pasado horas, mostramos el tiempo en horas
            $tiempoTranscurrido = $intervalo->h . ' horas';
        } else {
            // Si han pasado menos de una hora, mostramos el tiempo en minutos
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



        .blog-post img.image-post {
            max-width: 100%;
            width: 100% !important;
            background-size: cover;
            object-fit: cover;
            height: 20rem !important;
            border-radius: 3%;
            margin-bottom: 20px;
        }

        .blog-post h2 {
            text-align: center;
            font-size: 2em;
            margin: 10px 0;
            color: #000000;
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
            color: #a1a4b2 !important;
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
            background: #98d8df;
            color: #333333;
            padding: 0.2rem 2rem;
            border-radius: 1rem;
        }

        .container_fecha {
            display: flex;
            justify-content: space-between;
        }

        .content_blog {
            text-align: justify;
            line-height: 1rem;
        }
    </style>
    <div class="container">
        <span class="especialidad_style"><?php echo htmlspecialchars($post['especialidad']); ?></span>
        <div class="blog-post">
            <h2><?php echo htmlspecialchars($post['tema']); ?></h2>
            <img loading="lazy" class="image-post" src="<?php echo htmlspecialchars($post['imagen']); ?>" alt="<?php echo htmlspecialchars($post['tema']); ?>">
            <hr>
            <div class="container_fecha">
                <p>Publicado: <?php echo htmlspecialchars($fechaFormateada); ?></p>
                <!-- <p><?php echo htmlspecialchars($tiempoTranscurrido); ?></p> -->
            </div>
            <hr>
            <div class="informacion">
                <?php
                // Define the URL of the default image
                $defaultImage = 'https://images.pexels.com/photos/5699456/pexels-photo-5699456.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'; // Reemplaza con la ruta a tu imagen por defecto
                ?>
                <img src="<?php echo !empty($post['fotoPerfil']) ? htmlspecialchars($post['fotoPerfil']) : $defaultImage; ?>" alt="Foto de perfil" style="width: 50px; height: 50px; border-radius: 50%; background-size:cover; object-fit:cover;">
                <p>By <?php echo htmlspecialchars($post['psicologo_nombre']); ?></p>
            </div>

            <!-- <hr> -->
            <br />
            <h2><?php echo htmlspecialchars($post['tema']); ?></h2>
            <p class="content_blog"><?php echo ($post['descripcion']); ?></p>
        </div>
        <!-- <hr> -->
        <br />
        <h3>Artículos Recomendados</h3>
        <div class="recommended-articles">
            <?php foreach ($recommendedPosts as $recommendedPost) : ?>
                <div class="article">
                    <h4><a href="blog-details.php?id=<?php echo intval($recommendedPost['id']); ?>"><?php echo htmlspecialchars($recommendedPost['tema']); ?></a></h4>
                    <img class="image-post" src="<?php echo htmlspecialchars($recommendedPost['imagen']); ?>" alt="<?php echo htmlspecialchars($recommendedPost['tema']); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>