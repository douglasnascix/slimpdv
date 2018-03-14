<?php
include ROOT.DS."_modulos".DS."usuario".DS."src".DS."usuarios.class.php";

	$usuario = new Usuario(new config());
	$usuarios = $usuario->listar();
?>