<?php 
    if (isset($_POST["usu"]) && isset($_POST["pass"])) {
        include 'config/config.php';
        require_once MODELlOGINPATH;
        // require("C:/xampp/htdocs/ContigoVoy/Modelo/login/ModelLogin.php");
        $validar = new Login();
        $validar->validarDatos($_POST["usu"], $_POST["pass"]);
    } else {
        header("location:../index.php");
    }
?>