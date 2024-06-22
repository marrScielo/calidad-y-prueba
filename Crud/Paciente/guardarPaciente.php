<?php
include '../../config/config.php';

// /home3/ghxumdmy/public_html/website_ddbea1df
// require_once("../../Controlador/Paciente/ControllerAtencFamiliar.php");
$ruta_local = "/Controlador/Paciente/ControllerPaciente.php";
$ruta_hosting = "/home3/ghxumdmy/public_html/website_ddbea1df";
require_once($ruta_hosting . $ruta_local);

$obj = new usernameControlerPaciente();
$obj->GuardarPaciente($_POST['NomPaciente'], $_POST['ApPaterno'], $_POST['ApMaterno'], $_POST['Dni'], $_POST['FechaNacimiento'], $_POST['Edad'], $_POST['GradoInstruccion'], $_POST['Ocupacion'], $_POST['EstadoCivil'], $_POST['Genero'], $_POST['Telefono'], $_POST['Email'], $_POST['Direccion'], $_POST['AntecedentesMedicos'],$_POST['IdPsicologo'],$_POST['MedicamentosPrescritos'],$_POST['Provincia'],$_POST['Departamento'],$_POST['Distrito']);

?>
