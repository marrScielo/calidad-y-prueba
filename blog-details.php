<?php
include_once 'conexion/conexion.php';
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
    <link rel="icon" href="img/Logo.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/header-style.css">
    <link rel="stylesheet" href="css/boton-wsp.css">
    <link rel="stylesheet" href="css/blog-details.css">

</head>

<body>
    <?php include 'Componentes/header.php'; ?>
    <div class="container">
        <span class="especialidad_style"><?php echo htmlspecialchars($post['especialidad']); ?></span>
        <div class="blog-post">
            <h2><?php echo htmlspecialchars($post['tema']); ?></h2>
            <!-- <img loading="lazy" class="image-post" src="<?php echo htmlspecialchars($post['imagen']); ?>" alt="<?php echo htmlspecialchars($post['tema']); ?>">  -->
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
                <img src="<?php echo !empty($post['fotoPerfil']) ? htmlspecialchars($post['fotoPerfil']) : $defaultImage; ?>"
                    alt="Foto de perfil"
                    style="width: 50px; height: 50px; border-radius: 50%; background-size:cover; object-fit:cover;">
                <p>By <?php echo htmlspecialchars($post['psicologo_nombre']); ?></p>
            </div>

            <!-- <hr> -->
            <br />
            <img loading="lazy" class="image-post" src="<?php echo htmlspecialchars($post['imagen']); ?>"
                alt="<?php echo htmlspecialchars($post['tema']); ?>">
            <h2><?php echo htmlspecialchars($post['tema']); ?></h2>
            <p class="content_bg contenidos"><?php echo ($post['descripcion']); ?></p>

        </div>
        <!-- <hr> -->
        <br />
        <h3>Artículos Recomendados</h3>
        <div class="recommended-articles">
            <?php foreach ($recommendedPosts as $recommendedPost): ?>
                <div class="article">
                    <h4><a
                            href="blog-details.php?id=<?php echo intval($recommendedPost['id']); ?>"><?php echo htmlspecialchars($recommendedPost['tema']); ?></a>
                    </h4>
                    <img class="image-post" src="<?php echo htmlspecialchars($recommendedPost['imagen']); ?>"
                        alt="<?php echo htmlspecialchars($recommendedPost['tema']); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Botón flotante de WhatsApp -->
    <a href="https://wa.me/51987654321" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
    <?php
    include_once 'Componentes/footer_new.php';
    ?>
    <script src="js/navabar.js"></script>
</body>

</html>