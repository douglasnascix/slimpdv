<?php
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$produto = new Produto(new config());
		$produtos = $produto->buscar($_POST['buscar']);

	}else{
		
		$produto = new Produto(new config());
		$produtos = $produto->listar();

	}
$css = '<link rel="stylesheet" href="'.$url.'view/css/dataTables.bootstrap.css">';
$css .= '<link rel="stylesheet" href="'.$url.'view/css/dataTables.responsive.css">';
?>
