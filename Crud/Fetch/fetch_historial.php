<?php
include 'config/config.php';
require_once BASE_PATH . 'conexion/conexion.php';
// require_once BASE_PATH_WEB . 'conexion/conexion.php';
//   require("/home3/ghxumdmy/public_html/gestion-contigo-voy-com/conexion/conexion.php");

// Obtener el valor del ID del paciente ingresado
$patientId = $_POST['patientId'];

$sql = "SELECT 
            p.NomPaciente, 
            p.ApPaterno, 
            c.FechaInicioCita, 
            c.DuracionCita, 
            c.MotivoCita, 
            c.TipoCita, 
            c.DuracionCita, 
            c.CanalCita
        FROM 
            paciente p
        LEFT JOIN 
            cita c ON p.IdPaciente = c.IdPaciente
        WHERE 
            p.IdPaciente = :patientId";



$con = new conexion();
$conn = $con->conexion();
$stmt = $conn->prepare($sql);
$stmt->bindParam(':patientId', $patientId);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($rows) {
    $response = array('patientDetails' => $rows);
} else {
    $response = array('error' => 'No existe ese paciente');
}

header('Content-Type: application/json');
echo json_encode($response);
