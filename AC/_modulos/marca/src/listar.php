<?php
include ROOT.DS."_modulos".DS."marca".DS."src".DS."marcas.class.php";

	$marca = new Marca(new config());
	$marcas = $marca->listar();
?>