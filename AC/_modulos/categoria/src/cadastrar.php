<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(isset($_POST['categoria_nome'])){

	$dados['categoria_nome'] = $_POST['categoria_nome'];};

	include ROOT.DS."_modulos".DS."categoria".DS."src".DS."categorias.class.php";

	$categoria = new Categoria(new config());
	$categoria->adicionar($dados);
	$id = $categoria->lastInsertId();


	header("Location: ".$url."categoria/listar");
}