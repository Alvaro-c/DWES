-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2022 a las 16:31:28
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `CodCat` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Descatalogado` int(110) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`CodCat`, `Nombre`, `Descripcion`, `Descatalogado`) VALUES
(1, 'Comida', 'Platos e ingredientes', 0),
(2, 'Bedidas sin', 'Bebidas sin alcohol', 0),
(3, 'Bebidas con', 'Bebidas con alcohol', 0),
(4, 'test', 'test', 0),
(5, 'test2', 'test2', 0),
(6, 'test3', 'test', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `CodPed` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Enviado` int(11) NOT NULL,
  `Restaurante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`CodPed`, `Fecha`, `Enviado`, `Restaurante`) VALUES
(1, '2021-12-20 16:39:53', 0, 1),
(2, '2022-01-12 16:52:04', 0, 4),
(3, '2022-01-14 19:51:49', 0, 4),
(4, '2022-01-17 16:31:47', 0, 4),
(5, '2022-01-17 16:50:53', 0, 4),
(6, '2022-01-17 16:51:18', 0, 4),
(7, '2022-01-17 16:51:19', 0, 4),
(8, '2022-01-17 17:45:11', 0, 4),
(9, '2022-01-17 17:46:09', 0, 4),
(10, '2022-01-17 17:57:18', 0, 4),
(11, '2022-01-17 17:58:09', 0, 4),
(12, '2022-01-17 17:59:52', 0, 4),
(13, '2022-01-17 18:00:27', 0, 4),
(14, '2022-01-17 18:01:29', 0, 4),
(15, '2022-01-17 18:02:40', 0, 4),
(16, '2022-01-17 18:03:00', 0, 4),
(17, '2022-01-17 18:04:19', 0, 4),
(18, '2022-01-17 18:09:27', 0, 4),
(19, '2022-01-17 18:17:55', 0, 4),
(20, '2022-01-17 18:18:14', 0, 4),
(21, '2022-01-17 18:19:16', 0, 4),
(22, '2022-01-17 18:19:59', 0, 4),
(23, '2022-01-17 18:24:43', 0, 4),
(24, '2022-01-17 18:28:23', 0, 4),
(25, '2022-01-17 18:28:24', 0, 4),
(26, '2022-01-17 18:28:26', 0, 4),
(27, '2022-01-17 18:28:45', 0, 4),
(28, '2022-01-17 18:28:59', 0, 4),
(29, '2022-01-17 18:29:36', 0, 4),
(30, '2022-01-17 18:32:02', 0, 4),
(31, '2022-01-19 16:58:17', 1, 5),
(32, '2022-01-19 17:00:05', 1, 5),
(33, '2022-01-19 17:03:44', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproductos`
--

CREATE TABLE `pedidosproductos` (
  `CodPredProd` int(11) NOT NULL,
  `CodPed` int(11) NOT NULL,
  `CodProd` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidosproductos`
--

INSERT INTO `pedidosproductos` (`CodPredProd`, `CodPed`, `CodProd`, `Unidades`) VALUES
(1, 1, 3, 1),
(2, 2, 5, 2),
(3, 2, 6, 1),
(4, 3, 6, 6),
(5, 4, 6, 2),
(6, 5, 6, 1),
(7, 6, 6, 2),
(8, 6, 5, 2),
(9, 6, 3, 1),
(10, 6, 4, 1),
(11, 8, 5, 3),
(12, 8, 6, 3),
(13, 9, 5, 3),
(14, 9, 2, 6),
(15, 10, 5, 3),
(16, 11, 5, 2),
(17, 12, 5, 4),
(18, 13, 5, 3),
(19, 14, 5, 5),
(20, 15, 5, 4),
(21, 16, 5, 4),
(22, 17, 5, 3),
(23, 18, 5, 4),
(24, 19, 2, 5),
(25, 20, 2, 4),
(26, 21, 2, 5),
(27, 22, 2, 5),
(28, 23, 5, 4),
(29, 24, 3, 5),
(30, 27, 5, 3),
(31, 29, 5, 5),
(32, 30, 6, 2),
(33, 31, 2, 7),
(34, 31, 1, 5),
(35, 31, 6, 5),
(36, 31, 5, 3),
(37, 32, 2, 7),
(38, 32, 1, 5),
(39, 32, 6, 5),
(40, 32, 5, 3),
(41, 33, 2, 7),
(42, 33, 1, 5),
(43, 33, 6, 5),
(44, 33, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `CodProd` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Peso` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `Descatalogado` int(110) NOT NULL DEFAULT 0,
  `CodCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `Descatalogado`, `CodCat`) VALUES
(1, 'Harina', '8 paquetes de 1kg de harina cada uno', 8, 100, 0, 1),
(2, 'Azúcar', '20 paquetes de 1kg cada uno', 20, 3, 0, 1),
(3, 'Agua 0.5', '100 botellas de 0.5 litros cada una', 51, 100, 0, 2),
(4, 'Agua 1.5', '20 botellas de 1.5 litros cada una', 31, 50, 0, 2),
(5, 'Cerveza Alhambra tercio', '24 botellas de 33cl', 10, 1, 0, 3),
(6, 'Vino tinto Rioja 0.75', '6 botellas de 0.75 ', 5.5, 10, 0, 3),
(9, 'test', 'test', 10, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productospendientes`
--

CREATE TABLE `productospendientes` (
  `CodPend` int(11) NOT NULL,
  `CodPed` int(11) DEFAULT NULL,
  `CodProd` int(11) DEFAULT NULL,
  `UdPend` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productospendientes`
--

INSERT INTO `productospendientes` (`CodPend`, `CodPed`, `CodProd`, `UdPend`) VALUES
(1, 33, 2, 4),
(2, 33, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `CodRes` int(11) NOT NULL,
  `Correo` varchar(90) NOT NULL,
  `Clave` varchar(255) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Rol` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`CodRes`, `Correo`, `Clave`, `Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`) VALUES
(1, 'madrid1@empresa.com', '$2y$10$UFMwKN4qtxY1.aEVUhgk2O6ziVw5dVRffWFmubvIQOnbgo1i4jjwe', 'España', 28002, 'Madrid', 'C/ Padre  Claret, 8', 0),
(2, 'cadiz1@empresa.com', '$2y$10$JkD8Vhcddt/acARk5f.EIu7.J7oYJNY4NJBUumPhvuiEiKvJ9D/Wi', 'España', 11001, 'Cádiz', 'C/ Portales, 2 ', 0),
(3, 'admin', '$2y$10$snffISUvT3I64P3tE9pJ8uvSRPKjGfTBrsIh7zUO/24HC7FdFzIyy', 'España', 0, 'Segovia', 'Calle Falsa 1234', 1),
(4, 'admin@empresa.com', '$2y$10$dWgTQfnvZS77e.ZGurLv.OeoDcdKmaU0It.MH/RnkQAqU/YN7HkSe', 'España', 28002, 'Madrid', 'C/ Padre  Claret, 8', 1),
(5, 'gestion', '$2y$10$iqYtzZavbZYBBZQYuBilsOSC4XK7rDDHpipl.tw2meRb/UcbZu.Ey', 'España', 40003, 'Segovia', 'Calle 1234', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CodCat`),
  ADD UNIQUE KEY `UN_NOM_CAT` (`Nombre`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`CodPed`),
  ADD KEY `Restaurante` (`Restaurante`);

--
-- Indices de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD PRIMARY KEY (`CodPredProd`),
  ADD KEY `CodPed` (`CodPed`),
  ADD KEY `CodProd` (`CodProd`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`CodProd`),
  ADD KEY `productos_ibfk_1` (`CodCat`);

--
-- Indices de la tabla `productospendientes`
--
ALTER TABLE `productospendientes`
  ADD PRIMARY KEY (`CodPend`),
  ADD KEY `CodPed` (`CodPed`),
  ADD KEY `CodProd` (`CodProd`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`CodRes`),
  ADD UNIQUE KEY `UN_RES_COR` (`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `CodCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `CodPed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  MODIFY `CodPredProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `CodProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productospendientes`
--
ALTER TABLE `productospendientes`
  MODIFY `CodPend` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `CodRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Restaurante`) REFERENCES `restaurantes` (`CodRes`);

--
-- Filtros para la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`CodPed`) REFERENCES `pedidos` (`CodPed`),
  ADD CONSTRAINT `pedidosproductos_ibfk_2` FOREIGN KEY (`CodProd`) REFERENCES `productos` (`CodProd`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`CodCat`) REFERENCES `categorias` (`CodCat`);

--
-- Filtros para la tabla `productospendientes`
--
ALTER TABLE `productospendientes`
  ADD CONSTRAINT `productospendientes_ibfk_1` FOREIGN KEY (`CodPed`) REFERENCES `pedidos` (`CodPed`),
  ADD CONSTRAINT `productospendientes_ibfk_2` FOREIGN KEY (`CodProd`) REFERENCES `productos` (`CodProd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
