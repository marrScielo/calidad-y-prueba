<?php

class Blog {
    private $conn;
    
    //Conexion del modelo con la base de datos
    public function __construct($db){
        $this->conn = $db->getConnection();
    }
    

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
}