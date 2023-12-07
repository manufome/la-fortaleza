<?php
require_once 'modelos/database.php';

class CarritoController
{
    private $modelo;

    public function __construct($conn)
    {
        $this->modelo = new Compra($conn);
    }

    public function checkout()
    {
        $productos = $_POST['productos'];
        require_once 'vistas/compra/checkout.php';
        require_once 'vistas/footer.php';
    }

    public function create()
    {
        $compras = $this->modelo->read();
        require_once 'vistas/compra.php';
        require_once 'vistas/footer.php';
    }

    public function store()
    {
        $compras = $this->modelo->read();
        require_once 'vistas/compra.php';
        require_once 'vistas/footer.php';
    }

    public function show()
    {
        $compras = $this->modelo->read();
        require_once 'vistas/compra.php';
        require_once 'vistas/footer.php';
    }

    public function edit()
    {
        $compras = $this->modelo->read();
        require_once 'vistas/compra.php';
        require_once 'vistas/footer.php';
    }

    public function update()
    {
        $compras = $this->modelo->read();
        require_once 'vistas/compra.php';
        require_once 'vistas/footer.php';
    }

    public function destroy()
    {
        $compras = $this->modelo->read();
        require_once 'vistas/compra.php';
        require_once 'vistas/footer.php';
    }
}
