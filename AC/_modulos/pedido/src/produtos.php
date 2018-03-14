<?php
if(!isset($_GET['id'])){
	header("Location: ".$url);
}

include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."class.pedido.php";

$id = $_GET['id'];

$pedidoOBJ = new Pedido(new Config());
$produtosOBJ = new Produto(new Config());

$pedido = $pedidoOBJ->listar($_GET['id']);
$pedido = $pedido[0];


$produtos = $produtosOBJ->listar();

$clienteOBJ = new Cliente(new Config());
$cliente = $clienteOBJ->listar($pedido['cliente_id']);



if($_SERVER['REQUEST_METHOD'] == 'POST') {	
	$produtoAdicionado = $produtosOBJ->listar($_POST['produto_id']);

	$pedidoOBJ->addItem($pedido['pedido_id'], $_POST['produto_id'], $_POST['produto_qtd'], $produtoAdicionado['produto_custo'], str_replace(",", ".", str_replace(".", "", $_POST['produto_valor'])));
	header("Location: ".$url."pedido/produtos/".$id);	
}

if(isset($_GET['acao'])){

	header("Location: ".$url."pedido/produtos/".$id);
}

$pedido_produtos = $pedidoOBJ->listar_produto($pedido['pedido_id']);

//print_r($pedido_produtos);

$css = '<link href="'.$url.'_plugins/select2/select2.min.css" rel="stylesheet">';
$css .= '<link href="'.$url.'_plugins/select2/select2-bootstrap.min.css" rel="stylesheet">';
?>