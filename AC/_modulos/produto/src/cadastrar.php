<?php

include ROOT.DS."_modulos".DS."categoria".DS."src".DS."categorias.class.php";

$categoria = new Categoria(new config());
$categorias = $categoria->listar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(isset($_POST['produto_nome'])){

		$dados['produto_nome'] = $_POST['produto_nome'];
		$dados['produto_codBarras'] = $_POST['produto_codBarras'];
		$dados['produto_categoria'] = $_POST['produto_categoria'];
		$dados['produto_marca'] = "";
		$dados['produto_estoque'] = $_POST['produto_estoque'];
		$dados['produto_estoque_min'] = $_POST['produto_estoque_min'];
		$dados['produto_unidade'] = $_POST['produto_unidade'];
		$dados['produto_cfop'] = $_POST['produto_cfop'];
		$dados['produto_csosn'] = $_POST['produto_csosn'];
		$dados['produto_ncm'] = $_POST['produto_ncm'];
		$dados['produto_cst'] = $_POST['produto_cst'];
		$dados['produto_cest'] = $_POST['produto_cest'];

				
		include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";

		$produto = new Produto(new config());

		$dados['produto_custo'] = $produto->trata_valor($_POST['produto_custo']);
		$dados['produto_preco'] = $produto->trata_valor($_POST['produto_preco']);

		$produto->adicionar($dados);
		$id = $produto->lastInsertId();

		header("Location: ".$url."produto/editar/".$id."/");
	}
}