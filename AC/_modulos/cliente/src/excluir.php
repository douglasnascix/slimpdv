<?php
include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{
	$cliente = new Cliente(new config());
	$clienteNome = $cliente->listaNome($_GET['id']);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['cliente_id']){
			$cliente->excluir($_POST['cliente_id']);
			header("Location: ".$url."cliente/listar/");	
			exit;
		}	
	}

}