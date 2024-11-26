<?php

// local
require '../../conexion/conexion.php';

// hosting
//require("/home3/ghxumdmy/public_html/website_1cf5dd5d/conexion/conexion.php");

$con = new conexion();
$conn = $con->getPDO();

// Obtener el código enviado por AJAX
$cea10 = $_POST['cea10'];

// Consultar la base de datos para obtener la enfermedad correspondiente
$sql = "SELECT IdEnfermedad,Clasificacion, Gravedad, DSM5
  FROM enfermedad 
  WHERE CEA10 = :cea10";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':cea10', $cea10);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $IdEnfermedad = $row['IdEnfermedad'];
  $Clasificacion = $row['Clasificacion'];
  $DSM5 = $row['DSM5'];
  $Gravedad = $row['Gravedad'];
  $response = array('nombre' => $Clasificacion . " - " . $Gravedad, 'id' => $IdEnfermedad, 'dsm5' => $DSM5);
} else {
  $response = array('error' => 'No existe esa enfermedad');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
