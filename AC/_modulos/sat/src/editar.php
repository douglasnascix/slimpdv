<?php
include ROOT.DS."_modulos".DS."sat".DS."src".DS."sat.class.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	echo "<br><br><br><br>".$_POST['sat_nSerie'];

	if(isset($_POST['sat_nSerie'])){

		$dados['sat_nSerie'] = $_POST['sat_nSerie'];
		$dados['sat_cod_ativacao'] = $_POST['sat_cod_ativacao'];
		$dados['sat_signAC'] = $_POST['sat_signAC'];
	

		$sat = new Sat(new config());
		$sat->editar($dados);
		

		header("Location: ".$url."sat/editar/");
	}

}

$sats = new Sat(new config());
$sat = $sats->listar();
