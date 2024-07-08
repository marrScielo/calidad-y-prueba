<?php

require_once 'DatabaseController.php';
require_once './Modelo/BlogModel.php';

class BlogController {
    private $blogModel;

    public function __construct($db) {
        $this->blogModel = new Blog($db);
    }

    public function show($limit, $offset) {
        return $this->blogModel->getAllBlog($limit, $offset);
    }

    public function getTotalBlogs() {
        return $this->blogModel->getTotalBlogs();
    }

    public function crearBlog($tema, $especialidad, $descripcion, $imagen) {
        return $this->blogModel->createBlogs($tema, $especialidad, $descripcion, $imagen);
    }
}
