<?php
require_once 'modelos/inventario.php';
require_once 'modelos/categorias.php';
require_once 'modelos/almacenes.php';

class InventarioController
{
    private $conn;
    private $inventario;

    public function __CONSTRUCT($conn)
    {
        $this->conn = $conn;
        $this->inventario = new Inventario($this->conn);
    }

    public function index()
    {
        $productos = $this->inventario->readProductos();
        require_once 'vistas/administrador/inventarios.php';
    }

    public function indexCategoria()
    {
        $categoriasModel = new CategoriasProductos($this->conn);
        $categorias = $categoriasModel->read();
        require_once 'vistas/administrador/categorias/categorias.php';
    }

    public function editar()
    {
        $id = $_GET['id'];
        $categoriasModel = new CategoriasProductos($this->conn);
        $producto = $this->inventario->readProducto($id);
        $categorias = $categoriasModel->read();
        require_once 'vistas/administrador/productos/producto_editar.php';
    }

    public function actualizar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $alerta = $_POST['alerta'];
        $categoria = $_POST['categorias'];
        try {
            $this->inventario->update($id, $nombre, $precio, $stock, $alerta, $categoria);
            header('Location: index.php?controller=inventario&action=index');
        } catch (Exception $e) {
            echo $e->getMessage();
            var_dump($e);
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        require_once 'vistas/administrador/productos/producto_eliminar.php';
    }
    public function confirmarEliminar()
    {
        $id = $_POST['id'];
        $this->inventario->delete($id);
        header('Location: index.php?controller=inventario&action=index');
    }
    public function agregar()
    {
        $categoriasModel = new CategoriasProductos($this->conn);
        $almacenesModel = new Almacenes($this->conn);
        $categorias = $categoriasModel->read();
        $almacenes = $almacenesModel->read();
        require_once 'vistas/administrador/productos/producto_agregar.php';
    }

    public function insertar()
    {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio_c = $_POST['precio_compra'];
        $precio_v = $_POST['precio_venta'];
        $stock = $_POST['stock'];
        $almacen = $_POST['almacen'];
        $categoria = $_POST['categorias'];
        $this->inventario->create($nombre, $descripcion, $precio_c, $precio_v, $stock, $almacen, $categoria);
        header('Location: index.php?controller=inventario&action=index');
    }

}
