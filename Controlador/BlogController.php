<?php

require_once 'DatabaseController.php';
require_once './Modelo/BlogModel.php';

//require_once("/home3/ghxumdmy/public_html/website_ddbea1df/Modelo/BlogModel.php");

class BlogController{
    private $blogModel;

    public function __construct($db) {
        $this->blogModel = new Blog($db);
    }

    public function show(){
        return $this->blogModel->getAllBlog();
    }

    public function crearBlog($tema, $especialidad, $descripcion, $imagen) {
        return $this->blogModel->createBlogs($tema, $especialidad, $descripcion, $imagen);
    }
}