<?php
require_once 'DatabaseController.php';
require_once '../Modelo/BlogModel.php';

class BlogController{
    private $blogModel;

    public function __construct() {
        $db = new DatabaseController();
        $this->blogModel = new Blog($db);
    }

    public function show(){
        $blogs = $this->blogModel->getAllBlog();
        include 'Blog.php';
    }
}