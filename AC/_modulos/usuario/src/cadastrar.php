<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(isset($_POST['usuario_nome'])){

	$dados['usuario_nome'] = $_POST['usuario_nome'];};
	$dados['usuario_email'] = $_POST['usuario_email'];
	$dados['usuario_senha'] = md5($_POST['usuario_senha']);

	include ROOT.DS."_modulos".DS."usuario".DS."src".DS."usuarios.class.php";

	$usuario = new Usuario(new config());
	$usuario->adicionar($dados);
	$id = $usuario->lastInsertId();


	header("Location: ".$url."usuario/listar/");
}