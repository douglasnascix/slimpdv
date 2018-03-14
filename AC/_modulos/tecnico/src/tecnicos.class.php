<?php

class Tecnico{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO tecnico (tecnico_nome) VALUES (:tecnico_nome) ;');

		$adicionar->bindValue(':tecnico_nome', $dados['tecnico_nome'], PDO::PARAM_STR);
		
		return $adicionar->execute();

	}catch(PDOException $e){ 
		echo $e->getMessage();
	};

	
	}





	public function lastInsertId($name = NULL) {
    if(!$this->conn) {
        throw new Exception('not connected');
    }

    return $this->conn->lastInsertId($name);
	}







	public function editar($dados, $id){
		try {
			$editar = $this->conn->prepare('UPDATE tecnico SET tecnico_nome=:tecnico_nome WHERE tecnico_id=:tecnico_id;');

			$editar->bindValue(':tecnico_id', $dados['tecnico_id'], PDO::PARAM_STR) ;
			$editar->bindValue(':tecnico_nome', $dados['tecnico_nome'], PDO::PARAM_STR) ;

			return $editar->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function listar($tecnico_id=null){

		if(empty($tecnico_id)){
			$listar = $this->conn->prepare('SELECT tecnico_id, tecnico_nome  from tecnico ORDER BY tecnico_id DESC');	
			$listar->execute();
			return $listar->fetchAll();
		}else{
			$listar = $this->conn->prepare('SELECT * from tecnico WHERE tecnico_id=:tecnico_id LIMIT 1 ');
			$listar->bindValue(':tecnico_id', $tecnico_id, PDO::PARAM_INT) ;

			$listar->execute();
			return $listar->fetch();
		}

	}

	public function listarAZ(){

		$listar = $this->conn->prepare('SELECT tecnico_id, tecnico_nome from tecnico ORDER BY tecnico_nome ASC');	
		$listar->execute();
		return $listar->fetchAll();

	}

	public function listaNome($tecnico_id){

		if(!empty($tecnico_id)){

			try{			
				$listarNome = $this->conn->prepare('SELECT tecnico_id, tecnico_nome from tecnico WHERE tecnico_id=:tecnico_id LIMIT 1 ');	
				$listarNome->bindValue(':tecnico_id', $tecnico_id, PDO::PARAM_INT) ;
				$listarNome->execute();
				return $listarNome->fetch();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}




	public function excluir($tecnico_id){
		$excluir = $this->conn->prepare('DELETE from tecnico WHERE tecnico_id=:tecnico_id;');

		$excluir->bindValue(':tecnico_id', $tecnico_id, PDO::PARAM_INT);

		return $excluir->execute();
	}


}