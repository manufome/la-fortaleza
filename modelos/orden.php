<?php
class Orden
{
    private $conn;
    private $ordenes;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->ordenes = array();
    }

    // Create
    public function crearOrden($id_cliente, $metodo_pago)
    {
        try {
            $this->conn->beginTransaction();
            $query = "INSERT INTO ordenes (id_cliente, fecha_orden, metodo_pago) VALUES ($id_cliente, NOW(), '$metodo_pago');";
            $this->conn->query($query);
            $id_pedido = $this->conn->lastInsertId();
            $this->conn->commit();
            return $id_pedido;
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    public function verificarStock($id_producto, $cantidad)
    {
        try {
            $this->conn->beginTransaction();

            // Llamada al procedimiento almacenado
            $query = "CALL sp_verificar_stock(:id_producto, :cantidad, @sin_stock, @cantidad_en_stock)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->execute();

            // Obtener los resultados del procedimiento almacenado
            $result = $this->conn->query("SELECT @sin_stock AS sin_stock, @cantidad_en_stock AS cantidad_en_stock")->fetch(PDO::FETCH_ASSOC);
            $sin_stock = $result['sin_stock'];
            $cantidad_en_stock = $result['cantidad_en_stock'];

            $this->conn->commit();

            return ['sin_stock' => $sin_stock, 'cantidad_en_stock' => $cantidad_en_stock];
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
    // verificar que no se repita el producto en el pedido
    public function crearDetallePedido($id_pedido, $id_producto, $cantidad)
    {
        try {
            $this->conn->beginTransaction();
            $procedure = "CALL sp_crear_detalle_pedido($id_pedido, $id_producto, $cantidad);";
            $this->conn->query($procedure);
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    public function actualizarStock($id_pedido)
    {
        try {
            $this->conn->beginTransaction();
            $procedure = "CALL sp_actualizar_stock($id_pedido);";
            $this->conn->query($procedure);
            $this->conn->commit();
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    public function generarRecibo($id_pedido)
    {
        try {
            $procedure = "CALL sp_generar_recibo($id_pedido);";
            $result = $this->conn->query($procedure);
            // trae un solo registro con varios campos llamados linea, se debe separar por <br>
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }

    }

    public function actualizarEstadoPedido($id_pedido, $estado)
    {
        try {
            $this->conn->beginTransaction();
            $query = "UPDATE ordenes SET estado = '$estado' WHERE id_orden = $id_pedido;";
            $this->conn->query($query);
            $this->conn->commit();
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }

    }

    public function cancelarPedido($id_pedido)
    {
        try {
            $this->conn->beginTransaction();
            $procedure = "CALL sp_cancelar_pedido($id_pedido);";
            $this->conn->query($procedure);
            $this->conn->commit();
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo "Failed: " . $e->getMessage();
        }

    }

    // Read
    public function obtenerOrdenes($id_cliente)
    {
        try {
            $query = "SELECT
                        o.*,
                        CASE
                            WHEN SUM(oi.cantidad * oi.precio_unitario) < 50000 THEN SUM(oi.cantidad * oi.precio_unitario) + 5000
                            ELSE SUM(oi.cantidad * oi.precio_unitario)
                        END AS total
                    FROM
                        ordenes o
                    JOIN
                        orden_items oi ON o.id_orden = oi.id_orden
                    WHERE
                        o.id_cliente = $id_cliente
                    GROUP BY
                        o.id_orden;";
            $result = $this->conn->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $this->ordenes[] = $row;
            }
            return $this->ordenes;
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }

    }

    public function obtenerOrden($id_pedido)
    {
        try {
            $query = "SELECT
                        o.*,
                        CASE
                            WHEN SUM(oi.cantidad * oi.precio_unitario) < 50000 THEN SUM(oi.cantidad * oi.precio_unitario) + 5000
                            ELSE SUM(oi.cantidad * oi.precio_unitario)
                        END AS total,
                        CASE
                            WHEN SUM(oi.cantidad * oi.precio_unitario) < 50000 THEN 5000
                            ELSE 0
                        END AS envio
                    FROM
                        ordenes o
                    JOIN
                        orden_items oi ON o.id_orden = oi.id_orden
                    WHERE
                        o.id_orden = $id_pedido;";
            $result = $this->conn->query($query);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    public function obtenerDetallePedido($id_pedido, $id_cliente)
    {
        try {
            $query = "SELECT
                        o.id_orden,
                        oi.id_item,
                        p.nombre_producto AS nombre_producto,
                        oi.cantidad,
                        oi.precio_unitario,
                        oi.cantidad * oi.precio_unitario AS subtotal
                    FROM
                        ordenes o
                    JOIN
                        orden_items oi ON o.id_orden = oi.id_orden
                    JOIN
                        productos p ON oi.id_producto = p.id_producto
                    WHERE
                        o.id_cliente = $id_cliente and o.id_orden=$id_pedido
                    GROUP BY
                        o.id_orden, oi.id_item;";
            $result = $this->conn->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $this->items[] = $row;
            }
            return $this->items;
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }

    }
}
