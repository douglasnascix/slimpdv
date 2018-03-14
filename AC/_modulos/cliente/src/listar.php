<?php
include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$cliente = new Cliente(new config());
		$clientes = $cliente->buscar($_POST['buscar']);

	}else{
		
		$cliente = new Cliente(new config());
		$clientes = $cliente->lista100();

	}
	


?>