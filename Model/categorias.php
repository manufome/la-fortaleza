<?php
require_once 'Model/database.php';
class CategoriasProductos {
    private $conn;
    private $categorias;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->categorias = array();
    }

    public function create($nombre_categoria) {
        $sql = "INSERT INTO categorias_productos (nombre_categoria) VALUES ('$nombre_categoria')";
        return $this->conn->query($sql);
    }

    public function read() {
        $query = $this->conn->query("SELECT * FROM categorias_productos");
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $this->categorias[] = $row;
        }
        return $this->categorias;
    }

    public function update($id_categoria, $nombre_categoria) {
        $sql = "UPDATE categorias_productos SET nombre_categoria='$nombre_categoria' WHERE category_id=$id_categoria";
        return $this->conn->query($sql);
    }

    public function delete($id_categoria) {
        $sql = "DELETE FROM categorias_productos WHERE category_id=$id_categoria";
        return $this->conn->query($sql);
    }
}
?>
