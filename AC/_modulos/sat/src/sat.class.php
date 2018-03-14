<?php

class Sat{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function editar($dados){
		try {
			$editar = $this->conn->prepare('UPDATE sat SET sat_nSerie=:sat_nSerie, sat_cod_ativacao=:sat_cod_ativacao, sat_signAC=:sat_signAC WHERE sat_id=1');

			$editar->bindValue(':sat_nSerie', $dados['sat_nSerie'], PDO::PARAM_INT) ;
			$editar->bindValue(':sat_cod_ativacao', $dados['sat_cod_ativacao'], PDO::PARAM_INT) ;
			$editar->bindValue(':sat_signAC', $dados['sat_signAC'], PDO::PARAM_STR) ;

			return $editar->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function listar(){
		$listar = $this->conn->prepare('SELECT * from sat WHERE sat_id=1 LIMIT 1 ');

		$listar->execute();
		return $listar->fetch();
	}


}