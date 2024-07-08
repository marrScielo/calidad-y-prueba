<?php
// local
require '../../conexion/conexion.php';

// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Obtener el IdPsicologo de la sesión
$idPsicologo = $_SESSION['IdPsicologo'] ?? null;

// Verificar si se reciben los parámetros esperados
if (!isset($_POST['codigopac']) || !isset($_POST['idPsicologo'])) {
  $response = array('error' => 'Parámetros no recibidos');
  header('Content-Type: application/json');
  echo json_encode($response);
  exit;
}

// Obtener los datos enviados por POST
$codigopac = $_POST['codigopac'];
$idPsicologo = $_POST['idPsicologo'];

// Conectar a la base de datos
$con = new conexion();
$conn = $con->conexion();

// Preparar la consulta SQL para obtener datos del paciente, incluyendo datos de atencionpaciente si es necesario
$sql = "SELECT p.NomPaciente, p.ApPaterno, p.ApMaterno, p.Email, p.Telefono, p.IdPaciente,
               ap.MotivoConsulta, ap.FormaContacto, ap.Diagnostico, ap.Tratamiento,
               ap.Observacion, ap.UltimosObjetivos, p.codigopac
        FROM paciente p
        LEFT JOIN atencionpaciente ap ON ap.IdPaciente = p.IdPaciente
        WHERE p.codigopac = :codigopac
        AND p.IdPsicologo = :idPsicologo";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':codigopac', $codigopac);
$stmt->bindParam(':idPsicologo', $idPsicologo);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  // Construir la respuesta con los datos del paciente
  $response = array(
    'nombre' => $row['NomPaciente'] . " " . $row['ApPaterno'] . " " . $row['ApMaterno'],
    'id' => $row['IdPaciente'],
    'correo' => $row['Email'],
    'telefono' => $row['Telefono'],
    'motivoConsulta' => $row['MotivoConsulta'],
    'formaContacto' => $row['FormaContacto'],
    'diagnostico' => $row['Diagnostico'],
    'tratamiento' => $row['Tratamiento'],
    'observacion' => $row['Observacion'],
    'ultimosObjetivos' => $row['UltimosObjetivos'],
    'codigopac' => $row['codigopac'] // Asegúrate de incluir el código paciente
  );
} else {
  // Si no se encuentra el paciente, devolver un mensaje de error
  $response = array('error' => 'No existe ese paciente');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
