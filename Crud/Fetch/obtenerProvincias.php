<?php
require("/home3/ghxumdmy/public_html/gestion-contigo-voy-com/conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// obtener_provincias.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departamentoId = $_POST['departamentoId'];

    // Realizar la consulta SQL para obtener las provincias del departamento seleccionado
    $statement = $conn->prepare("SELECT * FROM provincia WHERE departamento_id = :departamentoId");
    $statement->bindParam(':departamentoId', $departamentoId);
    $statement->execute();
    $provincias = $statement->fetchAll();

    echo json_encode($provincias);
}
?>