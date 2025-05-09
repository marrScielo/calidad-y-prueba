<?php
// local
 require '../../conexion/conexion.php';


// hosting
//require("/home3/ghxumdmy/public_html/website_1cf5dd5d/conexion/conexion.php");

// Verificar si se ha recibido una solicitud POST con los IDs a eliminar
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ids'])) {
    // Crear una instancia de la clase de conexión
    $conexion = new conexion();

    try {
        // Obtener una conexión PDO
        $PDO = $conexion->getPDO();

        // Obtener los IDs de los registros a eliminar desde la solicitud POST
        $idsAEliminar = json_decode($_POST['ids']);

        // Construir la consulta de eliminación
        $sql = "DELETE FROM cita WHERE IdCita IN (" . implode(",", $idsAEliminar) . ")";

        // Ejecutar la consulta de eliminación
        $resultado = $PDO->exec($sql);

        // Verificar si se eliminaron registros
        if ($resultado !== false) {
            echo "Registros eliminados correctamente";
        } else {
            echo "No se pudieron eliminar los registros.";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión: " . $e->getMessage();
    }
} else {
    echo "Solicitud no válida.";
}
?>
