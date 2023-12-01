<?php

class InfoUsuarioController{
    private $admin;

    public function __construct($conn){
        $this->admin = isset($_GET['admin']) ? true : false;
    }

    public function index(){
        require_once 'vistas/administrador/infoUsuario.php';
    }

}