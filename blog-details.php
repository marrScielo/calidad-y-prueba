<?php
include 'conexion/conexion.php';
$conexion = new Conexion();
$pdo = $conexion->getPDO();

if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $query = "SELECT * FROM posts WHERE id = :post_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch recommended articles
        $especialidad = $post['especialidad'];
        $recommendedQuery = "SELECT * FROM posts WHERE especialidad = :especialidad AND id != :post_id LIMIT 3";
        $recommendedStmt = $pdo->prepare($recommendedQuery);
        $recommendedStmt->bindParam(':especialidad', $especialidad, PDO::PARAM_STR);
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
    <link rel="icon" href="img/logo-actual.png">
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
            margin-top: 40px;
        }

        .recommended-articles h3 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .recommended-articles .article {
            margin-bottom: 20px;
            text-align: left;
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
    </style>
    <div class="container">
        <div class="blog-post">
            <img class="image-post" src="<?php echo htmlspecialchars($post['imagen']); ?>" alt="<?php echo htmlspecialchars($post['tema']); ?>">
            <h2><?php echo htmlspecialchars($post['tema']); ?></h2>
            <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($post['especialidad']); ?></p>
            <p><?php echo htmlspecialchars($post['descripcion']); ?></p>
            <p><strong>Publicado por Lic. </strong> <?php echo htmlspecialchars($post['psicologo_id']); ?></p>
        </div>

        <div class="recommended-articles">
            <h3>Artículos Recomendados</h3>
            <?php foreach ($recommendedPosts as $recommendedPost): ?>
                <div class="article">
                    <h4><a href="blog-details.php?id=<?php echo intval($recommendedPost['id']); ?>"><?php echo htmlspecialchars($recommendedPost['tema']); ?></a></h4>
                    <img class="image-post" src="<?php echo htmlspecialchars($post['imagen']); ?>" alt="<?php echo htmlspecialchars($post['tema']); ?>">
                    <p><?php echo htmlspecialchars($recommendedPost['descripcion']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>