<?php

class Empresa{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function editar($dados){
		try {
			$editar = $this->conn->prepare('UPDATE empresa SET empresa_nome=:empresa_nome, empresa_razao=:empresa_razao, empresa_cnpj=:empresa_cnpj, empresa_ie=:empresa_ie, empresa_im=:empresa_im, empresa_RegTribISSQN=:empresa_RegTribISSQN, empresa_indRatISSQN=:empresa_indRatISSQN, empresa_email_contabilidade=:empresa_email_contabilidade, empresa_endereco=:empresa_endereco, empresa_numero=:empresa_numero, empresa_complemento=:empresa_complemento, empresa_bairro=:empresa_bairro, empresa_municipio=:empresa_municipio, empresa_uf=:empresa_uf, empresa_cep=:empresa_cep, empresa_telefone=:empresa_telefone, empresa_telefone_outro=:empresa_telefone_outro, empresa_email=:empresa_email, empresa_data_atualizado=:empresa_data_atualizado  WHERE empresa_id=1');

			$editar->bindValue(':empresa_nome', $dados['empresa_nome'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_razao', $dados['empresa_razao'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_cnpj', $dados['empresa_cnpj'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_ie', $dados['empresa_ie'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_im', $dados['empresa_im'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_RegTribISSQN', $dados['empresa_RegTribISSQN'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_indRatISSQN', $dados['empresa_indRatISSQN'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_email_contabilidade', $dados['empresa_email_contabilidade'], PDO::PARAM_STR) ;
			
			
			$editar->bindValue(':empresa_endereco', $dados['empresa_endereco'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_numero', $dados['empresa_numero'], PDO::PARAM_INT) ;
			$editar->bindValue(':empresa_complemento', $dados['empresa_complemento'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_bairro', $dados['empresa_bairro'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_municipio', $dados['empresa_municipio'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_uf', $dados['empresa_uf'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_cep', $dados['empresa_cep'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_telefone', $dados['empresa_telefone'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_telefone_outro', $dados['empresa_telefone_outro'], PDO::PARAM_STR) ;
			$editar->bindValue(':empresa_email', $dados['empresa_email'], PDO::PARAM_STR) ;

			$data_atual = date("Y/m/d H:i:s");

			$editar->bindValue(':empresa_data_atualizado', $data_atual, PDO::PARAM_STR) ;


			return $editar->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function listar(){
		$listar = $this->conn->prepare('SELECT * from empresa WHERE empresa_id=1 LIMIT 1 ');

		$listar->execute();
		return $listar->fetch();
	}


}