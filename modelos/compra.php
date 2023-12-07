<?php
class Compra
{
    private $conn;
    private $compras;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->compras = array();
    }

    // Create
    public function create($id_usuario, $id_producto, $cantidad, $precio)
    {
        $procedure = "CALL sp_agregar_compra($id_usuario, $id_producto, $cantidad, $precio);";
        $this->conn->query($procedure);
    }

    // Read
    public function read()
    {
        $query = "SELECT * FROM compras;";
        $compras = $this->conn->query($query);
        while ($row = $compras->fetch(PDO::FETCH_ASSOC)) {
            $this->compras[] = $row;
        }
        return $this->compras;
    }

    // Update
    public function update($id, $id_usuario, $id_producto, $cantidad, $precio)
    {
        try {
            $this->conn->beginTransaction();
            $procedure = "CALL sp_actualizar_compra($id, $id_usuario, $id_producto, $cantidad, $precio);";
            $this->conn->query($procedure);
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    // Delete
    public function delete($id)
    {
        try {
            $this->conn->beginTransaction();
            $procedure = "CALL sp_eliminar_compra($id);";
            $this->conn->query($procedure);
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
}
