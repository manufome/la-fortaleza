<?php
require_once 'modelos/producto.php';

class ProductController{
    private $model;
    
    public function __construct(){
        $this->model = new Product();
    }
    
    public function index(){
        $products = $this->model->getProducts();
        
        require_once 'vistas/header.php';
        require_once 'vistas/product.php';
        require_once 'vistas/footer.php';
    }
}
?>