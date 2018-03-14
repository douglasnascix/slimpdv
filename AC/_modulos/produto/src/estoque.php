<?php
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include ROOT.DS."_modulos".DS."produto".DS."src".DS."estoque.class.php";

include ROOT.DS."_modulos".DS."cor".DS."src".DS."cores.class.php";
include ROOT.DS."_modulos".DS."tamanho".DS."src".DS."tamanhos.class.php";

$estoque = new Estoque(new config());
$produtos = new Produto(new config());

$corOBJ = new Cor(new config());
$tamanhoOBJ = new Tamanho(new config());

$estoques = $estoque->listar($_GET['id']);
$produto = $produtos->listaNome($_GET['id']);

$cores = $corOBJ->listar();
$tamanhos = $tamanhoOBJ->listar();

if(isset($_GET['funcao'])){

	if($_GET['funcao'] == "excluir" and is_numeric($_GET['funcao_id'])){

		$estoque->excluir($_GET['funcao_id']);
		header("Location: ".$url."produto/estoque/".$produto[0]."/");
	
	}

}



if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$dados['produto_id'] = $_POST['produto_id'];
	$dados['produto_cor'] = $_POST['produto_cor'];
	$dados['produto_tam'] = $_POST['produto_tamanho'];
	$dados['produto_estoque_min'] = $_POST['produto_estoque_min'];
	$dados['produto_estoque'] = $_POST['produto_estoque'];

	//$verifica_estoque = $estoque->verificar($dados);
	//echo $verifica_estoque['produto_estoque_id'];
	
	$estoque->adicionar($dados);
	header("Location: ".$url."produto/estoque/".$dados['produto_id']."/");	
}



?>