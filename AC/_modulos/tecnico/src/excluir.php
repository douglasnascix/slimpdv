<?php
include ROOT.DS."_modulos".DS."tecnico".DS."src".DS."tecnicos.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{
	$tecnico = new Tecnico(new config());
	$tecnicoNome = $tecnico->listaNome($_GET['id']);

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['tecnico_id']){
			$tecnico->excluir($_POST['tecnico_id']);
			header("Location: ".$url."tecnico/listar/");	
			exit;
		}	
	}

}