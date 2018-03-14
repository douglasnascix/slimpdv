<?php

class Cupom{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}


	public function listar($mes=null, $ano=null){
		if(is_null($mes)){
			try {
				$listar = $this->conn->prepare('SELECT * from cupom ORDER BY timeStamp DESC');
		
				$listar->execute();
				return $listar->fetchAll();		
					
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}else{
			try {
				$listar = $this->conn->prepare('SELECT * from cupom WHERE MONTH(timeStamp) =:mes AND YEAR(timeStamp) =:ano ORDER BY timeStamp DESC');	
				
				$listar->bindValue(':mes', $mes, PDO::PARAM_STR);
				$listar->bindValue(':ano', $ano, PDO::PARAM_STR);				

				$listar->execute();
				return $listar->fetchAll();		
					
			} catch (PDOException $e) {
				return $e->getMessage("erro");
			}
		}
	}

	public function listarOK($mes=null, $ano=null){

		try {
			$listar = $this->conn->prepare('SELECT * from cupom WHERE (MONTH(timeStamp) =:mes1 AND YEAR(timeStamp) =:ano1 AND  chaveConsulta != "" AND cupom_status = "Emitido") OR (MONTH(timeStamp) =:mes AND YEAR(timeStamp) =:ano AND  chaveConsulta != "" AND cupom_status = "Cancelado")ORDER BY timeStamp ASC');	
			
			$listar->bindValue(':mes1', $mes, PDO::PARAM_STR);
			$listar->bindValue(':ano1', $ano, PDO::PARAM_STR);
			$listar->bindValue(':mes', $mes, PDO::PARAM_STR);
			$listar->bindValue(':ano', $ano, PDO::PARAM_STR);

			$listar->execute();
			return $listar->fetchAll();		
				
		} catch (PDOException $e) {
			return $e->getMessage("erro");
		}

	}
}