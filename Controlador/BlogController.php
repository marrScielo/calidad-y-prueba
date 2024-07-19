<?php

require_once 'DatabaseController.php';
require_once './Modelo/BlogModel.php';

class BlogController {
    private $blogModel;

    public function __construct($db) {
        $this->blogModel = new Blog($db);
    }

    public function show($limit, $offset, $especialidades = []) {
        return $this->blogModel->getAllBlog($limit, $offset, $especialidades);
    }

    public function getTotalBlogs($especialidades = []) {
        return $this->blogModel->getTotalBlogs($especialidades);
    }

    public function crearBlog($tema, $especialidad, $descripcion, $imagen) {
        return $this->blogModel->createBlogs($tema, $especialidad, $descripcion, $imagen);
    }
}
