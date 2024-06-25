<?php
// local
require '../../conexion/conexion.php';

// hosting
//require("/home3/ghxumdmy/public_html/website_ddbea1df/conexion/conexion.php");

$con = new conexion();
$conn = $con->conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departamentoId = $_POST['departamentoId'];

    try {
        $statement = $conn->prepare("SELECT * FROM provincia WHERE departamento_id = :departamentoId");
        $statement->bindParam(':departamentoId', $departamentoId);
        $statement->execute();
        $provincias = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Devolver las provincias en formato JSON
        echo json_encode($provincias);
    } catch (PDOException $e) {
        // Manejo de errores en caso de excepción
        http_response_code(500); // Código de error 500 - Internal Server Error
        echo json_encode(array('error' => 'Error al obtener las provincias: ' . $e->getMessage()));
    }
} else {
    // Manejo de solicitud incorrecta
    http_response_code(400); // Código de error 400 - Bad Request
    echo json_encode(array('error' => 'Solicitud incorrecta'));
}
?>
