<?php
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{
	$produto = new Produto(new config());
	$produtoNome = $produto->listaNome($_GET['id']);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['produto_id']){
			
			$id_produto = $_POST['produto_id'];

			//exclui produtos
			$produto->excluir($id_produto);
			header("Location: ".$url."produto/listar/");	
			exit;
		}	
	}

}