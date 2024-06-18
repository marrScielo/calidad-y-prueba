<?php
include 'config/config.php';
require_once BASE_PATH . 'Controlador/Paciente/ControllerPaciente.php';
// require_once BASE_PATH_WEB . 'Controlador/Paciente/ControllerPaciente.php';
// require_once("/home3/ghxumdmy/public_html/gestion-contigo-voy-com/Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();
$obj->GuardarPaciente($_POST['NomPaciente'], $_POST['ApPaterno'], $_POST['ApMaterno'], $_POST['Dni'], $_POST['FechaNacimiento'], $_POST['Edad'], $_POST['GradoInstruccion'], $_POST['Ocupacion'], $_POST['EstadoCivil'], $_POST['Genero'], $_POST['Telefono'], $_POST['Email'], $_POST['Direccion'], $_POST['AntecedentesMedicos'],$_POST['IdPsicologo'],$_POST['MedicamentosPrescritos'],$_POST['Provincia'],$_POST['Departamento'],$_POST['Distrito']);

?>
