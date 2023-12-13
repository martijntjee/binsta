<?php

require_once __DIR__ . '/../vendor/autoload.php';

use RedBeanPHP\R as R;

R::setup('mysql:host=localhost;dbname=binsta', 'root', 'root');

session_start();

if (isset($_GET['params'])) {
    $params = explode('/', $_GET['params']);
    if ($params[0] == 'public') {
        $params = array_slice($params, 1);
    }
} else {
    $params = [];
}

if (count($params) > 1) {
    $method = $params[1];
    $controller = ucfirst($params[0]) . 'Controller';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $getMethod = $method;
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postMethod = $method . 'Post';
    } else {
        error(405, 'Method not allowed');
    }

    if (class_exists($controller)) {
        $controller = new $controller();
        if (isset($getMethod)) {
            if (method_exists($controller, $getMethod)) {
                $controller->$getMethod();
            } else {
                error(404, 'Function ' . $method . '() not found in ' . ucfirst($params[0]) . 'Controller');
            }
        } elseif (isset($postMethod)) {
            if (method_exists($controller, $postMethod)) {
                $controller->$postMethod();
            } else {
                error(404, 'Function ' . $method . '() not found in ' . ucfirst($params[0]) . 'Controller');
            }
        } else {
            error(404, 'Function ' . $method . '() not found in ' . ucfirst($params[0]) . 'Controller');
        }
    } else {
        error(404, 'Controller ' . $controller . ' not found');
    }
} elseif (count($params) == 1 && !empty($params[0])) {
    $controller = ucfirst($params[0]) . 'Controller';
    if (class_exists($controller)) {
        $controller = new $controller();
        $controller->index();
    } else {
        error(404, 'Controller ' . $controller . ' not found');
    }
} else {
    $controller = new RecipeController();
    $controller->index();
}
