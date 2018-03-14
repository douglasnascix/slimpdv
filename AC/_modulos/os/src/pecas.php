<?php
if(!isset($_GET['id'])){
	header("Location: ".$url);
}

include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."class.pedido.php";
include ROOT.DS."_modulos".DS."os".DS."src".DS."os.class.php";

$id = $_GET['id'];

$osOBJ = new Os(new Config());
$produtosOBJ = new Produto(new Config());

$os = $osOBJ->listar($_GET['id']);
$produtos = $produtosOBJ->listar();

$clienteOBJ = new Cliente(new Config());
$cliente = $clienteOBJ->listar($os['cliente_id']);

$pedidoOBJ = new Pedido(new Config());
$pedido = $pedidoOBJ->listarOS($os['os_id']);

if(!is_array($pedido)){
	$pedidoOBJ->criar('Orçamento', $id, $os['cliente_id'], 0, 0, 0, 0, 0);
};

if($_SERVER['REQUEST_METHOD'] == 'POST') {	
	$produtoAdicionado = $produtosOBJ->listar($_POST['produto_id']);

	$pedidoOBJ->addItem($pedido['pedido_id'], $_POST['produto_id'], $_POST['produto_qtd'], $produtoAdicionado['produto_custo'], str_replace(",", ".", str_replace(".", "", $_POST['produto_valor'])));

	//lista todos produtos e soma
	header("Location: ".$url."os/pecas/".$id);
}

if(isset($_GET['acao'])){

	header("Location: ".$url."os/pecas/".$id);
}

$pedido_produtos = $pedidoOBJ->listar_produto($pedido['pedido_id']);

$css = '<link href="'.$url.'_plugins/select2/select2.min.css" rel="stylesheet">';
$css .= '<link href="'.$url.'_plugins/select2/select2-bootstrap.min.css" rel="stylesheet">';

$titulo_pagina = 'O.S '.$os['os_id'].' - Peças';
?>