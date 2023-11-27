<?php
require_once 'Model/producto.php';

class ProductosController{
    private $modeloProducto;
    private $modeloCategoria;
    
    public function __construct($conn){
        $this->modeloProducto = new Producto($conn);
        $this->modeloCategoria = new CategoriasProductos($conn);
    }
    
    public function index(){
        $productos = $this->modeloProducto->read();
        $categorias = $this->modeloCategoria->read();
        require_once 'View/header.php';
        require_once 'View/producto/productos.php';
        require_once 'View/footer.php';
    }
}
?>