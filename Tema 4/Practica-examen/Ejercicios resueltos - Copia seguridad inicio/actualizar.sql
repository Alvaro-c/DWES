
USE pedidos;
SET AUTOCOMMIT = 0;
START TRANSACTION;
--
-- Base de datos: `pedidos`
--

-- --------------------------------------------------------

--
-- Tabla `restaurentes`
--

--
-- Columna `rol`: añadida 
-- Columna `Clave` modificada a 255
--

ALTER TABLE `restaurantes`
  ADD Rol int(11) NOT NULL DEFAULT 0,
  MODIFY Clave VARCHAR(255);

--
-- Volcado de usuario administrador 
--

INSERT INTO `restaurantes` (`Correo`, `Clave`, `Pais`, `CP`, `Ciudad`, `Direccion`,`Rol`) VALUES
('admin@empresa.com', '1234', 'España', 28002, 'Madrid', 'C/ Padre  Claret, 8',1);


COMMIT;