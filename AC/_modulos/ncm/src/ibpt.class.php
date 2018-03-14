<?php

class Ibpt{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}



	public function listar($ncm){

		if(!empty($ncm)){

			try{			
				$buscar = $this->conn->prepare('SELECT descricao, codigo from lei12741 WHERE descricao LIKE :busca AND codigo BETWEEN 9999999 AND 99999999 order by codigo');
				
				$ncm = '%'.$ncm.'%';

				$buscar->bindValue(':busca', $ncm, PDO::PARAM_STR) ;

				$buscar->execute();
				return $buscar->fetchALL();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}


	public function buscar_imposto($ncm){
		try {
			$listar = $this->conn->prepare('SELECT nacionalfederal, importadofederal, estadual, municipal FROM lei12741 WHERE codigo =:ncm LIMIT 1');

			$listar->bindValue(':ncm', $ncm, PDO::PARAM_INT) ;
			$listar->execute();

			return $listar->fetch();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function buscar_ncm($descricao){
		try {
			$listar = $this->conn->prepare('SELECT codigo, descricao FROM lei12741 WHERE descricao LIKE = :descricao');

			$descricao = '%'.$descricao.'%';

			$listar->bindValue(':descricao', $descricao, PDO::PARAM_STR) ;
			$listar->execute();

			return $listar->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	
}
?>