<?php
class UsuarioModel {

    //hosting 
    // private $servername = "localhost";
    // private $username = "ghxumdmy_psicologoapk";
    // private $password = "Psicologo123";
    // private $database = "ghxumdmy_psicologia";
    // private $conn;
    
    //local
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "contigovoy3";
    private $conn;

    public function __construct() {
        // Crear la conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
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

    public function agregarUsuario($email, $password, $fotoPerfil, $rol) {
        // Preparar y ejecutar la consulta para insertar un nuevo usuario
        $stmt = $this->conn->prepare("INSERT INTO usuarios (email, password, fotoPerfil, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $password, $fotoPerfil, $rol);
        $stmt->execute();

        // Obtener el ID del usuario recién creado
        $usuarioId = $stmt->insert_id;
        $stmt->close();

        // Si el rol es psicologo, agregar un nuevo registro en la tabla psicologo
        if ($rol === 'psicologo') {
            $stmt = $this->conn->prepare("INSERT INTO psicologo (usuario_id, Passwords, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $usuarioId, $password, $email);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function actualizarUsuario($id, $email, $password, $fotoPerfil, $rol) {
        // Preparar y ejecutar la consulta para actualizar un usuario existente
        $stmt = $this->conn->prepare("UPDATE usuarios SET email = ?, password = ?, fotoPerfil = ?, rol = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $email, $password, $fotoPerfil, $rol, $id);
        $stmt->execute();
        $stmt->close();

        // Si el rol es psicologo, actualizar la información en la tabla psicologo
        if ($rol === 'psicologo') {
            $stmt = $this->conn->prepare("UPDATE psicologo SET email = ?, Passwords = ? WHERE usuario_id = ?");
            $stmt->bind_param("ssi", $email, $password, $id);
            $stmt->execute();
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
