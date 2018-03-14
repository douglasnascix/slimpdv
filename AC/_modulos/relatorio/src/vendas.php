<?php

include ROOT.DS."_modulos".DS."pedido".DS."src".DS."pedido.class.php";

$pedidoOBJ = new Pedido(new Config());

if(isset($_POST['data_ini'])){

$dados['data_ini'] = implode("-",array_reverse(explode("/",$_POST['data_ini'])));
$dados['data_fim'] = implode("-",array_reverse(explode("/",$_POST['data_fim'])));

$pedidos = $pedidoOBJ->relatorio($dados);
$pagamentos = $pedidoOBJ->relatorioPagamento($dados);
};
$css = '<link href="'.$url.'view/css/bootstrap-datepicker.min.css" rel="stylesheet">';