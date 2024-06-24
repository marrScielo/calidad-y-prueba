<?php
// /home3/ghxumdmy/public_html/website_ddbea1df
require_once("../../Controlador/Cita/ControllerCita.php");
//$ruta_local = "/Controlador/Cita/ControllerCita.php";
//$ruta_hosting = "/home3/ghxumdmy/public_html/website_ddbea1df";
//require_once($ruta_hosting . $ruta_local);

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdCita = $_POST['id_cita'];
    $MotivoCita = $_POST['motivo'];
    $EstadoCita = $_POST['EstadoCita'];
    $FechaInicio = $_POST['fecha_inicio'] . ' ' . $_POST['hora_inicio'];
    $Duracioncita = $_POST['duracion'];
    $TipoCita = $_POST['tipoCita'];
    $CanalCita = $_POST['CanalCita'];
    $EtiquetaCita = $_POST['EtiquetaCita'];
    $ColorFondo = $_POST['ColorFondo'];

    // Crear instancia del controlador
    $controller = new usernameControlerCita();
    
    // Llamar al método modificarCita
    $controller->modificarCita($IdCita, $FechaInicio, $EstadoCita, $MotivoCita, $Duracioncita, $TipoCita, $CanalCita, $EtiquetaCita, $ColorFondo);
} else {
    header("Location: ../../Vista/TablaCitas.php?error=1");
}
