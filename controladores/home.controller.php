<?php
// Incluye la conexión y el modelo de productos
include_once 'modelos/database.php';
include_once 'modelos/categorias.php';

class HomeController
{
    private $modelo;

    public function __construct($conn)
    {
        $this->modelo = new CategoriasProductos($conn);
    }

    public function index()
    {
        $categorias = $this->modelo->read();
        // require_once 'vistas/header.php';
        // //change css file
        // echo '<link rel="stylesheet" href="assets/css/index.css">';
        require_once 'vistas/home.php';
        require_once 'vistas/footer.php';
    }
}
