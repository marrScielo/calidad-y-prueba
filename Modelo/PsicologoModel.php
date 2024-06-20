<?php
class PsicologosModel
{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }
    public function getPsicologos()
    {
        $psicologos = [];
        try {
            //Obtenemos el id, el tema, la especialidad, la descripcion, la imagen y el nombre del psicologo que lo publicó.
            $consulta = $this->conn->query("SELECT NombrePsicologo, celular, email 
                       CASE WHEN virtual = 1 THEN precio_virtual ELSE NULL END as precio_virtual,
                       CASE WHEN presencial = 1 THEN precio_presencial ELSE NULL END as precio_presencial
                FROM psicologos");
            //Para acceder a los datos se debe colocar $post['post_id'] o $post['psicologo_nombre']
            while($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                // Verificar si los precios están disponibles antes de agregarlos
                if (!empty($row['precio_virtual'])) {
                    $row['precio_virtual'] = "S/." . htmlspecialchars($row['precio_virtual']);
                }
                if (!empty($row['precio_presencial'])) {
                    $row['precio_presencial'] = "S/." . htmlspecialchars($row['precio_presencial']);
                }
                $psicologos[] = $row;
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
        return $psicologos;
    }
    /*
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
*/
    public function buscarPorNombre($nombre)
    {
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
            while ($row = $result->fetch_assoc()) {
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

    public function __destruct()
    {
        // Cerrar la conexión
        $this->conn->close();
    }
}
