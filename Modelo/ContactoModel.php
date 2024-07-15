<?php

require_once '../conexion/conexion.php';

class Contacto{
    private $conn;

    public function __construct(){
        $db = new conexion;
        $this->conn = $db->conexion();
    }

    public function create( $nombre, $telefono, $email, $mensaje ){
        try{
            $consulta = $this->conn->prepare("INSERT INTO contacto (nombre, telefono, email, mensaje) VALUES (:nombre, :telefono, :email, :mensaje)");
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':telefono', $telefono);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':mensaje', $mensaje);

            $consulta->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error de la consulta: " . $e->getMessage();
            return false;
        }
    }

    
}