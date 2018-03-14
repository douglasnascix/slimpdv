<?php

include ROOT.DS."_modulos".DS."pagamento".DS."src".DS."pagamentos.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{

	$dados['pagamento_id'] = $_GET['id'];

	$pagamento = new Pagamento(new config());
	$pagamento->desativa($dados['pagamento_id']);
		
	header("Location: ".$url."pagamento/listar/");
}
exit;
