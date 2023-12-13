<?php
require_once 'modelos/database.php';
require_once 'modelos/orden.php';

class ComprasController
{
    private $modelo;

    public function __construct($conn)
    {
        $this->modelo = new Orden($conn);
    }

    public function verDetalle()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=login&action=index');
        }
        $id_orden = $_GET['id_orden'];
        $id_cliente = $_SESSION['user']['id_cliente'];
        $orden = $this->modelo->obtenerOrden($id_orden);
        $items = $this->modelo->obtenerDetallePedido($id_orden, $id_cliente);
        require_once 'vistas/header.php';
        require_once 'vistas/usuario/detalle_compra.php';
        require_once 'vistas/footer.php';
    }

    public function verRecibo()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=login&action=index');
        }
        $id_orden = $_GET['id_orden'];
        $id_cliente = $_SESSION['user']['id_cliente'];
        $lineas = $this->modelo->generarRecibo($id_orden);
        require_once 'vistas/usuario/recibo.php';
    }

}
