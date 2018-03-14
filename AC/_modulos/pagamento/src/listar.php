<?php
include ROOT.DS."_modulos".DS."pagamento".DS."src".DS."pagamentos.class.php";

	$pagamento = new Pagamento(new config());
	$pagamentos = $pagamento->listar();
?>