<?php
class conexion{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "contigovoy3";
    private $conn;

    //private $servername = "localhost";
    //private $username = "ghxumdmy_psicologoapk";
    //private $password = "Psicologo123";
    //private $database = "ghxumdmy_psicologia";
    //private $conn;

    public function conexion(){
        try{
            $PDO=new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $PDO;

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}
?>