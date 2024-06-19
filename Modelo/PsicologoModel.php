<?php
class PsicologosModel {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "contigovoy2";
    private $conn;

    public function __construct() {
        // Crear la conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function getPsicologos() {
        // Realizar la consulta
        $sql = "SELECT NombrePsicologo, celular, email, fotoPerfil, sexo, 
                       CASE WHEN virtual = 1 THEN precio_virtual ELSE NULL END as precio_virtual,
                       CASE WHEN presencial = 1 THEN precio_presencial ELSE NULL END as precio_presencial
                FROM psicologos";
        $result = $this->conn->query($sql);

        $psicologos = [];
        // Comprobar si hay resultados y guardarlos en un arreglo
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Verificar si los precios están disponibles antes de agregarlos
                if (!empty($row['precio_virtual'])) {
                    $row['precio_virtual'] = "S/." . htmlspecialchars($row['precio_virtual']);
                }
                if (!empty($row['precio_presencial'])) {
                    $row['precio_presencial'] = "S/." . htmlspecialchars($row['precio_presencial']);
                }
                $psicologos[] = $row;
            }
        }

        return $psicologos;
    }

    public function buscarPorNombre($nombre) {
        // Escapar caracteres especiales
        $nombre = $this->conn->real_escape_string($nombre);
        // Realizar la consulta con filtro por nombre
        $sql = "SELECT NombrePsicologo, celular, email, fotoPerfil, sexo, 
                       CASE WHEN virtual = 1 THEN precio_virtual ELSE NULL END as precio_virtual,
                       CASE WHEN presencial = 1 THEN precio_presencial ELSE NULL END as precio_presencial
                FROM psicologos 
                WHERE NombrePsicologo LIKE '%$nombre%'";
        $result = $this->conn->query($sql);

        $psicologos = [];
        // Comprobar si hay resultados y guardarlos en un arreglo
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Verificar si los precios están disponibles antes de agregarlos
                if (!empty($row['precio_virtual'])) {
                    $row['precio_virtual'] = "S/." . htmlspecialchars($row['precio_virtual']);
                }
                if (!empty($row['precio_presencial'])) {
                    $row['precio_presencial'] = "S/." . htmlspecialchars($row['precio_presencial']);
                }
                $psicologos[] = $row;
            }
        }

        return $psicologos;
    }

    public function __destruct() {
        // Cerrar la conexión
        $this->conn->close();
    }
}
?>
