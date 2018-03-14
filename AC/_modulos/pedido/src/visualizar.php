<?php
if(!isset($_GET['id'])){
	header("Location: ".$url."pedido/listar/");
}
include ROOT.DS."_modulos".DS."pedido".DS."src".DS."pedido.class.php";

$pedidoOBJ = new Pedido(new Config());
$pedidos = $pedidoOBJ->listar($_GET['id']);

$produtos = $pedidoOBJ->listar_produto($_GET['id']);

$css = 
	'<style>.pedido span{
		display:block;
		font-weight:bold;
		font-size:12px;
	}
	.pedido div{margin-bottom:10px;}

	.table>tbody>tr>td{
     vertical-align: middle !important;
	}
	</style>'
;

?>