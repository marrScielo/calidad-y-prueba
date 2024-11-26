
<?php
require '../../conexion/conexion.php';

$con = new conexion();
$conn = $con->getPDO();

$NomPaciente = $_POST['NomPaciente'];
$idPsicologo = $_POST['idPsicologo'];

$sql = "SELECT p.IdPaciente, p.NomPaciente, p.ApPaterno, p.ApMaterno, ap.Diagnostico, ap.Tratamiento, 
               p.Email, p.Telefono, p.codigopac, ap.MotivoConsulta, ap.FormaContacto, ap.Observacion, 
               ap.UltimosObjetivos
        FROM paciente p
        LEFT JOIN atencionpaciente ap ON ap.IdPaciente = p.IdPaciente
        WHERE p.NomPaciente = :NomPaciente
        AND p.IdPsicologo = :idPsicologo";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':NomPaciente', $NomPaciente);
$stmt->bindParam(':idPsicologo', $idPsicologo);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $IdPaciente = $row['IdPaciente'];
  $nombrePaciente = $row['NomPaciente'];
  $ApPaterno = $row['ApPaterno'];
  $ApMaterno = $row['ApMaterno'];
  $codigopac = $row['codigopac'];
  $correo = $row['Email'];
  $telefono = $row['Telefono'];
  $motivoConsulta = $row['MotivoConsulta'];
  $formaContacto = $row['FormaContacto'];
  $observacion = $row['Observacion'];
  $ultimosObjetivos = $row['UltimosObjetivos'];

  $response = array(
    'nombre' => $nombrePaciente . " " . $ApPaterno . " " . $ApMaterno,
    'id' => $IdPaciente,
    'correo' => $correo,
    'telefono' => $telefono,
    'codigopac' => $codigopac,
    'diagnostico' => $row['Diagnostico'],
    'tratamiento' => $row['Tratamiento'],
    'motivoConsulta' => $motivoConsulta,
    'formaContacto' => $formaContacto,
    'observacion' => $observacion,
    'ultimosObjetivos' => $ultimosObjetivos
  );
} else {
  $response = array('error' => 'No existe ese paciente');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
