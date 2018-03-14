<?php
include ROOT.DS."_modulos".DS."pedido".DS."src".DS."pedido.class.php";
include ROOT.DS."_modulos".DS."estoque".DS."src".DS."estoque.class.php";
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";

$estoqueOBJ = new Estoque(new Config());
$estoqueMinimo = $estoqueOBJ->listar_home();
$estoque = $estoqueOBJ->contar();

$pedidoOBJ = new Pedido(new Config());
$pedidos = $pedidoOBJ->listar("", "home");
$orcamentos = $pedidoOBJ->orcamentos();
$novos = $pedidoOBJ->novos();

$produtoOBJ = new Produto(new Config());
$produto = $produtoOBJ->contar();

$clienteOBJ = new Cliente(new Config());
$cliente = $clienteOBJ->contar();