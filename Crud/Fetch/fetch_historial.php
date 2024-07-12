<?php
// local
require '../../conexion/conexion.php';

// Obtener el valor del ID del paciente ingresado
$patientId = $_POST['patientId'];

/*$sql = "SELECT 
            p.NomPaciente, 
            p.ApPaterno, 
            c.FechaInicioCita, 
            c.DuracionCita, 
            c.MotivoCita, 
            c.TipoCita, 
            c.CanalCita,
            a.Observacion,
            a.IdAtencion
        FROM 
            paciente p
        LEFT JOIN 
            cita c ON p.IdPaciente = c.IdPaciente
        LEFT JOIN 
            atencionpaciente a ON p.IdPaciente = a.IdPaciente
        WHERE 
            p.IdPaciente = :patientId
        GROUP BY 
            c.IdCita, a.IdAtencion";*/


$sql = "SELECT 
            p.NomPaciente, 
            p.ApPaterno, 

            a.FechaRegistro,
            a.Observacion,
            a.IdAtencion,
            a.Diagnostico,
            a.Tratamiento,
            a.UltimosObjetivos,

            e.Clasificacion
        FROM 
            paciente p
        LEFT JOIN 
            atencionpaciente a ON p.IdPaciente = a.IdPaciente 
        LEFT JOIN 
            enfermedad e ON a.IdEnfermedad = e.IdEnfermedad 
        WHERE 
            p.IdPaciente = :patientId";


$con = new conexion();
$conn = $con->conexion();
$stmt = $conn->prepare($sql);
$stmt->bindParam(':patientId', $patientId);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Aquí deberías tener lógica adicional para manejar las observaciones únicas por cita
// Esto podría incluir un proceso de actualización si encuentras observaciones repetidas

if ($rows) {
    $response = array('patientDetails' => $rows);
} else {
    $response = array('error' => 'No existe ese paciente');
}

header('Content-Type: application/json');
echo json_encode($response);
?>
