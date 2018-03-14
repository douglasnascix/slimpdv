<?php

include "../../../config/config.php";
include "../../../_modulos/produto/src/produtos.class.php";

$produto = new Produto(new config());
$produtos = $produto->listar();

echo 'PRODUTO|'.count($produtos).'<br>';

foreach ($produtos as $produto) {

echo utf8_decode('A|1.02<br>
I|'.$produto['produto_id'].'|'.$produto['produto_nome'].'||'.$produto['produto_ncm'].'|||'.$produto['produto_unidade'].'|'.$produto['produto_preco'].'00||'.$produto['produto_unidade'].'|'.$produto['produto_preco'].'00|1.0000|<br>
M|0|1<br>
N|102|0|||||||||||<br>');

};
?>
