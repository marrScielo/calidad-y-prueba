<?php
// local
require '../../conexion/conexion.php';

// hosting
//require("/home3/ghxumdmy/public_html/website_ddbea1df/conexion/conexion.php");

$con = new conexion();
$conn = $con->conexion();

$Telefono = $_REQUEST['Telefono'];
$jsonData = array();
// Verificar Telefono
$selectQuery = "SELECT Telefono FROM paciente WHERE Telefono=:telefono";
$stmt = $conn->prepare($selectQuery);
$stmt->bindParam(':telefono', $Telefono);
$stmt->execute();
$totalCliente = $stmt->rowCount();
if ($totalCliente <= 0) {
    $jsonData['success'] = 0;
    $jsonData['message'] = '';

} else {
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe alguien con este telefono. <strong>(' . $Telefono . ')</strong></p>';
}

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>
