<?php

if (isset($_GET['fechar'])) {	

	session_start();

	if(isset($_SESSION['cart'])){
		unset($_SESSION['cart']);	
	}

	if(isset($_SESSION['PEDIDO'])){
		unset($_SESSION['PEDIDO']);	
	}

	if(isset($_SESSION['pagamento'])){
		unset($_SESSION['pagamento']);	
	}

	if(isset($_SESSION['cpf'])){
		unset($_SESSION['cpf']);	
	}

	if(isset($_SESSION['cliente_nome'])){
		unset($_SESSION['cliente_nome']);	
	}

	if(isset($_SESSION['total'])){
		unset($_SESSION['total']);	
	}

	include "../../../config/config.php";
	header("Location: ".$url."caixa/index/");
}else{
	

	if(isset($_SESSION['cart'])){
		unset($_SESSION['cart']);	
	}

	if(isset($_SESSION['PEDIDO'])){
		unset($_SESSION['PEDIDO']);	
	}

	if(isset($_SESSION['pagamento'])){
		unset($_SESSION['pagamento']);	
	}

	if(isset($_SESSION['cpf'])){
		unset($_SESSION['cpf']);	
	}

	if(isset($_SESSION['cliente_nome'])){
		unset($_SESSION['cliente_nome']);	
	}

	if(isset($_SESSION['total'])){
		unset($_SESSION['total']);	
	}

}
?>