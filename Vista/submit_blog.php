<?php
session_start();
if (isset($_SESSION['NombrePsicologo']) && isset($_SESSION['IdPsicologo'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tema = $_POST['topic'];
        $especialidad = $_POST['specialty'];
        $descripcion = $_POST['description'];
        $imagen = $_POST['image'];
        $psicologo_id = $_SESSION['IdPsicologo'];

        // Conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'contigovoy3');

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Preparar la consulta
        $stmt = $conn->prepare("INSERT INTO posts (tema, especialidad, descripcion, imagen, psicologo_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $tema, $especialidad, $descripcion, $imagen, $psicologo_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Cerrar la conexión
            $stmt->close();
            $conn->close();

            // Almacenar mensaje de éxito en variable de sesión
            $_SESSION['mensaje_blog'] = "Blog registrado correctamente.";

            // Redirigir de nuevo a la página del formulario
            header("Location: Blog.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo "Método de solicitud no permitido.";
    }
} else {
    header("Location: Blog.php");
}
?>
