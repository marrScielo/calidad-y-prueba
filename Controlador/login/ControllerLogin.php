<!-- <?php 
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
?> -->

<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["usu"]) && isset($_POST["pass"])) {
    require_once("/home3/ghxumdmy/public_html/website_1cf5dd5d/Modelo/login/ModelLogin.php");

    $validar = new Login();
    $validar->validarDatos($_POST["usu"], $_POST["pass"]);
} else {
    if (!headers_sent()) {
        header("location:../index.php");
        exit();
    } else {
        echo 'Headers already sent. Cannot redirect.';
        return;
    }
}
ob_end_flush();
?>