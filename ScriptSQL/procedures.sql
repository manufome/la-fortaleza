DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_producto`(
    IN p_id INT,
    IN p_nombre VARCHAR(255),
    IN p_precio DECIMAL(10, 2),
    IN p_stock INT,
    IN p_alerta INT,
    IN p_categoria INT
)
BEGIN
    UPDATE productos p
    JOIN categorias_productos c ON p.id_categoria = c.id_categoria
    JOIN inventarios i ON p.id_producto = i.id_producto
    SET
        p.nombre_producto = p_nombre,
        p.precio_venta = p_precio,
        i.cantidad = p_stock,
        i.alerta = p_alerta,
        p.id_categoria = p_categoria
    WHERE p.id_producto = p_id;
END ;;
DELIMITER ;

DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agregar_producto`(
    IN p_nombre_producto VARCHAR(255),
    IN p_descripcion VARCHAR(255),
    IN p_precio_compra DECIMAL(10, 2),
    IN p_precio_venta DECIMAL(10, 2),
    IN p_stock INT,
    IN p_almacen int,
    IN p_categoria INT
)
BEGIN
    DECLARE v_id_producto INT;

    -- Insertar en la tabla de productos
    INSERT INTO productos (nombre_producto, descripcion, precio_compra, precio_venta, id_categoria)
    VALUES (p_nombre_producto, p_descripcion, p_precio_compra, p_precio_venta, p_categoria);

    -- Obtener el ID del producto recién insertado
    SET v_id_producto = LAST_INSERT_ID();

    -- Insertar en la tabla de inventarios
    INSERT INTO inventarios (id_producto, id_almacen, cantidad)
    VALUES (v_id_producto, p_almacen, p_stock);
END ;;
DELIMITER ;


DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_producto`(IN p_id_producto INT)
BEGIN
    DECLARE v_producto_existente INT;

    -- Verificar si el producto existe antes de proceder
    SELECT COUNT(*) INTO v_producto_existente FROM productos WHERE id_producto = p_id_producto;

    IF v_producto_existente > 0 THEN
        -- Eliminar registro del inventario
        DELETE FROM inventarios WHERE id_producto = p_id_producto;

        -- Eliminar el producto
        DELETE FROM productos WHERE id_producto = p_id_producto;

        SELECT 'Producto eliminado correctamente.' AS mensaje;
    ELSE
        SELECT 'Error: Producto no encontrado.' AS mensaje;
    END IF;
END ;;
DELIMITER ;


DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_cliente`(
    IN p_nombre VARCHAR(255),
    IN p_username VARCHAR(255),
    IN p_correo VARCHAR(255),
    IN p_direccion VARCHAR(255),
    IN p_contrasena VARCHAR(255)
)
BEGIN
    DECLARE v_id_cliente INT;
    DECLARE v_id_usuario INT;
	
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Si ocurre una excepción, realiza un rollback
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error: No se pudo completar la operación.';
    END;
    
    START TRANSACTION;
    -- Insertar en la tabla clientes
    INSERT INTO clientes (nombre, correo, direccion)
    VALUES (p_nombre, p_correo, p_direccion);

    -- Obtener el ID del cliente recién insertado
    SET v_id_cliente = LAST_INSERT_ID();

    -- Insertar en la tabla usuarios
    INSERT INTO usuarios (nombre_usuario, contraseña, rol, id_cliente)
    VALUES (p_username, p_contrasena, 'cliente', v_id_cliente);

	COMMIT;

END ;;
DELIMITER ;


-- verificar stock
DELIMITER ;;

CREATE PROCEDURE sp_verificar_stock(
    IN p_id_producto INT, 
    IN p_cantidad INT, 
    OUT p_sin_stock BOOLEAN,
    OUT p_cantidad_en_stock INT
)
BEGIN
    DECLARE total_stock INT;

    -- Calcular el total de stock para el producto en todos los almacenes
    SELECT SUM(cantidad) INTO total_stock
    FROM inventarios
    WHERE id_producto = p_id_producto;

    -- Verificar si hay suficiente stock
    IF total_stock >= p_cantidad THEN
        SET p_sin_stock = FALSE;
        SET p_cantidad_en_stock = total_stock; -- Devolver la cantidad en stock
    ELSE
        SET p_sin_stock = TRUE;
        SET p_cantidad_en_stock = total_stock; -- Devolver la cantidad en stock actual
    END IF;
END //

DELIMITER ;


-- Crear detalle de pedido
DELIMITER ;;

CREATE PROCEDURE sp_crear_detalle_pedido(
    IN p_id_pedido INT,
    IN p_id_producto INT,
    IN p_cantidad DECIMAL(8,2)
)
BEGIN
    DECLARE producto_existente INT;
    DECLARE next_id_item INT;

    -- Calcular el próximo id_item para la orden actual
    SELECT COALESCE(MAX(id_item), 0) + 1 INTO next_id_item
    FROM orden_items
    WHERE id_orden = p_id_pedido;

    -- Verificar si el producto ya existe en la orden
    SELECT COUNT(*) INTO producto_existente
    FROM orden_items
    WHERE id_orden = p_id_pedido AND id_producto = p_id_producto;

    -- Si el producto no existe en la orden, proceder con la creación del detalle del pedido
    IF producto_existente = 0 THEN
        INSERT INTO orden_items (id_orden, id_item, id_producto, cantidad, precio_unitario)
        VALUES (p_id_pedido, next_id_item, p_id_producto, p_cantidad, (SELECT precio_venta FROM productos WHERE id_producto = p_id_producto));

        SELECT 'Detalle del pedido creado exitosamente.' AS mensaje;
    ELSE
        SELECT 'El producto ya existe en la orden.' AS mensaje;
    END IF;
END //


DELIMITER ;




DELIMITER ;;

CREATE PROCEDURE sp_actualizar_stock(IN p_id_pedido INT)
BEGIN
    DECLARE producto_id INT;
    DECLARE cantidad DECIMAL(8,2);
    DECLARE cantidad_restante DECIMAL(8,2);
    DECLARE done INT DEFAULT FALSE;

    -- Cursor para recorrer los productos de la orden
    DECLARE cur_producto CURSOR FOR
        SELECT oi.id_producto, oi.cantidad
        FROM orden_items oi
        WHERE oi.id_orden = p_id_pedido;

    -- Declaraciones para manejar errores
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Iniciar el cursor
    OPEN cur_producto;

    -- Iniciar la transacción
    START TRANSACTION;

    -- Loop para recorrer los productos de la orden
    product_loop: LOOP
        FETCH cur_producto INTO producto_id, cantidad;

        -- Salir del bucle si no hay más productos
        IF done THEN
            LEAVE product_loop;
        END IF;

        -- Actualizar el stock en la tabla de inventarios
        UPDATE inventarios inv
        SET inv.cantidad = inv.cantidad - cantidad
        WHERE inv.id_producto = producto_id AND inv.cantidad >= cantidad;

        -- Si no se pudo completar la cantidad en el almacén actual, buscar en otros almacenes
        WHILE ROW_COUNT() = 0 DO
            -- Obtener la cantidad restante que se necesita del producto
            SET cantidad_restante = cantidad - (SELECT inv.cantidad FROM inventarios inv WHERE inv.id_producto = producto_id AND inv.cantidad > 0 LIMIT 1);

            -- Buscar en otros almacenes
            UPDATE inventarios inv
            SET inv.cantidad = inv.cantidad - cantidad_restante
            WHERE inv.id_producto = producto_id AND inv.cantidad >= cantidad_restante;

            -- Actualizar el stock en el almacén actual
            UPDATE inventarios inv
            SET inv.cantidad = inv.cantidad - (cantidad - cantidad_restante)
            WHERE inv.id_producto = producto_id AND inv.cantidad >= (cantidad - cantidad_restante);
        END WHILE;
    END LOOP;

    -- Cerrar el cursor
    CLOSE cur_producto;

    -- Confirmar la transacción
    COMMIT;
END //

DELIMITER ;




DELIMITER //

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_generar_recibo`(IN p_idOrden INT)
BEGIN
    DECLARE totalOrden DECIMAL(8,2);
    DECLARE totalAjustado DECIMAL(8,2);
    DECLARE envio DECIMAL(8,2);

    -- Obtener el total de la orden y calcular el total ajustado
    SELECT
        SUM(oi.cantidad * oi.precio_unitario),
        CASE
            WHEN SUM(oi.cantidad * oi.precio_unitario) < 50000 THEN SUM(oi.cantidad * oi.precio_unitario) + 5000
            ELSE SUM(oi.cantidad * oi.precio_unitario)
        END,
		CASE
            WHEN SUM(oi.cantidad * oi.precio_unitario) < 50000 THEN 5000
            ELSE 0
        END
    INTO totalOrden, totalAjustado, envio
    FROM orden_items oi
    WHERE oi.id_orden = p_idOrden;

    -- Imprimir la factura de texto
    SELECT
        '----------------------------------------' AS linea,
        '            Recibo de Compra            ' AS linea,
        '----------------------------------------' AS linea,
        CONCAT('Fecha: ', CURDATE()) AS linea,
        CONCAT('ID Orden: ', p_idOrden) AS linea,
        '----------------------------------------' AS linea,
        'Descripción             Cantidad   Precio' AS linea,
        '----------------------------------------' AS linea,
        GROUP_CONCAT(
            CONCAT(
                p.nombre_producto,
                REPEAT(' ', 25 - LENGTH(p.nombre_producto)),
                oi.cantidad,
                REPEAT(' ', 10 - LENGTH(oi.cantidad)),
                oi.precio_unitario,
                REPEAT(' ', 10 - LENGTH(oi.precio_unitario))
            ) SEPARATOR '\n'
        ) AS lineas,
        '----------------------------------------' AS linea,
        CONCAT('Subtotal: $', totalOrden) AS linea,
        CONCAT('Envío: $', envio) AS linea,
        CONCAT('Total: $', totalAjustado) AS linea,
        '----------------------------------------' AS linea
    FROM orden_items oi
    JOIN productos p ON oi.id_producto = p.id_producto
    WHERE oi.id_orden = p_idOrden
    GROUP BY p_idOrden;

END

DELIMITER ;
