ALTER TABLE  `produto` CHANGE  `produto_cfop`  `produto_csosn` INT( 11 ) NULL DEFAULT NULL ;

ALTER TABLE  `produto` ADD  `produto_cfop` INT( 10 ) NOT NULL AFTER  `produto_unidade` ;

UPDATE produto SET produto_cfop = 5102 WHERE produto_csosn = 102;

UPDATE produto SET produto_cfop = 5405 WHERE produto_csosn = 500;