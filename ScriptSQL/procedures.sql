DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_producto`(
    IN p_id INT,
    IN p_nombre VARCHAR(255),
    IN p_precio DECIMAL(10, 2),
    IN p_stock INT,
    IN p_almacen VARCHAR(255),
    IN p_direccion VARCHAR(255),
    IN p_categoria INT
)
BEGIN
    UPDATE productos p
    JOIN categorias_productos c ON p.id_categoria = c.id_categoria
    JOIN inventarios i ON p.id_producto = i.id_producto
    JOIN almacenes a ON i.id_almacen = a.id_almacen
    JOIN ubicaciones u ON a.id_ubicacion = u.id_ubicacion
    SET
        p.nombre_producto = p_nombre,
        p.precio_venta = p_precio,
        i.cantidad = p_stock,
        a.nombre_almacen = p_almacen,
        u.direccion = p_direccion,
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

END