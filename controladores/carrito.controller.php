<?php
require_once 'modelos/database.php';
require_once 'modelos/orden.php';

class CarritoController
{
    private $modelo;

    public function __construct($conn)
    {
        $this->modelo = new Orden($conn);
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

    public function compras()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=login&action=index');
        }
        $id_cliente = $_SESSION['user']['id_cliente'];
        $ordenes = $this->modelo->obtenerOrdenes($id_cliente);
        if (isset($_SESSION['carrito'])) {
            echo "<script>localStorage.setItem('carrito', JSON.stringify([]));</script>";
            unset($_SESSION['carrito']);
        }
        require_once 'vistas/header.php';
        require_once 'vistas/usuario/compras.php';
        require_once 'vistas/footer.php';
    }

    public function realizarPedido()
    {

        // Estados de ordenes:
        // creado - Pedido creado pero no verificado
        // pendiente - Pedido que requiere modificación en la cantidad de productos
        // enviado -  Pedido confirmado y enviado
        // entregado - Pedido recibido por el cliente
        // cancelado - Pedido cancelado por el cliente
        // 1. Crear pedido
        // 2. Verificar stock
        // 3. Crear detalle pedido
        // 4. Actualizar stock
        // 5. Actualizar estado pedido

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?controller=login&action=index');
        }
        $productos = $_POST['productos-pedido'];
        $productos = json_decode($productos);
        $metodo_pago = $_POST['metodo_pago'];
        if ($metodo_pago == 'tarjeta') {
            $numero_tarjeta = $_POST['numero_tarjeta'];
        }
        $id_usuario = $_SESSION['user']['id_usuario'];
        $id_cliente = $_SESSION['user']['id_cliente'];
        $sin_stock = array();
        if (isset($_POST['id_pedido'])) {
            $id_pedido = $_POST['id_pedido'];
        } else {
            $id_pedido = $this->modelo->crearOrden($id_cliente, $metodo_pago);
        }
        foreach ($productos as $producto) {
            $result = $this->modelo->verificarStock($producto->id, $producto->cantidad);
            if ($result['sin_stock']) {
                $sin_stock[] = (object) ['id' => $producto->id, 'nombre' => $producto->titulo, 'cantidad_en_stock' => $result['cantidad_en_stock']];
            } else {
                $this->modelo->crearDetallePedido($id_pedido, $producto->id, $producto->cantidad);
            }
        }
        if (count($sin_stock) > 0) {
            $this->modelo->actualizarEstadoPedido($id_pedido, 'pendiente');
            $message = 'No hay suficiente stock para los siguientes productos: ';
            foreach ($sin_stock as $producto) {
                $message .= $producto->nombre . ', ';
            }
            require_once 'vistas/header.php';
            require_once 'vistas/compra/checkout.php';
            require_once 'vistas/footer.php';
        } else {
            // clear cart from local storage
            $this->modelo->actualizarStock($id_pedido);
            $this->modelo->actualizarEstadoPedido($id_pedido, 'enviado');
            $_SESSION['carrito'] = 'vaciar';
            header('Location: index.php?controller=carrito&action=compras');
        }
    }
}
