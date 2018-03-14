<?php
include ROOT.DS."_modulos".DS."usuario".DS."src".DS."usuarios.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{
	$usuario = new Usuario(new config());
	$usuarioNome = $usuario->listaNome($_GET['id']);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['usuario_id']){
			$usuario->excluir($_POST['usuario_id']);
			header("Location: ".$url."usuario/listar/");	
			exit;
		}	
	}

}