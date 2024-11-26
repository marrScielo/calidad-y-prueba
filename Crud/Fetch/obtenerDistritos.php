<?php
// local
require '../../conexion/conexion.php';

// hosting
//require("/home3/ghxumdmy/public_html/website_1cf5dd5d/conexion/conexion.php");

$con = new conexion();
$conn = $con->getPDO();

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
