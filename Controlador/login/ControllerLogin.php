<?php 
    if (isset($_POST["usu"]) && isset($_POST["pass"])) {
       
        //include 'config/config.php';
        //include_once $_SERVER['DOCUMENT_ROOT'].'/ContigoVoy/config/config.php';
        // require("C:/xampp/htdocs/ContigoVoy/Modelo/login/ModelLogin.php");
        //require_once MODELlOGINPATH;
        include_once '../../Modelo/login/ModelLogin.php';

        //require_once("/home3/ghxumdmy/public_html/website_ddbea1df/Modelo/login/ModelLogin.php");

        $validar = new Login();
        $validar->validarDatos($_POST["usu"], $_POST["pass"]);
    } else {
        header("location:../index.php");
    }
?>