<?php

require_once __DIR__ . '/../vendor/autoload.php';

use RedBeanPHP\R as R;

R::setup('mysql:host=localhost;dbname=binsta', 'root', 'root');
session_start();

$publicControllers = ['UserController'];

if (isset($_GET['params'])) {
    $params = explode('/', $_GET['params']);
    if ($params[0] === 'public') {
        $params = array_slice($params, 1);
    }
} else {
    $params = [];
}

if (count($params) === 0 || empty($params[0])) {
    if (isset($_SESSION['user'])) {
        header('Location: /post/index');
    } else {
        header('Location: /user/login');
    }
    exit;
}

$controllerName = ucfirst($params[0]) . 'Controller';
$method = $params[1] ?? 'index';

if (!in_array($controllerName, $publicControllers) && !isset($_SESSION['user'])) {
    header('Location: /user/login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $methodName = $method;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $methodName = $method . 'Post';
} else {
    error(405, 'Method not allowed');
    exit;
}

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        error(404, 'Function ' . $methodName . '() not found in ' . $controllerName);
    }
} else {
    error(404, 'Controller ' . $controllerName . ' not found');
}
