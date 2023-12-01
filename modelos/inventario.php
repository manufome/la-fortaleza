<?php

class Inventario{
    private $conn;
    private $inventario;

    public function __construct($db){
        $this->conn = $db;
        $this->inventario = array();
    }

    // Create
    function readProductos(){
        $query = "SELECT p.id_producto, p.nombre_producto, c.nombre_categoria, p.precio_venta, i.cantidad as stock, a.nombre_almacen, u.direccion 
        FROM productos p, categorias_productos c, inventarios i, almacenes a, ubicaciones u
        WHERE p.id_categoria = c.id_categoria and p.id_producto = i.id_producto
        and i.id_almacen = a.id_almacen=i.id_almacen and a.id_ubicacion = u.id_ubicacion;";
        $productos = $this->conn->query($query);
        while($row = $productos->fetch(PDO::FETCH_ASSOC)){
            $this->inventario[] = $row;
        }
        return $this->inventario;
    }

    function readProducto($id){
        $query = "SELECT p.id_producto, p.nombre_producto, c.nombre_categoria, p.precio_venta, i.cantidad as stock, a.nombre_almacen, u.direccion 
        FROM productos p, categorias_productos c, inventarios i, almacenes a, ubicaciones u
        WHERE p.id_categoria = c.id_categoria and p.id_producto = i.id_producto
        and i.id_almacen = a.id_almacen=i.id_almacen and a.id_ubicacion = u.id_ubicacion
        and p.id_producto = $id;";
        $productos = $this->conn->query($query);
        $row = $productos->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    function create($nombre, $descripcion, $precio_c, $precio_v, $stock, $almacen, $categoria){
        $procedure = "CALL sp_agregar_producto('$nombre', '$descripcion', $precio_c, $precio_v, $stock, '$almacen', $categoria);";
        $this->conn->query($procedure);
    }

    function update($id, $nombre, $precio, $stock, $almacen, $direccion, $categoria){
        try {
            $this->conn->beginTransaction();
            $procedure = "CALL sp_actualizar_producto($id, '$nombre', $precio, $stock, '$almacen', '$direccion', $categoria);";
            $this->conn->query($procedure);
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    function delete($id){
        try {
            $this->conn->beginTransaction();
            $procedure = "CALL sp_eliminar_producto($id);";
            $this->conn->query($procedure);
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
}