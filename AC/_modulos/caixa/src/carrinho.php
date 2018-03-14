<?php
session_start();
include "../../../config/config.php";
include "../../caixa/src/class.cart.php";

$carrinho = new Cart(new Config());

//total no session
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


if(isset($_GET['acao'])){

	$acao = $_GET['acao'];

	if(isset($_GET['id'])){$id = $_GET['id'];};
	if(isset($_GET['qtd'])){$qtd = $_GET['qtd'];};
	if(isset($_GET['valor'])){$valor = $_GET['valor'];};
	

	if($acao == "add"){
		$carrinho->add($id, $qtd, $valor);
		calculaTotal();
	}

	if($acao == "del"){
		$carrinho->del($id);
		calculaTotal();
	}

	if($acao == "limpar"){
		unset($_SESSION['cart']);
		calculaTotal();
	}

	if($acao == "cancela_item"){
		$carrinho->cancela_item($id);
		calculaTotal();
	}

	if($acao == "limpa_tudo"){
			$carrinho->limpa_tudo();
			calculaTotal();
	}

}
?>