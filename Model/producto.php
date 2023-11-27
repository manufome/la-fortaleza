
<?php
require_once 'Model/database.php';

class Producto {
    private $conn;
    private $productos;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->productos = array();
    }

    public function create($nombre_producto, $precio_compra, $id_categoria, $descripcion) {
        $sql = "INSERT INTO productos (nombre_producto, precio_compra, id_categoria, descripcion) VALUES ('$nombre_producto', '$precio_compra', '$id_categoria', '$descripcion')";
        return $this->conn->query($sql);
    }

    public function read() {
        $query = $this->conn->query("SELECT p.*, c.nombre_categoria FROM productos p, categorias_productos c WHERE p.id_categoria = c.id_categoria;");
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $this->productos[] = $row;
        }
        return $this->productos;
    }

    public function update($id_producto, $nombre_producto, $precio_compra, $id_categoria, $descripcion) {
        $sql = "UPDATE productos SET nombre_producto='$nombre_producto', precio_compra='$precio_compra', id_categoria='$id_categoria', descripcion='$descripcion' WHERE id_producto=$id_producto";
        return $this->conn->query($sql);
    }

    public function delete($id_producto) {
        $sql = "DELETE FROM productos WHERE id_producto=$id_producto";
        return $this->conn->query($sql);
    }
}
?>