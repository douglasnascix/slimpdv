<?php

include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";

include ROOT.DS."_modulos".DS."categoria".DS."src".DS."categorias.class.php";
$categoria = new Categoria(new config());
$categorias = $categoria->listar();

$produtos = new Produto(new config());
$produto = $produtos->listar($_GET['id']);


if(empty($_GET['id'])){
	header("Location: ".$url);
	exit;
}else{

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if(isset($_POST['produto_nome'])){

			$dados['produto_id'] = $_POST['produto_id'];
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
			
			
			$produtoObj = new Produto(new config());
			
			$dados['produto_custo'] = $produtoObj->trata_valor($_POST['produto_custo']);
			$dados['produto_preco'] = $produtoObj->trata_valor($_POST['produto_preco']);


			$produtoObj->editar($dados, $dados['produto_id']);
			

			header("Location: ".$url."produto/editar/".$_GET['id']."/");
		}

	}


};