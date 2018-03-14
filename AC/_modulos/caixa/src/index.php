<?php
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."class.pedido.php";
include ROOT.DS."_modulos".DS."pagamento".DS."src".DS."pagamentos.class.php";
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."caixa.class.php";

$caixaOBJ = new Caixa(new Config());

$caixa = $caixaOBJ->verificaStatusCaixa();
if($caixa == "Fechado"){
	header("Location: ".$url."caixa/caixa/");
}

$pagamentoOBJ = new Pagamento(new Config());
$pagamentos = $pagamentoOBJ->listarAtivado();

$pedidoOBJ = new Pedido(new Config());
$produtoOBJ = new Produto(new Config());

$css = '<style>.typeahead{max-height:300px;overflow:auto;}</style>';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$cpf = $_POST['cpf'];
	
	//trata acrescimo e desconto se tiver
	$acrescimo = 0;	$desconto = 0;

	if(isset($_POST['ad'])){
		if($_POST['ad'] == "acrescimo"){
			$acrescimo = str_replace(",", ".", str_replace(".", "", $_POST['acrescimoDesconto']));
		}
		if($_POST['ad'] == "desconto"){
			$desconto = str_replace(",", ".", str_replace(".", "", $_POST['acrescimoDesconto']));
		}
	}
	
	//formata valores para banco
	$vtotal = str_replace(",", ".", str_replace(".", "", $_POST['vTotal']));
	$troco = str_replace(",", ".", str_replace(".", "", $_POST['vTroco']));

	

	//cliente consumidor caso nao possuir um definido
	if (isset($_POST['cliente_id'])){
		$cliente_id = $_POST['cliente_id'];
	}else{
		$cliente_id = 1;
	}		

	if(isset($_SESSION['pedido_id'])){
		$pedido_id = $_SESSION['pedido_id'];
		$pedidoOBJ->editar($pedido_id, 'Venda', '', $cliente_id, preg_replace("/[^0-9]/", "", $cpf), $vtotal, $desconto, $acrescimo, $troco, $pedido_id);
		unset($_SESSION['pedido_id']);
		$_SESSION['PEDIDO'] = $pedido_id;
	}else{
		//cria pedido
		$pedidoOBJ->criar('Venda', '', $cliente_id, preg_replace("/[^0-9]/", "", $cpf), $vtotal, $desconto, $acrescimo, $troco);
		$pedido_id = $pedidoOBJ->lastInsertId();
		$_SESSION['PEDIDO'] = $pedido_id; //guarda pro sat
	}


	//pagamento
	foreach ($_SESSION['pagamento'] as $pagou => $valor) {
		$pedidoOBJ->addPagamento($pedido_id, $pagou, $valor['valor'], $valor['parcela']);
	}


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