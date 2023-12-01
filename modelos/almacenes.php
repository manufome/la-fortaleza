<?php
class Almacenes {
    private $conn;
    private $almacenes;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->almacenes = array();
    }

    public function read() {
        $query = $this->conn->query("SELECT * FROM almacenes");
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $this->almacenes[] = $row;
        }
        return $this->almacenes;
    }
}