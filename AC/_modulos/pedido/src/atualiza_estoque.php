<?php

include "../../../../config/config.php";
include "pedido.class.php";


$pedidoOBJ = new Pedido(new Config());
$pedidos = $pedidoOBJ->atualiza_estoque();

?>