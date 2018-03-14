<?php

include ROOT.DS."_modulos".DS."relatorio".DS."src".DS."cupom.class.php";
include ROOT.DS."_modulos".DS."empresa".DS."src".DS."empresa.class.php";

$cupomOBJ = new Cupom(new Config());
//$cupoms = $cupomOBJ->listarOK();

$empresaOBJ = new Empresa(new Config());
$empresa = $empresaOBJ->listar();

$css = '<link href="'.$url.'view/css/bootstrap-datepicker.min.css" rel="stylesheet">';
$css .= '<link href="'.$url.'view/css/status.css" rel="stylesheet">';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$ano = $_POST['ano'];
	$mes = $_POST['mes'];

	$cupoms = $cupomOBJ->listarOK($mes, $ano);

}
?>