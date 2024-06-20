<?php

class Blog {
    private $conn;
    
    //Conexion del modelo con la base de datos
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
            // Obtener el psicologo_id utilizando el método previamente definido
            $psicologo_id = $this->obtenerPsicologoId();

            if ($psicologo_id === null) {
                throw new Exception("No se pudo obtener el psicologo_id.");
            }

            // La consulta a la db
            $stmt = $this->conn->prepare("INSERT INTO posts (tema, especialidad, descripcion, imagen, psicologo_id) VALUES (:tema, :especialidad, :descripcion, :imagen, :psicologo_id)");

            // stmt: objeto devuelto por prepare
            // bindParam: vincula parametros con la consulta sql
            $stmt->bindParam(':tema', $tema);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':psicologo_id', $psicologo_id);

            // ejecutar stmt
            $stmt->execute();
            // Se puede retorar a blog.php o donde prefiera
            return true;
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            echo "Error al guardar el artículo: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            // Manejar otros errores
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // READ BLOGS
    public function getAllBlog (){
        $posts = [];
        try{
            //Obtenemos el id, el tema, la especialidad, la descripcion, la imagen y el nombre del psicologo que lo publicó.
            $consulta = $this->conn->query("
                
                Select 
                    p.id as post_id,
                    p.tema as post_tema,
                    p.especialidad as post_especialidad, 
                    p.descripcion as post_descripcion, 
                    p.imagen as post_imagen, 
                    psico.NombrePsicologo as psicologo_nombre
                from
                    posts p
                inner join
                    psicologos psico
                on
                    p.psicologo_id = psico.IdPSicologo
            ");
            //Para acceder a los datos se debe colocar $post['post_id'] o $post['psicologo_nombre']
            while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
                $posts[] = $row;
            }
        }catch (PDOException $e){
            echo "Error en la consulta: " . $e->getMessage();
        }
        return $posts;
    }

    // UPDATE BLOGS
    public function updateBlog (){
        
    }
}