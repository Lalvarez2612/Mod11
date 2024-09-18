-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2024 a las 08:19:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `modulo_delivery`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones_x_ordenes`
--

CREATE TABLE `asignaciones_x_ordenes` (
  `id_asignacionOrden` int(11) NOT NULL,
  `fk_repartidor` int(11) NOT NULL,
  `fk_orden` int(11) NOT NULL,
  `tiempo_inicio` time NOT NULL,
  `tiempo_final` time DEFAULT NULL,
  `fecha_asignacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignaciones_x_ordenes`
--

INSERT INTO `asignaciones_x_ordenes` (`id_asignacionOrden`, `fk_repartidor`, `fk_orden`, `tiempo_inicio`, `tiempo_final`, `fecha_asignacion`) VALUES
(1, 1, 2, '10:00:00', NULL, '2024-08-25'),
(2, 2, 3, '09:00:00', '11:00:00', '2024-08-22'),
(3, 3, 4, '13:00:00', NULL, '2024-08-25'),
(4, 2, 1, '22:02:02', NULL, '2024-08-27'),
(5, 3, 5, '22:27:34', NULL, '2024-08-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `fk_persona` int(11) NOT NULL,
  `telefono` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `fk_persona`, `telefono`) VALUES
(1, 1, '04242797364'),
(2, 2, '04143093095'),
(3, 3, '04242033409');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_x_direcciones`
--

CREATE TABLE `clientes_x_direcciones` (
  `id_clientDirec` int(11) NOT NULL,
  `fk_cliente` int(11) NOT NULL,
  `fk_direccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes_x_direcciones`
--

INSERT INTO `clientes_x_direcciones` (`id_clientDirec`, `fk_cliente`, `fk_direccion`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 1, 4),
(5, 2, 5),
(6, 3, 5),
(7, 1, 6),
(8, 2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `parroquia` varchar(100) NOT NULL,
  `punto_referencia` varchar(500) NOT NULL,
  `latitud` varchar(100) NOT NULL,
  `longitud` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `estado`, `ciudad`, `municipio`, `parroquia`, `punto_referencia`, `latitud`, `longitud`) VALUES
(1, 'Distrito Capital', 'Caracas', 'Libertador', 'El Paraíso', 'Urbanización los Verdes', '10.4866465', '-66.9424115'),
(2, 'Distrito Capital', 'Caracas', 'Libertador', 'El Recreo', 'En Frente de la Torre La Previsora', '10.5', '-66.9192749'),
(3, 'Miranda', 'Gran Caracas', 'Sucre', 'Los Dos Caminos', 'Cerca de la estación de metro Los Dos Caminos', '10.5066887', '-66.8519878'),
(4, 'Distrito Capital', 'Caracas', 'Libertador', 'Candelaria', 'Al lado de la torre mercantil', '10.506081', '-66.904309'),
(5, 'Distrito Capital', 'Caracas', 'Libertador', 'Sucre', 'En frente de la iglesia Sagrada Familia, Propatria', '10.504692', '-66.952679'),
(6, 'Distrito Capital', 'Caracas', 'Libertador', 'Sucre', 'Subiendo la cuesta al Inicio de la recta de los Magallanes', '10.51401614199949', '-66.95131135961391'),
(7, 'Distrito Capital', 'Caracas', 'Libertador', 'Sucre', 'Al frente de la estacion del metro de Gato Negro', '10.515991', '-66.940820');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(11) NOT NULL,
  `nombre_menu` varchar(100) NOT NULL,
  `descripcion_menu` varchar(100) NOT NULL,
  `precio_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_menu`, `nombre_menu`, `descripcion_menu`, `precio_menu`) VALUES
(1, 'Hamburguesa Mixta', 'Deliciosa hamburguesa de pollo y carne con lechuga y tomate', 10),
(2, 'Pizza Margarita', 'Pizza con salsa de tomate, queso mozzarella y albahaca', 30),
(3, 'Ensalada César', 'Ensalada fresca con pollo, lechuga, crutones y aderezo César', 15),
(4, 'Tacos de Pollo', 'Tacos rellenos de pollo desmenuzado con salsa picante', 10),
(5, 'Sopa de Lentejas', 'Sopa caliente de lentejas con verduras y especias', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pagos`
--

CREATE TABLE `metodos_pagos` (
  `id_metodoPago` int(11) NOT NULL,
  `nombre_metodo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodos_pagos`
--

INSERT INTO `metodos_pagos` (`id_metodoPago`, `nombre_metodo`) VALUES
(1, 'Transferencia'),
(2, 'Pago Móvil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_08_24_235904_create_asignaciones_x_ordenes_table', 1),
(2, '2024_08_24_235904_create_clientes_table', 1),
(3, '2024_08_24_235904_create_clientes_x_direcciones_table', 1),
(4, '2024_08_24_235904_create_direcciones_table', 1),
(5, '2024_08_24_235904_create_menus_table', 1),
(6, '2024_08_24_235904_create_metodos_pagos_table', 1),
(7, '2024_08_24_235904_create_ordenes_table', 1),
(8, '2024_08_24_235904_create_personas_table', 1),
(9, '2024_08_24_235904_create_repartidores_table', 1),
(10, '2024_08_24_235904_create_rutas_table', 1),
(11, '2024_08_24_235907_add_foreign_keys_to_asignaciones_x_ordenes_table', 1),
(12, '2024_08_24_235907_add_foreign_keys_to_clientes_table', 1),
(13, '2024_08_24_235907_add_foreign_keys_to_clientes_x_direcciones_table', 1),
(14, '2024_08_24_235907_add_foreign_keys_to_ordenes_table', 1),
(15, '2024_08_24_235907_add_foreign_keys_to_repartidores_table', 1),
(16, '2024_08_24_235907_add_foreign_keys_to_rutas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id_orden` int(11) NOT NULL,
  `fk_cliente` int(11) NOT NULL,
  `fk_metodoPago` int(11) NOT NULL,
  `orden_codigo` varchar(100) NOT NULL,
  `orden_cantidad` int(11) NOT NULL,
  `orden_estatus` varchar(100) NOT NULL,
  `comentario_adicional` varchar(200) NOT NULL,
  `fechaCreacion_orden` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id_orden`, `fk_cliente`,  `fk_metodoPago`, `orden_codigo`, `orden_cantidad`, `orden_estatus`, `comentario_adicional`, `fechaCreacion_orden`) VALUES
(1, 1,  1, 'O-3342', 5, 'Asignada', 'Todas con nextra queso amarrilo y salsa de maíz. Un refresco pepsi de 2 litros.', '2024-08-26'),
(2, 2,  2, 'O-1255', 4, 'Aisgnada', 'Dos con extra queso, una de peeroni y la otra de champiñones. Un refresco chinoto de 1 litro.', '2024-08-26'),
(3, 3,  2, 'O-8964', 20, 'Entregada', 'Todos con extra queso y salsa de maiz, agrega 3 refrescos cocacola de 2 litros. Pedido para un evento.', '2024-08-26'),
(4, 3,  1, 'O-2367', 5, 'Asignada', 'Con extra queso, mayonesa y salsa de tomate. Un refresco colita de 1 litro.', '2024-08-26'),
(5, 2,  2, 'O-2817', 11, 'Asignada', 'EUUUUU', '2024-08-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `apellidos` varchar(250) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `fecha_nacimiento` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `cedula`, `nombres`, `apellidos`, `genero`, `fecha_nacimiento`) VALUES
(1, 28434540, 'Luis Gabriel', 'Álvarez', 'Masculino', '2001-12-12 00:00:00'),
(2, 31046647, 'Luis Alejandro', 'Petit Quintero', 'Masculino', '2003-03-04 00:00:00'),
(3, 30011843, 'Yosmar', 'Pérez', 'Masculino', '2002-05-20 00:00:00'),
(4, 23443678, 'Madara', 'Uchiha', 'Masculino', '1500-02-15 00:00:00'),
(5, 17908775, 'Satoru', 'Goyo', 'Masculino', '1989-12-07 00:00:00'),
(6, 27889321, 'Yuta', 'Okkotsu', 'Masculino', '2001-03-07 00:00:00');

-- --------------------------------------------------------

--
-- Creacion de tabla `ordenes_has_menus`
--
CREATE TABLE `ordenes_has_menus` (
  `id_ordenes_has_menus` int(11) NOT NULL,
  `ordenes_id_orden` int(11) NOT NULL,
  `menus_id_menu` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos en la tabla
--

INSERT INTO `ordenes_has_menus` (`id_ordenes_has_menus`,`ordenes_id_orden`,`menus_id_menu`,`cantidad`) VALUES
(1, 1,1,2),
(2,1,2,1),
(3,2,3,1),
(4,2,4,2),
(5,2,5,3),
(6,3,1,1),
(7,4,2,2),
(8,5,3,3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidores`
--

CREATE TABLE `repartidores` (
  `id_repartidor` int(11) NOT NULL,
  `fk_persona` int(11) NOT NULL,
  `estatus_repartidor` varchar(100) NOT NULL,
  `vehiculo_descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `repartidores`
--

INSERT INTO `repartidores` (`id_repartidor`, `fk_persona`, `estatus_repartidor`, `vehiculo_descripcion`) VALUES
(1, 4, 'Disponible', 'Moto Azúl Bera-Meru'),
(2, 5, 'Disponible', 'Moto Negra Bera-BR200'),
(3, 6, 'Disponible', 'Moto Verde Bera-Carguero 200cc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(11) NOT NULL,
  `fk_orden` int(11) NOT NULL,
  `fk_direccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id_ruta`, `fk_orden`, `fk_direccion`) VALUES
(1, 2, 2),
(2, 3, 3),
(3, 4, 1),
(4, 1, 2),
(5, 5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones_x_ordenes`
--
ALTER TABLE `asignaciones_x_ordenes`
  ADD PRIMARY KEY (`id_asignacionOrden`),
  ADD KEY `fk_repartidores_has_ordenes_repartidores1_idx` (`fk_repartidor`),
  ADD KEY `fk_repartidores_has_ordenes_ordenes1_idx` (`fk_orden`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_clientes_personas1_idx` (`fk_persona`);

--
-- Indices de la tabla `clientes_x_direcciones`
--
ALTER TABLE `clientes_x_direcciones`
  ADD PRIMARY KEY (`id_clientDirec`),
  ADD KEY `fk_clientes_has_direcciones_clientes1_idx` (`fk_cliente`),
  ADD KEY `fk_clientes_has_direcciones_direcciones1_idx` (`fk_direccion`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `metodos_pagos`
--
ALTER TABLE `metodos_pagos`
  ADD PRIMARY KEY (`id_metodoPago`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id_orden`),
  ADD UNIQUE KEY `orden_codigo_unique` (`orden_codigo`),
  ADD KEY `fk_ordenes_clientes1_idx` (`fk_cliente`),
  ADD KEY `fk_ordenes_metodos_pagos1_idx` (`fk_metodoPago`);

-- 
-- indices de la tabla ordenes_has_menus
--
ALTER TABLE `ordenes_has_menus`
  ADD PRIMARY KEY (`id_ordenes_has_menus`),
  ADD KEY `fk_orXme_menús1_idx` (`menus_id_menu`),
  ADD KEY `fk_orXme_ordenes1_idx` (`ordenes_id_orden`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `cedula_unique` (`cedula`);

--
-- Indices de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD PRIMARY KEY (`id_repartidor`),
  ADD KEY `fk_repartidores_personas1_idx` (`fk_persona`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `fk_ordenes_has_direcciones_ordenes1_idx` (`fk_orden`),
  ADD KEY `fk_ordenes_has_direcciones_direcciones1_idx` (`fk_direccion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones_x_ordenes`
--
ALTER TABLE `asignaciones_x_ordenes`
  MODIFY `id_asignacionOrden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes_x_direcciones`
--
ALTER TABLE `clientes_x_direcciones`
  MODIFY `id_clientDirec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `metodos_pagos`
--
ALTER TABLE `metodos_pagos`
  MODIFY `id_metodoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT tabla orXmen
--
ALTER TABLE `ordenes_has_menus`
  MODIFY `id_ordenes_has_menus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  MODIFY `id_repartidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_Clientes_personas1` FOREIGN KEY (`fk_persona`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `fk_ordenes_Clientes1` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordenes_metodos_pagos1` FOREIGN KEY (`fk_metodoPago`) REFERENCES `metodos_pagos` (`id_metodoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Filtros para la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD CONSTRAINT `fk_Repartidores_personas1` FOREIGN KEY (`fk_persona`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignaciones_x_ordenes`
--
ALTER TABLE `asignaciones_x_ordenes`
  ADD CONSTRAINT `fk_repartidores_has_ordenes_ordenes1` FOREIGN KEY (`fk_orden`) REFERENCES `ordenes` (`id_orden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_repartidores_has_ordenes_repartidores1` FOREIGN KEY (`fk_repartidor`) REFERENCES `repartidores` (`id_repartidor`) ON DELETE NO ACTION ON UPDATE NO ACTION;



--
-- Filtros para la tabla `clientes_x_direcciones`
--
ALTER TABLE `clientes_x_direcciones`
  ADD CONSTRAINT `fk_Clientes_has_Direcciones_Clientes1` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clientes_has_Direcciones_Direcciones1` FOREIGN KEY (`fk_direccion`) REFERENCES `direcciones` (`id_direccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- fk orXme
--
ALTER TABLE `ordenes_has_menus`
  ADD CONSTRAINT `fk_orXme_ordenes1` FOREIGN KEY (`ordenes_id_orden`) REFERENCES `ordenes` (`id_orden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orXme_menus1` FOREIGN KEY (`menus_id_menu`) REFERENCES `menus` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `fk_ordenes_has_direcciones_direcciones1` FOREIGN KEY (`fk_direccion`) REFERENCES `direcciones` (`id_direccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordenes_has_direcciones_ordenes1` FOREIGN KEY (`fk_orden`) REFERENCES `ordenes` (`id_orden`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
