<?php
include ROOT.DS."_modulos".DS."categoria".DS."src".DS."categorias.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{
	$categoria = new Categoria(new config());
	$categoriaNome = $categoria->listaNome($_GET['id']);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['categoria_id']){
			$categoria->excluir($_POST['categoria_id']);
			header("Location: ".$url."categoria/listar/");	
			exit;
		}	
	}

}