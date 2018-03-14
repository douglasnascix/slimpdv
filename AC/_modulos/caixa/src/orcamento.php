<?php
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."class.pedido.php";

$pedidoOBJ = new Pedido(new Config());
$produtoOBJ = new Produto(new Config());

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$cpf = $_POST['cpf'];
	
	//cliente consumidor caso nao possuir um definido
	if (isset($_POST['cliente_id'])){
		$cliente_id = $_POST['cliente_id'];
	}else{
		$cliente_id = 1;
	}		

	$vtotal = str_replace(",", ".", str_replace(".", "", $_POST['vTotal']));
	
	//edita pedido
	if(isset($_SESSION['pedido_id'])){
		$pedido_id = $_SESSION['pedido_id'];
		$pedidoOBJ->editar($pedido_id, 'Orçamento', '0', $cliente_id, preg_replace("/[^0-9]/", "", $cpf), $vtotal, '0', '0', '0');
		unset($_SESSION['pedido_id']);
	}else{
		//
		//cria pedido
		//
	$pedidoOBJ->criar('Orçamento', '0', $cliente_id, preg_replace("/[^0-9]/", "", $cpf), $vtotal, '0', '0', '0');
	$pedido_id = $pedidoOBJ->lastInsertId();
	$_SESSION['PEDIDO'] = $pedido_id; //guarda pro sat

	};

	//adiciona produtos ao pedido
	foreach ($_SESSION["cart"] as $produto => $valor) {
		$produto_custo = 0.00;
		$produto_banco = $produtoOBJ->listar($valor['id']);
		$produto_preco = $valor['valor'];
		if(isset($produto_banco['produto_custo'])){$produto_custo = $produto_banco['produto_custo'];}
		$pedidoOBJ->addItem($pedido_id, $valor['id'], $valor['qtd'], $produto_custo, $produto_preco);
	}

	$carrinho_limnpar = $url."_modulos/caixa/src/carrinho.php?acao=limpar";
	header("Location: ".$carrinho_limnpar);
	unset($_SESSION['pagamento']);

	exit;

}
exit;