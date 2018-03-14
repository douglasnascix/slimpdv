<?php
include ROOT.DS."_modulos".DS."pedido".DS."src".DS."pedido.class.php";

$pedidoOBJ = new Pedido(new Config());
$pedidos = $pedidoOBJ->listar();

$css = '<link rel="stylesheet" href="'.$url.'view/css/dataTables.bootstrap.css">';
$css .= '<link rel="stylesheet" href="'.$url.'view/css/dataTables.responsive.css">';
?>