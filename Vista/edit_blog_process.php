<?php
require_once '../Controlador/DatabaseController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $tema = $_POST['tema'];
    $especialidad = $_POST['especialidad'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    $dbController = new DatabaseController();
    $conn = $dbController->getConnection();

    $sql = "UPDATE posts SET tema = :tema, especialidad = :especialidad, descripcion = :descripcion, imagen = :imagen WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':tema', $tema, PDO::PARAM_STR);
    $stmt->bindParam(':especialidad', $especialidad, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        header("Location: PanelBlog.php");
    } else {
        echo "Error al actualizar el post.";
    }
}
?>
