ALTER TABLE  `pedido` ADD  `pedido_status` VARCHAR( 20 ) NOT NULL AFTER  `pedido_id` ;
UPDATE pedido SET pedido_status = 'Venda';