<?php

require_once(__DIR__ . "/../../Controlador/Cita/ControllerCita.php");

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdCita = $_POST['appointmentId'];
    $MotivoCita = $_POST['appointmentReason'];
    $EstadoCita = $_POST['appointmentStatus'];
    $FechaInicio = $_POST['startDate'] . ' ' . $_POST['startTime'];
    $Duracioncita = $_POST['duration'];
    $TipoCita = $_POST['appointmentType'];
    $CanalCita = $_POST['attractionChannel'];
    $EtiquetaCita = $_POST['EtiquetaCita'];
    $ColorFondo = $_POST['appointmentColor'];

    // Crear instancia del controlador
    $controller = new usernameControlerCita();

    // Llamar al método modificarCita
    $controller->modificarCita($IdCita, $FechaInicio, $EstadoCita, $MotivoCita, $Duracioncita, $TipoCita, $CanalCita, $EtiquetaCita, $ColorFondo);
} else {
    header("Location: ../../Vista/TablaCitas.php?error=1");
}
