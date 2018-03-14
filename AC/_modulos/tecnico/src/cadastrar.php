<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(isset($_POST['tecnico_nome'])){

	$dados['tecnico_nome'] = $_POST['tecnico_nome'];};

	include ROOT.DS."_modulos".DS."tecnico".DS."src".DS."tecnicos.class.php";

	$tecnico = new Tecnico(new config());
	$tecnico->adicionar($dados);
	$id = $tecnico->lastInsertId();


	header("Location: ".$url."tecnico/listar/");
}