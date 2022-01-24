USE pedidos;
SET AUTOCOMMIT = 0;
START TRANSACTION;

-- Añadimos las columnas
ALTER TABLE `productos` ADD `Descatalogado` INT(1) NOT NULL DEFAULT '0' AFTER `CodCat`;
ALTER TABLE `categorias` ADD `Descatalogado` INT(1) NOT NULL DEFAULT '0' AFTER `CodCat`;

COMMIT;