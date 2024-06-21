<?php
session_start();

if (isset($_SESSION['NombrePsicologo'])) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $blog_id = $_GET['id'];

        // Aquí deberías incluir la lógica para conectarte a la base de datos y eliminar el post
        require_once '../Controlador/DatabaseController.php';
        $dbController = new DatabaseController();
        $conn = $dbController->getConnection();

        $sql = "DELETE FROM posts WHERE id = :id AND psicologo_id = :psicologo_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $blog_id, PDO::PARAM_INT);
        $stmt->bindParam(':psicologo_id', $_SESSION['IdPsicologo'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redireccionar de nuevo al panel de blogs después de eliminar
            header("Location: PanelBlog.php");
            exit();
        } else {
            // Manejar el caso en que ocurra un error al eliminar
            echo "Error al intentar eliminar el post.";
        }
    } else {
        // Manejar el caso en que no se proporcionó el parámetro 'id'
        echo "ID de post no especificado.";
    }
} else {
    header("Location: ../index.php");
}
?>
