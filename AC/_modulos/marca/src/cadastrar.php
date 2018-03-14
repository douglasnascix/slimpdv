<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(isset($_POST['marca_nome'])){

	$dados['marca_nome'] = $_POST['marca_nome'];

	include ROOT.DS."_modulos".DS."marca".DS."src".DS."marcas.class.php";

	include ROOT.DS."_modulos".DS."marca".DS."src".DS."salva_imagem.php";

	$marca = new Marca(new config());
	$marca->adicionar($dados);
	$id = $marca->lastInsertId();


	header("Location: ".$url."marca/listar");

	};
}