<?php

include ROOT.DS."_modulos".DS."caixa".DS."src".DS."caixa.class.php";

$caixaOBJ = new Caixa(new Config());

if(isset($_POST['data_ini'])){

$dados['data_ini'] = implode("-",array_reverse(explode("/",$_POST['data_ini'])));
$dados['data_fim'] = implode("-",array_reverse(explode("/",$_POST['data_fim'])));

$relatorios = $caixaOBJ->relatorio($dados);

};
$css = '<link href="'.$url.'view/css/bootstrap-datepicker.min.css" rel="stylesheet">';