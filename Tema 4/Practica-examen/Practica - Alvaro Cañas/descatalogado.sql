use pedidos;

ALTER TABLE `productos` ADD `Descatalogado` INT(110) NOT NULL DEFAULT '0' AFTER `Stock`;
ALTER TABLE `categorias` ADD `Descatalogado` INT(110) NOT NULL DEFAULT '0';