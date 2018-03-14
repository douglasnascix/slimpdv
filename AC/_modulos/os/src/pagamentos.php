<?php
if(!isset($_GET['id'])){
	header("Location: ".$url);
}

include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";
include ROOT.DS."_modulos".DS."pagamento".DS."src".DS."pagamentos.class.php";
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include ROOT.DS."_modulos".DS."caixa".DS."src".DS."class.pedido.php";
include ROOT.DS."_modulos".DS."os".DS."src".DS."os.class.php";

$id = $_GET['id'];

$osOBJ = new Os(new Config());
$pagamentosOBJ = new Pagamento(new Config());
$clienteOBJ = new Cliente(new Config());
$pedidoOBJ = new Pedido(new Config());

$os = $osOBJ->listar($_GET['id']);

$pagamentos = $pagamentosOBJ->listarAtivado();

$cliente = $clienteOBJ->listar($os['cliente_id']);

$pedido = $pedidoOBJ->listarOS($os['os_id']);

if(!is_array($pedido)){
	$pedidoOBJ->criar('Orçamento', $id, $os['cliente_id'], 0, 0, 0, 0, 0);
};


if($_SERVER['REQUEST_METHOD'] == 'POST') {	
	if($_POST['pagamento_valor'] != 0){

		$data = implode("-",array_reverse(explode("/",$_POST['pagamento_data'])));
		$pedidoOBJ->addPagamento($pedido['pedido_id'], $_POST['pagamento_id'], str_replace(",", ".", str_replace(".", "", $_POST['pagamento_valor'])), '0', $data);

		header("Location: ".$url.'os/pagamentos/'.$os['os_id']);
	}	
}

$pedido_produtos = $pedidoOBJ->listar_produto($pedido['pedido_id']);

$total = 0;
foreach ($pedido_produtos as $pedido_produto){
	$total += $pedido_produto['produto_preco'] * $pedido_produto['produto_quantidade'];
}


$pedido_pagamentos = $pedidoOBJ->listar_pagamento($pedido['pedido_id']);



$css = '<link href="'.$url.'_plugins/select2/select2.min.css" rel="stylesheet">';
$css .= '<link href="'.$url.'_plugins/select2/select2-bootstrap.min.css" rel="stylesheet">';
$css .= '<link href="'.$url.'view/css/bootstrap-datepicker.min.css" rel="stylesheet">';

$titulo_pagina = 'O.S '.$os['os_id'].' - Pagamentos';
?>