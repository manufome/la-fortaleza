<?php
require_once 'Model/producto.php';

class ProductController{
    private $model;
    
    public function __construct(){
        $this->model = new Product();
    }
    
    public function index(){
        $products = $this->model->getProducts();
        
        require_once 'View/header.php';
        require_once 'View/product.php';
        require_once 'View/footer.php';
    }
}
?>