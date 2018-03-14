<?php

if(!isset($_GET['id'])){
	header("Location: ".$url);
}

include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";
include ROOT.DS."_modulos".DS."os".DS."src".DS."os.class.php";

$clienteOBJ = new Cliente(new Config());
$cliente = $clienteOBJ->listar($_GET['id']);

$osOBJ = new Os(new Config());
$oss = $osOBJ->listar_cliente($cliente['cliente_id']);

?>