<?php
//header('Content-Type: application/json');
//include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include "../../../config/config.php";
include "../../produto/src/produtos.class.php";

if (isset($_GET['acao'])){

	if($_GET['acao'] == 'listaNome'){
		$produto_id = $_GET['id'];
		$produtoOBJ = new Produto(new config());
		$produto = $produtoOBJ->listar($produto_id);

		$produtoJson = new \stdClass();
		$produtoJson->pid = $produto['produto_id'];
		$produtoJson->nome = $produto['produto_nome'];
		$produtoJson->valor = number_format($produto['produto_preco'], 2, ',' , '.');

		echo json_encode($produtoJson);
	}

	if($_GET['acao'] == 'listaTudo'){
		$produtoOBJ = new Produto(new config());
		$produtos = $produtoOBJ->listar();

		$produtoJson = new \stdClass();

		foreach ($produtos as $produto) {
			$produtoJson->nome[] = $produto['produto_id']." - ".$produto['produto_nome'];
		}		

		echo json_encode($produtoJson);
	}

}

?>