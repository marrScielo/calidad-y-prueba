<?php

class ViewController
{
    public function getView($view)
    {
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo 'Error al cargar la vista';
            // redirect to 404 page
            exit;

        }
    }
}