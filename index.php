<?php
// index.php

session_start();

require_once 'modelos/database.php';
require_once 'controladores/home.controller.php';
require_once 'controladores/productos.controller.php';

$conn = Database::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = isset($_POST['controller']) ? $_POST['controller'] : 'home';
    $action = isset($_POST['action']) ? $_POST['action'] : 'index';
} else {
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
}

// Forma el nombre completo del controlador
$controllerName = $controller . '.controller';
$className = ucwords($controller) . 'Controller';

// Incluye el archivo del controlador si existe
if (file_exists("controladores/$controllerName.php")) {
    require_once "controladores/$controllerName.php";

    // Instancia el controlador
    $controllerInstance = new $className($conn);

    // Llama a la acción correspondiente
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        // Acción no válida, manejar según sea necesario
        require_once 'vistas/errores/error500.php';
    }
} else {
    // Controlador no válido, manejar según sea necesario
    require_once 'vistas/errores/error404.php';
}
