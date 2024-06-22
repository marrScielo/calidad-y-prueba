<?php
// include '../../config/config.php';
// require_once CONEXION_PATH;
// require_once BASE_PATH . 'conexion/conexion.php';

// hosting
require("/home3/ghxumdmy/public_html/website_ddbea1df/conexion/conexion.php");

$con = new conexion();
$conn = $con->conexion();

// obtener_distritos.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $provinciaId = $_POST['provinciaId'];

    // Realizar la consulta SQL para obtener los distritos de la provincia seleccionada
    $statement = $conn->prepare("SELECT * FROM distrito WHERE provincia_id = :provinciaId");
    $statement->bindParam(':provinciaId', $provinciaId);
    $statement->execute();
    $distritos = $statement->fetchAll();

    // Devolver los distritos en formato JSON
    echo json_encode($distritos);
}
?>
