<?php
include 'config/config.php';
require_once BASE_PATH . 'conexion/conexion.php';
// require_once BASE_PATH_WEB . 'conexion/conexion.php';
// require("/home3/ghxumdmy/public_html/gestion-contigo-voy-com/conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// obtener_provincias.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $provinciaId = $_POST['provinciaId'];

    // Realizar la consulta SQL para obtener las provincias del departamento seleccionado
    $statement = $conn->prepare("SELECT * FROM distrito WHERE provincia_id = :provinciaId");
    $statement->bindParam(':provinciaId', $provinciaId);
    $statement->execute();
    $provincias = $statement->fetchAll();

    echo json_encode($provincias);
}
?>