<?php
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";

	$produto = new Produto(new config());
	$produtos = $produto->buscar($_POST['busca']);

	echo count($produtos);

	exit;
?>