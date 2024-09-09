<?php
require_once __DIR__ . '/../Modelo/ViewModel.php';

class ViewController extends ViewModel
{
    public function getTemplate()
    {
        return require_once __DIR__ . '/../views/template.php';
    }
    public function getView()
    {
        if (isset($_GET["view"])) {
            $route = explode("/", $_GET["view"]);
            $view = ViewModel::getPathView($route[0]);
        } else {
            $view = "index";
        }
        return $view;
    }
}