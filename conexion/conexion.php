<?php
class conexion{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "contigovoy3";

    //private $servername = "localhost";
    //private $username = "ghxumdmy_psicologoapk";
    //private $password = "Psicologo123";
    //private $database = "ghxumdmy_psicologia";


    public function conexion(){
        try{
            $PDO=new PDO("mysql:host=".$this->servername.";dbname=".$this->database,$this->username,$this->password);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $PDO;

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}
?>