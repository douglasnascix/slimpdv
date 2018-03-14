<?php
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."caixa.class.php";

$caixaOBJ = new Caixa(new Config());

if(isset($_POST['valorAbreCaixa'])){
	$dados['caixa_status'] = "Aberto";
	$dados['caixa_data'] = date('Y-m-d H:i:s');
	$dados['caixa_valor'] = $_POST['valorAbreCaixa'];

	$caixaOBJ->AbrirCaixa($dados);
	header("Location: ".$url."caixa/index/");
}

if(isset($_POST['valorFechaCaixa'])){
	$dados['caixa_status'] = "Fechado";
	$dados['caixa_data'] = date('Y-m-d H:i:s');
	$dados['caixa_valor'] = $_POST['valorFechaCaixa'];

	$caixaOBJ->fecharCaixa($dados);
	header("Location: ".$url."caixa/index/");
}

if(isset($_POST['caixa_valor'])){
	$dados['caixa_status'] = $_POST['caixa_status'];
	$dados['caixa_obs'] = $_POST['caixa_obs'];
	$dados['caixa_data'] = date('Y-m-d H:i:s');
	$dados['caixa_valor'] = $_POST['caixa_valor'];

	$caixaOBJ->sangriaSuprimento($dados);
	header("Location: ".$url."caixa/index/");
}
?>