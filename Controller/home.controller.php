<?php
// Incluye la conexión y el modelo de productos
include_once 'Model/database.php';
include_once 'Model/categorias.php';

class HomeController{
    private $modelo;
    
    public function __construct($conn){
        $this->modelo = new CategoriasProductos($conn);
    }
    
    public function index(){
        $categorias = $this->modelo->read();
        require_once 'View/home.php';
        require_once 'View/footer.php';
    }
}
