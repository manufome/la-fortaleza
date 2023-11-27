use tienda;
-- Tabla de ubicaciones
CREATE TABLE ubicaciones
  (
    id_ubicacion INT AUTO_INCREMENT PRIMARY KEY,
    direccion VARCHAR(255) NOT NULL,
    ciudad VARCHAR(50) NOT NULL
  );

-- Tabla de almacenes
CREATE TABLE almacenes
  (
    id_almacen INT AUTO_INCREMENT PRIMARY KEY,
    nombre_almacen VARCHAR(255),
    id_ubicacion INT, -- fk
    CONSTRAINT fk_almacenes_ubicaciones 
      FOREIGN KEY (id_ubicacion)
      REFERENCES ubicaciones(id_ubicacion) 
      ON DELETE CASCADE
  );

-- Tabla de empleados
CREATE TABLE empleados
  (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    fecha_contratacion DATE NOT NULL,
    id_jefe INT, -- fk
    titulo_puesto VARCHAR(255) NOT NULL,
    CONSTRAINT fk_empleados_jefe 
        FOREIGN KEY (id_jefe)
        REFERENCES empleados(id_empleado)
        ON DELETE CASCADE
  );

-- Tabla de categorías de productos
CREATE TABLE categorias_productos
  (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(255) NOT NULL
  );

-- Tabla de productos
CREATE TABLE productos
  (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(255) NOT NULL,
    descripcion VARCHAR(2000),
    precio_compra DECIMAL(9,2),
    precio_venta DECIMAL(9,2),
    id_categoria INT NOT NULL,
    CONSTRAINT fk_productos_categorias 
      FOREIGN KEY (id_categoria)
      REFERENCES categorias_productos(id_categoria) 
      ON DELETE CASCADE
  );

-- Tabla de clientes
CREATE TABLE clientes
  (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    correo VARCHAR(255) NOT NULL,
    limite_credito DECIMAL(8,2),
    contraseña VARCHAR(16) NOT NULL
  );

-- Tabla de órdenes
CREATE TABLE ordenes
  (
    id_orden INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL, -- fk
    estado VARCHAR(20) NOT NULL,
    id_vendedor INT, -- fk
    fecha_orden DATE NOT NULL,
    CONSTRAINT fk_ordenes_clientes 
      FOREIGN KEY (id_cliente)
      REFERENCES clientes(id_cliente)
      ON DELETE CASCADE,
    CONSTRAINT fk_ordenes_empleados 
      FOREIGN KEY (id_vendedor)
      REFERENCES empleados(id_empleado) 
      ON DELETE SET NULL
  );

-- Tabla de ítems de órdenes
CREATE TABLE items_ordenes
  (
    id_orden INT, -- fk
    id_item INT,
    id_producto INT NOT NULL, -- fk
    cantidad DECIMAL(8,2) NOT NULL,
    precio_unitario DECIMAL(8,2) NOT NULL,
    PRIMARY KEY (id_orden, id_item),
    CONSTRAINT fk_items_ordenes_productos 
      FOREIGN KEY (id_producto)
      REFERENCES productos(id_producto) 
      ON DELETE CASCADE,
    CONSTRAINT fk_items_ordenes_ordenes 
      FOREIGN KEY (id_orden)
      REFERENCES ordenes(id_orden) 
      ON DELETE CASCADE
  );

-- Inventario
CREATE TABLE inventarios
  (
    id_producto INT, -- fk
    id_almacen INT, -- fk
    cantidad INT NOT NULL,
    PRIMARY KEY (id_producto, id_almacen),
    CONSTRAINT fk_inventarios_productos 
      FOREIGN KEY (id_producto)
      REFERENCES productos(id_producto) 
      ON DELETE CASCADE,
    CONSTRAINT fk_inventarios_almacenes 
      FOREIGN KEY (id_almacen)
      REFERENCES almacenes(id_almacen) 
      ON DELETE CASCADE
  );
