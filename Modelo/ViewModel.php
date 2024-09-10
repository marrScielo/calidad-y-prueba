<?php
class ViewModel
{
    protected static function getPathView($view)
    {
        $whiteList = ['index', 'blog', 'psicologos', 'contactanos', 'login'];
        $viewPath = '';
        if (
            in_array($view, $whiteList) && file_exists(__DIR__ . '/../views/' . $view . 'View.php')

        ) {
            $viewPath = __DIR__ . '/../views/' . $view . 'View.php';
        } else {
            $viewPath = __DIR__ . '/../views/404.php';
        }
        return $viewPath;
    }
}