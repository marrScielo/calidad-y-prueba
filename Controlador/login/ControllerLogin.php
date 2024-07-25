<?php 
    if (isset($_POST["usu"]) && isset($_POST["pass"])) {
       
        //local
        include_once '../../Modelo/login/ModelLogin.php';

        //hosting
        //require_once("/home3/ghxumdmy/public_html/website_1cf5dd5d/Modelo/login/ModelLogin.php");

        $validar = new Login();
        $validar->validarDatos($_POST["usu"], $_POST["pass"]);
    } else {
        header("location:../index.php");
    }
?>