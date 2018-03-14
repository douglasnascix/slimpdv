<?php

class Categoria{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO categoria (categoria_nome) VALUES (:categoria_nome) ;');

		$adicionar->bindValue(':categoria_nome', $dados['categoria_nome'], PDO::PARAM_STR);
				
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
			$editar = $this->conn->prepare('UPDATE categoria SET categoria_nome=:categoria_nome WHERE categoria_id=:categoria_id;');

			$editar->bindValue(':categoria_id', $dados['categoria_id'], PDO::PARAM_STR) ;
			$editar->bindValue(':categoria_nome', $dados['categoria_nome'], PDO::PARAM_STR) ;
			

			return $editar->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function listar($categoria_id=null){

		if(empty($categoria_id)){
			$listar = $this->conn->prepare('SELECT categoria_id, categoria_nome from categoria ORDER BY categoria_id DESC');	
			$listar->execute();
			return $listar->fetchAll();
		}else{
			$listar = $this->conn->prepare('SELECT * from categoria WHERE categoria_id=:categoria_id LIMIT 1 ');
			$listar->bindValue(':categoria_id', $categoria_id, PDO::PARAM_INT) ;

			$listar->execute();
			return $listar->fetch();
		}

	}

	public function listaNome($categoria_id){

		if(!empty($categoria_id)){

			try{			
				$listarNome = $this->conn->prepare('SELECT categoria_id, categoria_nome from categoria WHERE categoria_id=:categoria_id LIMIT 1 ');	
				$listarNome->bindValue(':categoria_id', $categoria_id, PDO::PARAM_INT) ;
				$listarNome->execute();
				return $listarNome->fetch();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}




	public function excluir($categoria_id){
		$excluir = $this->conn->prepare('DELETE from categoria WHERE categoria_id=:categoria_id;');

		$excluir->bindValue(':categoria_id', $categoria_id, PDO::PARAM_INT);

		return $excluir->execute();
	}


}