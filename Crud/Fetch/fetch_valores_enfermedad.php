<?php

// local
require '../../conexion/conexion.php';

// hosting
//require("/home3/ghxumdmy/public_html/website_1cf5dd5d/conexion/conexion.php");

$con = new conexion();
$conn = $con->getPDO();

// Consultar la base de datos para obtener todos los CEA10 y DSM5
$sql = "SELECT CEA10, DSM5 FROM enfermedad";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Obtener todos los resultados de la consulta
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($rows) {
    $response = array('data' => $rows);
} else {
    $response = array('error' => 'No existen enfermedades registradas');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
