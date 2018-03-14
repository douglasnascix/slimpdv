<?php
include ROOT.DS."_modulos".DS."marca".DS."src".DS."marcas.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{
	$marca = new Marca(new config());
	$marcaNome = $marca->listaNome($_GET['id']);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['marca_id']){
			$marca->excluir($_POST['marca_id']);
			header("Location: ".$url."marca/listar/");	
			exit;
		}	
	}

}