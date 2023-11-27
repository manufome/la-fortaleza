<?php
// Operaciones CRUD para la tabla ubicaciones
class Location {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($direccion, $ciudad) {
        $sql = "INSERT INTO ubicaciones (direccion, ciudad) VALUES ('$direccion', '$ciudad')";
        return $this->conn->query($sql);
    }

    public function read() {
        $sql = "SELECT * FROM ubicaciones";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id_ubicacion, $direccion, $ciudad) {
        $sql = "UPDATE ubicaciones SET direccion='$direccion', ciudad='$ciudad' WHERE id_ubicacion=$id_ubicacion";
        return $this->conn->query($sql);
    }

    public function delete($id_ubicacion) {
        $sql = "DELETE FROM ubicaciones WHERE id_ubicacion=$id_ubicacion";
        return $this->conn->query($sql);
    }
}
?>