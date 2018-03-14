<?php
include ROOT.DS."_modulos".DS."empresa".DS."src".DS."empresa.class.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(isset($_POST['empresa_nome'])){

		$dados['empresa_id'] = 1;
		$dados['empresa_nome'] = $_POST['empresa_nome'];
		$dados['empresa_razao'] = $_POST['empresa_razao'];
		$dados['empresa_cnpj'] = $_POST['empresa_cnpj'];
		$dados['empresa_ie'] = $_POST['empresa_ie'];
		$dados['empresa_im'] = $_POST['empresa_im'];
		$dados['empresa_RegTribISSQN'] = $_POST['empresa_RegTribISSQN'];
		$dados['empresa_indRatISSQN'] = $_POST['empresa_indRatISSQN'];
		$dados['empresa_email_contabilidade'] = $_POST['empresa_email_contabilidade'];

		$dados['empresa_endereco'] = $_POST['empresa_endereco'];
		$dados['empresa_numero'] = $_POST['empresa_numero'];
		$dados['empresa_complemento'] = $_POST['empresa_complemento'];
		$dados['empresa_bairro'] = $_POST['empresa_bairro'];
		$dados['empresa_municipio'] = $_POST['empresa_municipio'];
		$dados['empresa_uf'] = $_POST['empresa_uf'];
		$dados['empresa_cep'] = $_POST['empresa_cep'];
		$dados['empresa_telefone'] = $_POST['empresa_telefone'];
		$dados['empresa_telefone_outro'] = $_POST['empresa_telefone_outro'];
		$dados['empresa_email'] = $_POST['empresa_email'];
		

		$empresa = new Empresa(new config());
		$empresa->editar($dados);
		

		header("Location: ".$url."empresa/editar/");
	}

}

$empresas = new Empresa(new config());
$empresa = $empresas->listar();
