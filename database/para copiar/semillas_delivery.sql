INSERT INTO modulo_delivery.personas
(cedula, nombres, apellidos, genero, fecha_nacimiento)
VALUES  (28434540, 'Luis Gabriel', 'Álvarez', 'Masculino', '2001-12-12'),
	  (31046647, 'Luis Alejandro', 'Petit Quintero', 'Masculino', '2003-03-04'),
	  (30011843, 'Yosmar', 'Pérez', 'Masculino', '2002-05-20'),
	  (23443678, 'Madara', 'Uchiha', 'Masculino', '1500-02-15'),
	  (17908775, 'Satoru', 'Goyo', 'Masculino', '1989-12-07'),
	  (27889321, 'Yuta', 'Okkotsu', 'Masculino', '2001-03-07');

INSERT INTO modulo_delivery.clientes
(fk_persona, telefono)
VALUES(1, "04242797364"),
      (2, "04143093095"),
      (3, "04242033409");
	 
INSERT INTO modulo_delivery.repartidores
(fk_persona, estatus_repartidor, vehiculo_descripcion)
VALUES(4, 'Disponible', 'Moto Azúl Bera-Meru'),
      (5, 'Disponible', 'Moto Negra Bera-BR200'),
      (6, 'Disponible', 'Moto Verde Bera-Carguero 200cc');
     
INSERT INTO modulo_delivery.direcciones
(estado, ciudad, municipio, parroquia, punto_referencia,latitud,longitud)
values
('Distrito Capital', 'Caracas', 'Libertador', 'El Paraíso', 'Urbanización los Verdes',"10.4866465","-66.9424115"),
('Distrito Capital', 'Caracas', 'Libertador', 'El Recreo', 'En 	Frente de la Torre La Previsora',"10.5","-66.9192749"),
('Miranda', 'Gran Caracas', 'Sucre', 'Los Dos Caminos', 'Cerca de la estación de metro Los Dos Caminos',"10.5066887","-66.8519878");

INSERT INTO modulo_delivery.clientes_x_direcciones
(fk_cliente, fk_direccion)
VALUES(1, 1),
      (2, 2),
      (3, 3);
     
INSERT INTO modulo_delivery.metodos_pagos
(nombre_metodo)
VALUES('Transferencia'),
      ('Pago Móvil');
     
INSERT INTO modulo_delivery.menus
(nombre_menu, descripcion_menu, precio_menu)
values
('Hamburguesa Mixta', 'Deliciosa hamburguesa de pollo y carne con lechuga y tomate', 10),
('Pizza Margarita', 'Pizza con salsa de tomate, queso mozzarella y albahaca', 30),
('Ensalada César', 'Ensalada fresca con pollo, lechuga, crutones y aderezo César', 15),
('Tacos de Pollo', 'Tacos rellenos de pollo desmenuzado con salsa picante', 10),
('Sopa de Lentejas', 'Sopa caliente de lentejas con verduras y especias', 20);





