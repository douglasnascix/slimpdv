<?php
session_start();
//header('Content-Type: application/json');
//include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";
include "../../../config/config.php";
include "../../cliente/src/clientes.class.php";

if (isset($_GET['acao'])){
	if($_GET['acao'] == 'listaNome'){
		$cliente_id = $_GET['id'];
		$clienteOBJ = new Cliente(new config());
		$cliente = $clienteOBJ->listar($cliente_id);

		$clienteJson = new \stdClass();
		$clienteJson->pid = $cliente['cliente_id'];
		$clienteJson->nome = $cliente['cliente_nome'];

		echo json_encode($clienteJson);
	}

	if($_GET['acao'] == 'listaTudo'){
		$clienteOBJ = new Cliente(new config());
		$clientes = $clienteOBJ->listar();

		$clienteJson = new \stdClass();

		foreach ($clientes as $cliente) {
			$clienteJson->nome[] = $cliente['cliente_id']." - ".$cliente['cliente_nome']." - ".$cliente['cliente_telefone']." - ".$cliente['cliente_celular'];
		}		

		echo json_encode($clienteJson);
	}
}

if(isset($_GET["cliente_nome"])){
	$_SESSION["cliente_nome"] = $_GET["cliente_nome"];
};
?>