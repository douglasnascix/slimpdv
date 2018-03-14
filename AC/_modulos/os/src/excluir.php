<?php
if(!isset($_GET['id'])){
	header("Location: ".$url);
}else{
	$id = $_GET['id'];
}


include "../../../config/config.php";
include "../../caixa/src/class.pedido.php";


$pedidoOBJ = new Pedido(new Config());

if(isset($_GET['acao'])){
	if($_GET['acao'] == 'peca'){
		$produtoId = $_GET['produtoId'];
		$quantidade = $_GET['qtd'];
		$pedidoOBJ->delItem($id, $produtoId, $quantidade);
		echo 'ok';
	}

	if($_GET['acao'] == 'pagamento'){
		$pedidoOBJ->delPagamento($id);
		echo 'ok';
	}
}