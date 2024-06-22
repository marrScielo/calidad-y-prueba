<?php
// include '../../config/config.php';
// require_once BASE_PATH . '/conexion/conexion.php';

// require_once BASE_PATH_WEB . 'conexion/conexion.php';
// hosting
require("/home3/ghxumdmy/public_html/website_ddbea1df/conexion/conexion.php");

$con = new conexion();
$conn = $con->conexion();

// Obtener el código enviado por AJAX
$dsm5 = $_POST['dsm5'];

// Consultar la base de datos para obtener la enfermedad correspondiente
$sql = "SELECT IdEnfermedad,Clasificacion, Gravedad, CEA10
  FROM enfermedad 
  WHERE DSM5 = :dsm5";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':dsm5', $dsm5);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $IdEnfermedad = $row['IdEnfermedad'];
  $CEA10 = $row['CEA10'];
  $Clasificacion = $row['Clasificacion'];
  $Gravedad = $row['Gravedad'];
  $response = array('nombre' => $Clasificacion . " - " . $Gravedad, 'id' => $IdEnfermedad, 'cea10' => $CEA10);
} else {
  $response = array('error' => 'No existe esa enfermedad');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
