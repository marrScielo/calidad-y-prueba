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
        $this->conn->begin_transaction(); // Inicia una transacción
    
        // Verificar si el correo ya existe
        $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        if ($result->num_rows > 0) {
            $this->conn->rollback(); // Revertir la transacción si ya existe el correo
            return "email_exists";
        }
    
        // Encriptar la contraseña
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Insertar en la tabla usuarios
        $stmt = $this->conn->prepare("INSERT INTO usuarios (email, password, fotoPerfil, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $hashPassword, $fotoPerfil, $rol);
        $stmt->execute();
        $usuarioId = $stmt->insert_id; // Obtener el ID del usuario recién creado
        $stmt->close();
    
        // Si el rol es psicólogo, insertar en la tabla psicólogo
        if ($rol === 'psicologo') {
            $stmt = $this->conn->prepare("INSERT INTO psicologo (usuario_id, Passwords, email, introduccion, especialidad_id, NombrePsicologo, video, celular) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssisss", $usuarioId, $hashPassword, $email, $introduccion, $speciality_id, $NombrePsicologo, $video, $celular);
            $stmt->execute();
            $stmt->close();
        }
    
        $this->conn->commit(); // Confirmar la transacción
        return true; // Indicar éxito
    }
    
    public function actualizarUsuario($id, $email, $password, $fotoPerfil, $rol, $introduccion = '', $speciality_id = 0, $NombrePsicologo = '', $video = '', $celular = '') {
        // Si la contraseña está vacía, no actualizarla
        if (!empty($password)) {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        }
    
        // Preparar y ejecutar la consulta para actualizar un usuario existente
        if (!empty($password)) {
            $stmt = $this->conn->prepare("UPDATE usuarios SET email = ?, password = ?, fotoPerfil = ?, rol = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $email, $hashPassword, $fotoPerfil, $rol, $id);
        } else {
            $stmt = $this->conn->prepare("UPDATE usuarios SET email = ?, fotoPerfil = ?, rol = ? WHERE id = ?");
            $stmt->bind_param("sssi", $email, $fotoPerfil, $rol, $id);
        }
        $stmt->execute();
        $stmt->close();
    
        // Actualizar si el rol es psicólogo
        if ($rol === 'psicologo') {
            if (!empty($password)) {
                $stmt = $this->conn->prepare("UPDATE psicologo SET email = ?, Passwords = ?, introduccion = ?, especialidad_id = ?, NombrePsicologo = ?, video = ?, celular = ? WHERE usuario_id = ?");
                $stmt->bind_param("sssisssi", $email, $hashPassword, $introduccion, $speciality_id, $NombrePsicologo, $video, $celular, $id);
            } else {
                $stmt = $this->conn->prepare("UPDATE psicologo SET email = ?, introduccion = ?, especialidad_id = ?, NombrePsicologo = ?, video = ?, celular = ? WHERE usuario_id = ?");
                $stmt->bind_param("ssisssi", $email, $introduccion, $speciality_id, $NombrePsicologo, $video, $celular, $id);
            }
            if ($stmt === false) {
                die("Error en la preparación de la consulta: " . $this->conn->error);
            }
            if ($stmt->execute() === false) {
                die("Error en la ejecución de la consulta: " . $stmt->error);
            }
            $stmt->close();
        }
    
        // Retornar true indicando éxito
        return true;
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
    
        // Retornar true si la operación fue exitosa
        return true;
    }
    

    public function __destruct() {
        // Cerrar la conexión
        $this->conn->close();
    }

    // Buscar un usuario por su ID y retornar sus datos de usuario y psicólogo.
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();
    
        if ($usuario['rol'] === 'psicologo') {
            $stmt = $this->conn->prepare("SELECT * FROM psicologo WHERE usuario_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $psicologo = $result->fetch_assoc();
            $stmt->close();
    
            if ($psicologo) {
                $usuario = array_merge($usuario, $psicologo);
            }
        }
    
        return $usuario;
    }

    public function buscarUsuarios($query) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email LIKE ?");
        $likeQuery = "%".$query."%";
        $stmt->bind_param("s", $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>