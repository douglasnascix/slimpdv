<?php

include ROOT.DS."_modulos".DS."relatorio".DS."src".DS."cupom.class.php";
include ROOT.DS."_modulos".DS."empresa".DS."src".DS."empresa.class.php";

$cupomOBJ = new Cupom(new Config());
$cupoms = $cupomOBJ->listar();

$empresaOBJ = new Empresa(new Config());
$empresa = $empresaOBJ->listar();

$css = '<link href="'.$url.'view/css/bootstrap-datepicker.min.css" rel="stylesheet">';
$css .= '<link href="'.$url.'view/css/status.css" rel="stylesheet">';
$css .='<style>
.legenda-tabela div{padding:10px;}
</style>';


function calcula_data($cupom_data){
	$datatime1 = new DateTime($cupom_data);
	$datatime2 = new DateTime(date('Y/m/d H:i:s'));

	$intervalo = $datatime1->diff($datatime2);

	$dia = $intervalo->format('%d') * 1440;
	$horas = $intervalo->format('%H') * 60;
	$minutos = $intervalo->format('%i');

	return $dia+$horas+$minutos;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	$ano = $_POST['ano'];
	$mes = $_POST['mes'];

	$cupoms = $cupomOBJ->listar($mes, $ano);

}
?>