<?php

include ROOT.DS."_modulos".DS."cliente".DS."src".DS."clientes.class.php";

if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if(isset($_POST['cliente_nome'])){

			$dados['cliente_id'] = $_POST['cliente_id'];
			$dados['cliente_nome'] = $_POST['cliente_nome'];
			$dados['cliente_razao'] = $_POST['cliente_razao'];
			$dados['cliente_cnpj'] = $_POST['cliente_cnpj'];
			$dados['cliente_ie'] = $_POST['cliente_ie'];
			$dados['cliente_cpf'] = $_POST['cliente_cpf'];
			$dados['cliente_rg'] = $_POST['cliente_rg'];
			$dados['cliente_endereco'] = $_POST['cliente_endereco'];
			$dados['cliente_numero'] = $_POST['cliente_numero'];
			$dados['cliente_complemento'] = $_POST['cliente_complemento'];
			$dados['cliente_bairro'] = $_POST['cliente_bairro'];
			$dados['cliente_municipio'] = $_POST['cliente_municipio'];
			$dados['cliente_uf'] = $_POST['cliente_uf'];
			$dados['cliente_cep'] = $_POST['cliente_cep'];
			$dados['cliente_telefone'] = $_POST['cliente_telefone'];
			$dados['cliente_telefone_comercial'] = $_POST['cliente_telefone_comercial'];
			$dados['cliente_celular'] = $_POST['cliente_celular'];
			$dados['cliente_outros'] = $_POST['cliente_outros'];
			$dados['cliente_email'] = $_POST['cliente_email'];
			$dados['cliente_site'] = $_POST['cliente_site'];
			$dados['cliente_contato'] = $_POST['cliente_contato'];
			$dados['cliente_contato_email'] = $_POST['cliente_contato_email'];
			$dados['cliente_status'] = "";
			$dados['cliente_obs'] = $_POST['cliente_obs'];
			

			$cliente = new Cliente(new config());
			$cliente->editar($dados, $dados['cliente_id']);
			

			header("Location: ".$url."cliente/editar/".$_GET['id']."/");
		}

	}

	$clientes = new Cliente(new config());
	$cliente = $clientes->listar($_GET['id']);

};