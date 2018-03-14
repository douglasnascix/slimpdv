<?php
if (!isset($_GET['id'])) {
	header("location: ".$url);
};

include ROOT.DS."_modulos".DS."caixa".DS."src".DS."class.cart.php";
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."class.pedido.php";

$id = $_GET['id'];

$pedidoOBJ = new Pedido(new Config());
$pedido = $pedidoOBJ->listar($id);


if(!($pedido[0]['pedido_status'] == 'Orçamento')){
	header("location: ".$url);
};

$produtos = $pedidoOBJ->listar_produto($id);

function calculaTotal(){	
	$total = 0;
	if(isset($_SESSION["cart"])){
	foreach ($_SESSION["cart"] as $produto => $valor) {
		$total += $valor["qtd"] * $valor["valor"];
	}
		$_SESSION['total'] = $total; 
	}else{
		$_SESSION['total'] = 0; 
	}
}

$carrinho = new Cart(new Config());
unset($_SESSION['cart']);

foreach ($produtos as $produto) {
	$carrinho->add($produto['produto_id'], $produto['produto_quantidade'], $produto['produto_preco']);
	$pedidoOBJ->delItem($produto['pedido_produto_id']);
}

$pedidoOBJ->limpaValores($id);

calculaTotal();

$_SESSION['pedido_id'] = $id;
header("location: ".$url.'caixa/index/');
?>