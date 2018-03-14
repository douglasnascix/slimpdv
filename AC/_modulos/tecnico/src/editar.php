<?php

include ROOT.DS."_modulos".DS."tecnico".DS."src".DS."tecnicos.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if(isset($_POST['tecnico_nome'])){

			$dados['tecnico_id'] = $_POST['tecnico_id'];

			$dados['tecnico_nome'] = $_POST['tecnico_nome'];

			$tecnico = new Tecnico(new config());
			$tecnico->editar($dados, $dados['tecnico_id']);
			

			header("Location: ".$url."tecnico/listar/");
		}
	}

	$tecnicos = new Tecnico(new config());
	$tecnico = $tecnicos->listar($_GET['id']);

};