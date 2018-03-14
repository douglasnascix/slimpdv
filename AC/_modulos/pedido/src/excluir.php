<?php
include ROOT.DS."_modulos".DS."pedido".DS."src".DS."pedido.class.php";

$pedidoOBJ = new Pedido(new Config());
$cancela_pedido = $pedidoOBJ->cancela_pedido($_GET['id']);

echo $cancela_pedido;

exit;
?>