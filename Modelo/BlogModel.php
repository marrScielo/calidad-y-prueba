<?php

class Blog {
    private $conn;
    
    // Conexión del modelo con la base de datos
    public function __construct($db){
        $this->conn = $db->getConnection();
    }
    
    public function obtenerPsicologoId(){
        if (isset($_SESSION['psicologo_id'])) {
            return $_SESSION['psicologo_id'];
        } else {
            return null;
        }
    }

    // CREATE BLOGS
    public function createBlogs($tema, $especialidad, $descripcion, $imagen){
        try {
            $psicologo_id = $this->obtenerPsicologoId();

            if ($psicologo_id === null) {
                throw new Exception("No se pudo obtener el psicologo_id.");
            }

            $stmt = $this->conn->prepare("INSERT INTO posts (tema, especialidad, descripcion, imagen, psicologo_id) VALUES (:tema, :especialidad, :descripcion, :imagen, :psicologo_id)");

            $stmt->bindParam(':tema', $tema);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':psicologo_id', $psicologo_id);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al guardar el artículo: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // READ BLOGS
    public function getAllBlog($limit = 10, $offset = 0){
        $posts = [];
        try {
            $consulta = $this->conn->prepare("
                SELECT 
                    p.id as post_id,
                    p.tema as post_tema,
                    p.especialidad as post_especialidad, 
                    p.descripcion as post_descripcion, 
                    p.imagen as post_imagen, 
                    psico.NombrePsicologo as psicologo_nombre
                FROM
                    posts p
                INNER JOIN
                    psicologo psico
                ON
                    p.psicologo_id = psico.IdPSicologo
                LIMIT :limit OFFSET :offset
            ");
            $consulta->bindParam(':limit', $limit, PDO::PARAM_INT);
            $consulta->bindParam(':offset', $offset, PDO::PARAM_INT);
            $consulta->execute();

            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $posts[] = $row;
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
        return $posts;
    }

    public function getTotalBlogs() {
        try {
            $consulta = $this->conn->query("
                SELECT COUNT(*) as total FROM posts
            ");
            $row = $consulta->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
        return 0;
    }

    // UPDATE BLOGS
    public function updateBlog (){
        
    }
}
