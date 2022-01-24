USE pedidos;
SET AUTOCOMMIT = 0;
START TRANSACTION;

-- Crear la tablita
CREATE TABLE `productospendientes` (
  `CodPend` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CodPed` int(11) NOT NULL,
  `CodProd` int(11) NOT NULL,
  `UdPed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Establecemos las claves foráneas
ALTER TABLE `productospendientes`
  ADD CONSTRAINT `productospendientes_ibfk_1` FOREIGN KEY (`CodPed`) REFERENCES `pedidos` (`CodPed`),
  ADD CONSTRAINT `productospendientes_ibfk_2` FOREIGN KEY (`CodProd`) REFERENCES `productos` (`CodProd`);

COMMIT;