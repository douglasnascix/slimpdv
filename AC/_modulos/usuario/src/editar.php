<?php

include ROOT.DS."_modulos".DS."usuario".DS."src".DS."usuarios.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if(isset($_POST['usuario_nome'])){

			$dados['usuario_id'] = $_POST['usuario_id'];

			$dados['usuario_nome'] = $_POST['usuario_nome'];
			$dados['usuario_email'] = $_POST['usuario_email'];
			$dados['usuario_senha'] = md5($_POST['usuario_senha']);

			$usuario = new Usuario(new config());
			$usuario->editar($dados, $dados['usuario_id']);
			

			header("Location: ".$url."usuario/listar/");
		}
	}

	$usuarios = new Usuario(new config());
	$usuario = $usuarios->listar($_GET['id']);

};