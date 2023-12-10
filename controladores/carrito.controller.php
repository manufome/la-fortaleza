<?php
require_once 'modelos/database.php';
require_once 'modelos/compra.php';

class CarritoController
{
    private $modelo;

    public function __construct($conn)
    {
        $this->modelo = new Compra($conn);
    }

    public function checkout()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=login&action=index');
        }
        require_once 'vistas/header.php';
        require_once 'vistas/compra/checkout.php';
        require_once 'vistas/footer.php';
    }

    public function realizarPedido()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=login&action=index');
        }
        $productos = $_POST['productos'];
        $productos = json_decode($productos);
        $metodo_pago = $_POST['metodo_pago'];
        $numero_tarjeta = $_POST['numero_tarjeta'];
        $id_usuario = $_SESSION['user']->id_usuario;
        // $id_pedido = $this->modelo->crearPedido($id_usuario, $productos, $metodo_pago, $numero_tarjeta);
        foreach ($productos as $producto) {
            $this->modelo->crearDetallePedido($id_pedido, $producto->id, $producto->cantidad);
        }
        echo '<script>alert("Pedido realizado con éxito")</script>';
        echo '<script>localStorage.removeItem("carrito");</script>';
        //wait 5 seconds and redirect to index.php
        header('refresh:1;url=index.php?controller=productos&action=index');
    }

    public function pedidoRealizado()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=login&action=index');
        }
        require_once 'vistas/header.php';
        require_once 'vistas/compra/pedido_realizado.php';
        require_once 'vistas/footer.php';
    }
}
