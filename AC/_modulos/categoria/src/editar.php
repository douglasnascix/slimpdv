<?php

include ROOT.DS."_modulos".DS."categoria".DS."src".DS."categorias.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if(isset($_POST['categoria_nome'])){

			$dados['categoria_id'] = $_POST['categoria_id'];
			$dados['categoria_nome'] = $_POST['categoria_nome'];

			$categoria = new Categoria(new config());
			$categoria->editar($dados, $dados['categoria_id']);
			

			header("Location: ".$url."categoria/listar/");
		}
	}

	$categorias = new Categoria(new config());
	$categoria = $categorias->listar($_GET['id']);

};