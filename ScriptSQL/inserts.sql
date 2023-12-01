INSERT INTO categorias_productos (nombre_categoria) 
VALUES 
('Arepas'),
('Caldos, Sopas y Bases'),
('Carnes Frias'),
('Cereales'), 
('Condimentos'),
('Dulcería'),
('Enlatados y envasados'),
('Galletería'),
('Granos, Azúcar y Panela'),
('Harinas y Pre-mezclas'), 
('Huevos'),
('Margarinas y Aceites'),
('Panaderia y Reposteria'),
('Pasabocas y Snacks'),
('Pasta'),
('Platos preparados'),
('Postres listos'),
('Salsas y Aderezos'),
('Verduras y Frutas');


-- Arepas
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES  
('AREPA DE YUCA MASMAÍ 4 UND - 240 G', 4190, 1),
('AREPA EXTRAQUESO MASMAÍ 4 UND - 720 G', 5350, 1), 
('AREPA DE CHÓCOLO 5 UND MASMAÍ 400 GRS', 2990, 1),
('AREPA CON QUESO MOZZARELLA MASMAI 400 GRS', 4290, 1),
('AREPA DE MAÍZ BLANCO CON AVENA Y CHÍA MASMAÍ 5', 3990, 1);

-- Caldos, Sopas y Bases
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES
('CALDO DE COSTILLA MAGGI 10 UND 80 G', 4290, 2),
('CALDO DE GALLINA MAGGI 10 UND 88 G', 4290, 2), 
('CALDO DE GALLINA SPECIARIA 8 UND - 84 G', 1990, 2),
('CREMA DE CHÓCLO VELSUP 70 G', 1390, 2), 
('CALDO DE COSTILLA SPECIARIA 84 G 8 CUBOS', 1990, 2);

-- Carnes Frias  
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)  
VALUES
('SALCHICHA RANCHERA X 131 G X 4 UD', 5290, 3), 
('JAMON PIETRAN ESTANDAR 167 GRS', 6790, 3),  
('COMBO TRADICIONAL VIANDE 900 GR', 9890, 3),
('MORCILLA VIANDÉ 500 GRS', 6700, 3),
('JAMÓN DE POLLO PREMIUM BRAKEL 250 G', 5990, 3);

-- Cereales
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES  
('CHOCO KRISPIS KELLOGG¿S 200 G', 6450, 4),
('ZUCARITAS KELLOGG¿S 200 G', 6590, 4),
('CEREAL FLIPS CHOCOLATE 400 G', 12790, 4), 
('FROOT LOOPS KELLOGG°S 160 G', 6190, 4),
('CEREAL ORIGINAL FITNESS 230 G', 8990, 4);

-- Condimentos  
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES 
('SAL REFISAL 1000 G', 2190, 5),  
('MEZCLA CONDIMENTOS SAZONAREY 35 G', 1090, 5), 
('PASTA DE PIMENTÓN DELIKA 110 G', 1990, 5),
('MEZCLA PARA ADOBAR DELIKA 110 G', 1990, 5),
('PASTA DE AJO DELIKA 110 G', 1990, 5);

-- Dulcería
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES
('TIRUDITO SUPERCOCO (8g) 15U', 3690, 6), 
('GALLETA WAFER COCOSETTE 50 G', 1590, 6),
('BOM BOM BUM FRESA PQ 6', 2450, 6),
('CHOCOLATE KITKAT CHUNKY 40 GRS', 2690, 6), 
('HALLS LIMON Y MIEL 9S', 1490, 6);

-- Enlatados y envasados 
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES  
('TOMATES ENTEROS PELADOS DELIZIARE 400 G', 4490, 7),
('FRÍJOLES CON TOCINO COOLTIVO 300 GRS', 4990, 7),  
('ATÚN RALLADO EL NAVÍO 170 G', 3250, 7),
('ENSALADA CAMPESINA COOLTIVO 300 G', 3690, 7),
('SALMÓN EN ACEITE CARLO FORTE 170 G', 10490, 7);

-- Galletería 
INSERT INTO productos (nombre_producto, precio_venta, id_categoria) 
VALUES
('ALLETA 2 TACOS DUCALES NOEL 241 GRS', 4990, 8),  
('GALLETAS VAINILLA 18UN WAFER NOEL 432 GR', 7290, 8),
('GALLETAS SANDWICH QUESO DUX', 5890, 8), 
('GALLETA INTEGRAL CLUB SOCIAL 6 UND', 3990, 8),
('GALLETA HAPPY BLACK 12 PQ 408G', 6890, 8);

-- Granos, Azúcar y Panela
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)  
VALUES
('PANELA PULVERIZADA EL REFUGIO 500 G', 3290, 9),  
('ARROZ DIANA 1000 G', 4250, 9),  
('ARROZ INTEGRAL DIANA 1.000 G', 3990, 9),
('AZÚCAR BLANCA 1000 GRS', 4790, 9), 
('ENDULZANTE CON STEVIA NATRI 180 G', 6150, 9);
 
-- Harinas y Pre-mezclas
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)  
VALUES 
('HARINA DE TRIGO CON POLVO PARA HORNEAR', 2190, 10),
('GRANO ENTERO DE QUINUA', 4490, 10),
('PREMEZCLA PARA PANCAKES QUICKSY 300 G', 3150, 10),  
('HARINA DE TRIGO QUICKSY 500 G', 1890, 10),
('PREMEZCLA DE GALLETAS CON CHIPS DE CHOCOLATE QU', 4690, 10);

-- Inserts para la tabla de ubicaciones
INSERT INTO ubicaciones (direccion, ciudad) VALUES
  ('Calle 123', 'Ciudad A'),
  ('Avenida Principal', 'Ciudad B'),
  ('Calle Central', 'Ciudad C');

-- Inserts para la tabla de almacenes
INSERT INTO almacenes (nombre_almacen, id_ubicacion) VALUES
  ('Almacén 1', 1),
  ('Almacén 2', 2),
  ('Almacén 3', 3);

-- Inserts para la tabla de empleados
INSERT INTO empleados (nombre, apellido, correo, telefono, fecha_contratacion, id_jefe, titulo_puesto) VALUES
  ('Juan', 'Gomez', 'juan.gomez@email.com', '123-456-7890', '2023-01-01', NULL, 'Gerente'),
  ('Ana', 'Martinez', 'ana.martinez@email.com', '987-654-3210', '2023-02-15', 1, 'Supervisor'),
  ('Carlos', 'Lopez', 'carlos.lopez@email.com', '555-555-5555', '2023-03-20', 2, 'Asistente');

-- Inserts para la tabla de clientes
INSERT INTO clientes (nombre, direccion, sitio_web, limite_credito) VALUES
  ('Cliente A', 'Calle Principal 456', 'www.clientea.com', 5000.00),
  ('Cliente B', 'Avenida Central 789', 'www.clienteb.com', 8000.00),
  ('Cliente C', 'Calle Secundaria 123', 'www.clientec.com', 10000.00);

-- Inserts para la tabla de contactos
INSERT INTO contactos (nombre_contacto, apellido_contacto, correo, telefono, id_cliente) VALUES
  ('Contacto 1', 'Cliente A', 'contacto1@clienteA.com', '111-111-1111', 1),
  ('Contacto 2', 'Cliente B', 'contacto2@clienteB.com', '222-222-2222', 2),
  ('Contacto 3', 'Cliente C', 'contacto3@clienteC.com', '333-333-3333', 3);

-- Inserts para la tabla de órdenes
INSERT INTO ordenes (id_cliente, estado, id_vendedor, fecha_orden) VALUES
  (1, 'En Proceso', 2, '2023-04-01'),
  (2, 'Entregado', 1, '2023-04-02'),
  (3, 'En Proceso', NULL, '2023-04-03');

-- Inserts para la tabla de ítems de órdenes
INSERT INTO items_ordenes (id_orden, id_item, id_producto, cantidad, precio_unitario) VALUES
  (1, 1, 1, 10, 50.00),
  (1, 2, 2, 5, 30.00),
  (2, 1, 3, 8, 25.00),
  (3, 1, 1, 12, 40.00),
  (3, 2, 2, 6, 35.00);

-- Inserts para la tabla de inventarios
INSERT INTO inventarios (id_producto, id_almacen, cantidad) VALUES
  (1, 1, 100),
  (2, 1, 50),
  (3, 2, 80),
  (1, 3, 120),
  (2, 3, 60);




-- Huevos
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES  
('HUEVOS DE CODORNIZ SOL NACIENTE 24 UND', 5390, 11), 
('HUEVO TIPO AA SOL NACIENTE 30 UND', 16990, 11),
('HUEVO TIPO AA SOL NACIENTE 12 UND', 7650, 11), 
('HUEVO TIPO A SOL NACIENTE 30 UND', 14990, 11);

-- Margarinas y Aceites
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)  
VALUES
('ESPARCIBLE MULTIUSOS RAMA 250 G', 4690, 12),  
('ACEITE GOTA DE ORO 3000 ML', 29990, 12),
('ACEITE DE GIRASOL DON OLIO 2000ML', 26990, 12),  
('ACEITE DE CANOLA DON OLIO 2000 ML', 30950, 12),
('ESPARCIBLE DON OLIO LIGHT 250 G', 4790, 12);

-- Panaderia y Reposteria
INSERT INTO productos (nombre_producto, precio_venta, id_categoria) 
VALUES  
('ACHIRAS DEL HUILA 120 G', 5190, 13),  
('ROSCON RESOBADO BOCADILLO JOSMAR 150 G', 3990, 13),  
('GANSITO RAMO 6 UNIDADES 222 G', 8490, 13),
('PINGÜINOS MARINELA 4 UND - 160 G', 6100, 13),  
('BROWNIE CON AREQUIPE HORNEADITOS 80 GRS', 1890, 13);

-- Pasabocas y Snacks
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)  
VALUES
('CHICHARRÓN CARN AMERI LA VICTORIA 100 GR', 7690, 14),  
('CRISPETA CARAMELO CHEETOS 72 G', 2190, 14),
('DE TODITO BBQ 250GR', 7690, 14), 
('LONJAS DE ALMENDRA NUTHOS 100 GR', 8450, 14),
('MEZCLA NUECES PREMIUM NUTHOS', 7590, 14);

-- Pasta
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)  
VALUES  
('CONCHAS DORIA 250 G', 2150, 15),  
('CABELLO DE ÁNGEL DORIA 250 G', 2150, 15),
('SPAGUETTI CAPRÍSSIMA 250 GRS', 1350, 15),  
('CONCHA CAPRÍSSIMA 250 GRS', 1350, 15),  
('CABELLO DE ÁNGEL CAPRÍSSIMA 250 GRS', 1350, 15);



-- Platos preparados
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES  
('TAMAL TOLIMENSE 2 UND 400 G', 8490, 16),
('PIZZA DE JAMÓN Y QUESO / HAWAIANA BACKEREI 130 ', 4100, 16),
('RAMEN NISSIN SABOR CARNE 85 G', 2490, 16), 
('RAMEN NISSIN SABOR POLLO 85 G', 2490, 16);

-- Postres listos  
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES
('FLAN DE LECHE CON CARAMELO LATTI 150 G', 3750, 17),
('POSTRE DE GELATINA CON LECHE KEDELI 180 G', 3650, 17),  
('ARROZ CON LECHE TRADICIÓN 1915 120 G', 2290, 17),
('LECHE ASADA TRADICIÓN 1915 120 G', 3390, 17);

-- Salsas y Aderezos
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)  
VALUES  
('SALSA MAYOMOSTAZA CON ESPECIAS SHOWY 200 GR', 3890, 18), 
('VINAGRETA RANCH ZEV X 240 GR', 3890, 18),
('VINAGRETA SURTIDA ZEV X 240GR', 3890, 18),  
('MAYONESA FRUCO 480 G', 7750, 18),
('SALSA TÁRTARA ZEV 200GR', 2190, 18);


-- Verduras y Frutas  
INSERT INTO productos (nombre_producto, precio_venta, id_categoria)
VALUES  
('PERA VERDE IMPORTADA 1000 G', 9990, 19),  
('MANZANA ROYAL GALA 1000 GRS', 10590, 19),
('PLÁTANO HARTÓN 1000 G', 5790, 19),  
('AJO MALLA 3 UNIDADES - 100 G', 1450, 19),  
('PAPA CAPIRA 2000 GRS', 5690, 19);



-- Inserts para la tabla de ubicaciones
INSERT INTO ubicaciones (direccion, ciudad) VALUES
  ('Calle 123', 'Bogotá'),
  ('Avenida Principal', 'Bogotá'),
  ('Calle Central', 'Bogotá');

-- Inserts para la tabla de almacenes
INSERT INTO almacenes (nombre_almacen, id_ubicacion) VALUES
  ('Almacén 1', 1),
  ('Almacén 2', 2),
  ('Almacén 3', 3);

-- Inserts para la tabla de empleados
INSERT INTO empleados (nombre, apellido, correo, telefono, fecha_contratacion, id_jefe, titulo_puesto) VALUES
  ('Yanet', 'Meneses', 'yameneses@email.com', '123-456-7890', '2023-01-01', NULL, 'Gerente'),
  ('Ana', 'Martinez', 'ana.martinez@email.com', '987-654-3210', '2023-02-15', 1, 'Supervisor'),
  ('Carlos', 'Lopez', 'carlos.lopez@email.com', '555-555-5555', '2023-03-20', 2, 'Asistente');


-- Inserts para la tabla de usuarios (empleados)
INSERT INTO usuarios (nombre_usuario, contraseña, rol, id_cliente, id_empleado)
VALUES
  ('yanetM', 'Yanet123', 'admin', NULL, 1),
  ('anaM', 'Anita123', 'empleado', NULL, 2),
  ('carlosL', 'Carlos123', 'empleado', NULL, 3);


-- Inserts para la tabla de clientes
INSERT INTO clientes (nombre, direccion, correo, limite_credito)
VALUES
  ('Cliente A', 'Calle Principal 123', 'clienteA@email.com', 50000.00),
  ('Cliente B', 'Avenida Central 456', 'clienteB@email.com', 80000.00),
  ('Cliente C', 'Calle Secundaria 789', 'clienteC@email.com', 100000.00);

-- Inserts para la tabla de usuarios
INSERT INTO usuarios (nombre_usuario, contraseña, rol, id_cliente, id_empleado)
VALUES
  ('clienteA', 'passwordA1', 'cliente', 1, NULL),
  ('clienteB', 'passwordB2', 'cliente', 2, NULL),
  ('clienteC', 'passwordC3', 'cliente', 3, NULL);


-- Inserts para la tabla de órdenes
INSERT INTO ordenes (id_cliente, estado, id_vendedor, fecha_orden) VALUES
  (1, 'En Proceso', 2, '2023-04-01'),
  (2, 'Entregado', 1, '2023-04-02'),
  (3, 'En Proceso', NULL, '2023-04-03');

-- Inserts para la tabla de ítems de órdenes
INSERT INTO items_ordenes (id_orden, id_item, id_producto, cantidad, precio_unitario) VALUES
  (1, 1, 1, 10, 50.00),
  (1, 2, 2, 5, 30.00),
  (2, 1, 3, 8, 25.00),
  (3, 1, 1, 12, 40.00),
  (3, 2, 2, 6, 35.00);

-- Inserts para la tabla de inventarios
INSERT INTO inventarios (id_producto, id_almacen, cantidad) VALUES
  (1, 1, 100),
  (2, 1, 50),
  (3, 2, 80),
  (1, 3, 120),
  (2, 3, 60);

--INVENTARIO ALMACEN 1

INSERT INTO inventarios (id_producto, id_almacen, cantidad) VALUES
  (3, 1, 80),   -- Arepa de chócolo
  (4, 1, 120),  -- Arepa con queso mozzarella
  (5, 1, 60),   -- Arepa de maíz blanco con avena y chía

  (6, 1, 30),   -- Caldo de costilla Maggi
  (7, 1, 40),   -- Caldo de gallina Maggi
  (8, 1, 20),   -- Caldo de gallina Speciaria
  (9, 1, 15),   -- Crema de chócolo Velsup
  (10, 1, 25),  -- Caldo de costilla Speciaria

  (11, 1, 20),  -- Salchicha ranchera
  (12, 1, 15),  -- Jamón Pietran estándar
  (13, 1, 10),  -- Combo tradicional Viandé
  (14, 1, 25),  -- Morcilla Viandé
  (15, 1, 18),  -- Jamón de pollo premium Brakel

  (16, 1, 35),  -- Choco Krispis Kellogg's
  (17, 1, 25),  -- Zucaritas Kellogg's
  (18, 1, 15),  -- Cereal Flips Chocolate
  (19, 1, 28),  -- Froot Loops Kellogg's
  (20, 1, 22); -- Cereal Original Fitness


INSERT INTO inventarios (id_producto, id_almacen, cantidad) VALUES
  (21, 1, 32),  -- Sal Refisal
  (22, 1, 18),  -- Mezcla condimentos Sazonarey
  (23, 1, 15),  -- Pasta de pimentón Delika
  (24, 1, 20),  -- Mezcla para adobar Delika
  (25, 1, 25),  -- Pasta de ajo Delika

  (26, 1, 40),  -- Tirudito Supercoco
  (27, 1, 20),  -- Galleta wafer Cocoseet
  (28, 1, 15),  -- Bom Bom Bum Fresa
  (29, 1, 22),  -- Chocolate KitKat Chunky
  (30, 1, 18),  -- Halls Limón y Miel

  (31, 1, 25),  -- Tomates enteros pelados Deliziare
  (32, 1, 20),  -- Fríjoles con tocino Cooltivo
  (33, 1, 18),  -- Atún rallado El Navío
  (34, 1, 15),  -- Ensalada campesina Cooltivo
  (35, 1, 10),  -- Salmón en aceite Carlo Forte

  (36, 1, 15),  -- Galleta 2 tacos Ducales Noel
  (37, 1, 28),  -- Galletas vainilla 18un Wafer Noel
  (38, 1, 22),  -- Galletas sandwich queso Dux
  (39, 1, 18),  -- Galleta integral Club Social
  (40, 1, 25),  -- Galleta Happy Black

  (41, 1, 20),  -- Panela pulverizada El Refugio
  (42, 1, 15),  -- Arroz Diana
  (43, 1, 25),  -- Arroz integral Diana
  (44, 1, 18),  -- Azúcar blanca
  (45, 1, 22),  -- Endulzante con stevia Natri

  (46, 1, 30),  -- Harina de trigo con polvo para hornear
  (47, 1, 25),  -- Grano entero de quinua
  (48, 1, 20),  -- Premezcla para pancakes Quicksy
  (49, 1, 28),  -- Harina de trigo Quicksy
  (50, 1, 22);  -- Premezcla de galletas con chips de chocolate Qu


INSERT INTO inventarios (id_producto, id_almacen, cantidad) VALUES
  (51, 1, 18),  -- Huevos de codorniz Sol Naciente
  (52, 1, 22),  -- Huevo tipo AA Sol Naciente (30 und)
  (53, 1, 15),  -- Huevo tipo AA Sol Naciente (12 und)
  (54, 1, 25),  -- Huevo tipo A Sol Naciente (30 und)

  (55, 1, 25),  -- Esparcible multiusos Rama
  (56, 1, 20),  -- Aceite Gota de Oro 3000 ml
  (57, 1, 22),  -- Aceite de girasol Don Olio 2000 ml
  (58, 1, 15),  -- Aceite de canola Don Olio 2000 ml
  (59, 1, 18),  -- Esparcible Don Olio Light

  (60, 1, 30),  -- Achiras del Huila
  (61, 1, 25),  -- Roscón resobado Bocadillo Josmar
  (62, 1, 18),  -- Gansito Ramo 6 unidades
  (63, 1, 22),  -- Pingüinos Marinela 4 und
  (64, 1, 20),  -- Brownie con arequipe Horneaditos

  (65, 1, 22),  -- Chicharrón Carn Ameri La Victoria
  (66, 1, 18),  -- Crispeta Caramelo Cheetos
  (67, 1, 20),  -- De Todito BBQ
  (68, 1, 15),  -- Lonjas de almendra Nuthos
  (69, 1, 25),  -- Mezcla nueces Premium Nuthos

  (70, 1, 25),  -- Conchas Doria
  (71, 1, 20),  -- Cabello de ángel Doria
  (72, 1, 18),  -- Spaguetti Capríssima
  (73, 1, 15),  -- Concha Capríssima
  (74, 1, 22),  -- Cabello de ángel Capríssima

  (75, 1, 18),  -- Tamal Tolimense
  (76, 1, 25),  -- Pizza de jamón y queso / Hawaiiana Backerei
  (77, 1, 20),  -- Ramen Nissin sabor carne
  (78, 1, 22),  -- Ramen Nissin sabor pollo

  (79, 1, 20),  -- Flan de leche con caramelo Latti
  (80, 1, 15),  -- Postre de gelatina con leche Kedeli
  (81, 1, 25),  -- Arroz con leche Tradición 1915
  (82, 1, 18),  -- Leche asada Tradición 1915

  (83, 1, 22),  -- Salsa mayomostaza con especias Showy
  (84, 1, 25),  -- Vinagreta Ranch Zev
  (85, 1, 18),  -- Vinagreta Surtida Zev
  (86, 1, 15),  -- Mayonesa Früco
  (87, 1, 20);  -- Salsa tártara Zev

  


