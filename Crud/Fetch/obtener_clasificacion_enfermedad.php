<?php
require_once 'conexion.php';

// Obtener el IdEnfermedad del parámetro GET
$idEnfermedad = $_GET['id'];

// Instanciar la clase de conexión
$conexion = new Conexion();
$pdo = $conexion->conexion();

if (!$pdo) {
    // Manejar errores de conexión si es necesario
    $response = array(
        'error' => 'Error de conexión a la base de datos'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Obtener la clasificación de la enfermedad usando el método de la clase conexión
$clasificacion = $conexion->obtenerClasificacionEnfermedad($idEnfermedad);

if ($clasificacion !== null) {
    // Crear array asociativo para devolver como JSON
    $response = array(
        'clasificacion' => $clasificacion
    );
} else {
    // Si no se encontró la enfermedad o hubo un error
    $response = array(
        'error' => 'Enfermedad no encontrada o error al obtener la clasificación'
    );
}

// Devolver respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
