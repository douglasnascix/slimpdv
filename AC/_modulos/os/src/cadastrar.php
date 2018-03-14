<?php

if(!isset($_GET['id'])){
	header("Location: ".$url);
}

include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";
include ROOT.DS."_modulos".DS."os".DS."src".DS."os.class.php";
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."class.pedido.php";
include ROOT.DS."_modulos".DS."marca".DS."src".DS."marcas.class.php";
include ROOT.DS."_modulos".DS."tecnico".DS."src".DS."tecnicos.class.php";


$marcaOBJ = new Marca(new Config());
$marcas = $marcaOBJ->listar();

$clienteOBJ = new Cliente(new Config());
$cliente = $clienteOBJ->listar($_GET['id']);

$osOBJ = new Os(new Config());

$tecnicoOBJ = new Tecnico(new Config());
$tecnicos = $tecnicoOBJ->listarAZ();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$dados['cliente_id'] = $_GET['id'];

	$dados['os_status'] = $_POST['os_status'];
	$dados['marca_id'] = $_POST['marca_id'];
	$dados['os_nserie'] = $_POST['os_nserie'];
	$dados['os_equipamento'] = $_POST['os_equipamento'];
	$dados['os_modelo'] = $_POST['os_modelo'];
	$dados['os_acessorio'] = $_POST['os_acessorio'];
	$dados['os_defeito'] = $_POST['os_defeito'];
	$dados['os_laudo'] = $_POST['os_laudo'];
	$dados['os_obs'] = $_POST['os_obs'];
	$dados['os_obs_interna'] = $_POST['os_obs_interna'];
	$dados['tecnico_id'] = $_POST['tecnico_id'];

	$dados['usuario_id'] = $_SESSION['usuario_id'];


	$osOBJ->adicionar($dados);
	$id = $osOBJ->lastInsertId();

	header("Location: ".$url."os/editar/".$id."/");
};

$titulo_pagina = 'O.S - Cadastrar';