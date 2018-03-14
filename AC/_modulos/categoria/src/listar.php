<?php
include ROOT.DS."_modulos".DS."categoria".DS."src".DS."categorias.class.php";

	$categoria = new Categoria(new config());
	$categorias = $categoria->listar();
?>