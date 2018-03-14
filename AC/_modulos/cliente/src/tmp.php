<?php
include "../../../config/config.php";
include "../../../_modulos/cliente/src/clientes.class.php";

	$cliente = new Cliente(new config());
	$clientes = $cliente->listar();

	foreach ($clientes as $cliente){
		echo 'A|1.02';
		
		echo 'E|'."".'|'.$cliente['cliente_cnpj'].'|'.$cliente['cliente_razao'].'|'.$cliente['cliente_ie'].'||'.$cliente['cliente_endereco'].'|'.$cliente['cliente_numero'].'||'.$cliente['cliente_bairro'].'|'3513801'|'Diadema.'|'.SP.'|'.09941760.'|'.1058.'|'.BRASIL.'|'.1140751899.'|'.MICROSERVICE@MICROSERVICES.COM.BR';

	}


?>