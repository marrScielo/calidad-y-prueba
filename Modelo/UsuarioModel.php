<?php
require_once __DIR__.'/../config/credenciales-db.php';
class UsuarioModel {
    
    private $servername = CONFIG_DB['servername'];
    private $username = CONFIG_DB['username'];
    private $password = CONFIG_DB['password'];
    private $database = CONFIG_DB['database'];

    private $conn;

    public function __construct() {
        // Crear la conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }   
    }

    public function getUsuarios() {
        // Realizar la consulta
        $sql = "SELECT id, email, password, fotoPerfil, rol FROM usuarios";
        $result = $this->conn->query($sql);

        $usuarios = [];
        // Comprobar si hay resultados y guardarlos en un arreglo
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }

    public function buscarPorEmail($email) {
        // Escapar caracteres especiales
        $email = $this->conn->real_escape_string($email);
        // Realizar la consulta con filtro por email
        $sql = "SELECT id, email, password, fotoPerfil, rol FROM usuarios WHERE email LIKE '%$email%'";
        $result = $this->conn->query($sql);

        $usuarios = [];
        // Comprobar si hay resultados y guardarlos en un arreglo
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }

    public function agregarUsuario($email, $password, $fotoPerfil, $rol, $introduccion = '', $speciality_id = 0, $NombrePsicologo = '', $video = '', $celular = '') {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Preparar y ejecutar la consulta para insertar un nuevo usuario
        $stmt = $this->conn->prepare("INSERT INTO usuarios (email, password, fotoPerfil, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $hashPassword, $fotoPerfil, $rol);
        $stmt->execute();
    
        // Obtener el ID del usuario recién creado
        $usuarioId = $stmt->insert_id;
        $stmt->close();
    
        // Si el rol es psicologo, agregar un nuevo registro en la tabla psicologo
        if ($rol === 'psicologo') {
            $stmt = $this->conn->prepare("INSERT INTO psicologo (usuario_id, Passwords, email, introduccion, especialidad_id, NombrePsicologo, video, celular) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssisss", $usuarioId, $hashPassword, $email, $introduccion, $speciality_id, $NombrePsicologo, $video, $celular);
            $stmt->execute();
            $stmt->close();
        }
    }
    

    public function actualizarUsuario($id, $email, $password, $fotoPerfil, $rol, $introduccion = '', $speciality_id = 0, $NombrePsicologo = '', $video = '', $celular = '') {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Preparar y ejecutar la consulta para actualizar un usuario existente
        $stmt = $this->conn->prepare("UPDATE usuarios SET email = ?, password = ?, fotoPerfil = ?, rol = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $email, $hashPassword, $fotoPerfil, $rol, $id);
        $stmt->execute();
        $stmt->close();
    
        // Agregar depuración para verificar el valor antes de la consulta
        error_log("especialidad_id: " . $speciality_id);
    
        if ($rol === 'psicologo') {
            // Actualizar la tabla psicologo con los nuevos campos
            $stmt = $this->conn->prepare("UPDATE psicologo SET email = ?, Passwords = ?, introduccion = ?, especialidad_id = ?, NombrePsicologo = ?, video = ?, celular = ? WHERE usuario_id = ?");
            if ($stmt === false) {
                die("Error en la preparación de la consulta: " . $this->conn->error);
            }
            $stmt->bind_param("sssisssi", $email, $hashPassword, $introduccion, $speciality_id, $NombrePsicologo, $video, $celular, $id);
            if ($stmt->execute() === false) {
                die("Error en la ejecución de la consulta: " . $stmt->error);
            }
            $stmt->close();
        }
    }    

    public function eliminarUsuario($id) {
            // Primero eliminar el registro en la tabla psicologo si el usuario es un psicologo
            $stmt = $this->conn->prepare("DELETE FROM psicologo WHERE usuario_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();

            // Preparar y ejecutar la consulta para eliminar un usuario
            $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
    }

    public function __destruct() {
        // Cerrar la conexión
        $this->conn->close();
    }
}
?>