<?php

class Pagamento{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO pagamento (pagamento_nome) VALUES (:pagamento_nome) ;');

		$adicionar->bindValue(':pagamento_nome', $dados['pagamento_nome'], PDO::PARAM_STR);
				
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







	public function ativa($id){
		try {
			$ativa = $this->conn->prepare('UPDATE pagamento SET pagamento_ativado=1 WHERE pagamento_id=:pagamento_id;');

			$ativa->bindValue(':pagamento_id', $id, PDO::PARAM_INT) ;
	

			return $ativa->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function desativa($id){
		try {
			$desativa = $this->conn->prepare('UPDATE pagamento SET pagamento_ativado=0 WHERE pagamento_id=:pagamento_id;');

			$desativa->bindValue(':pagamento_id', $id, PDO::PARAM_INT) ;
	

			return $desativa->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function listar($pagamento_id=null){

		if(empty($pagamento_id)){
			$listar = $this->conn->prepare('SELECT * from pagamento ORDER BY pagamento_ativado DESC');	
			$listar->execute();
			return $listar->fetchAll();
		}else{
			$listar = $this->conn->prepare('SELECT * from pagamento WHERE pagamento_id=:pagamento_id LIMIT 1 ');
			$listar->bindValue(':pagamento_id', $pagamento_id, PDO::PARAM_INT) ;

			$listar->execute();
			return $listar->fetch();
		}

	}

	public function listarAtivado(){

		$listar = $this->conn->prepare('SELECT * from pagamento WHERE pagamento_ativado = 1');	
		$listar->execute();
		
		return $listar->fetchAll();
		

	}

	public function listaNome($pagamento_id){

		if(!empty($pagamento_id)){

			try{			
				$listarNome = $this->conn->prepare('SELECT pagamento_id, pagamento_nome from pagamento WHERE pagamento_id=:pagamento_id LIMIT 1 ');	
				$listarNome->bindValue(':pagamento_id', $pagamento_id, PDO::PARAM_INT) ;
				$listarNome->execute();
				return $listarNome->fetch();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}




	public function excluir($pagamento_id){
		$excluir = $this->conn->prepare('DELETE from pagamento WHERE pagamento_id=:pagamento_id;');

		$excluir->bindValue(':pagamento_id', $pagamento_id, PDO::PARAM_INT);

		return $excluir->execute();
	}


}