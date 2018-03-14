<?php

class Marca{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO marca (marca_nome, marca_imagem) VALUES (:marca_nome, :marca_imagem) ;');

		$adicionar->bindValue(':marca_nome', $dados['marca_nome'], PDO::PARAM_STR);
		$adicionar->bindValue(':marca_imagem', $dados['marca_imagem'], PDO::PARAM_STR);
				
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
			$editar = $this->conn->prepare('UPDATE marca SET marca_nome=:marca_nome, marca_imagem=:marca_imagem WHERE marca_id=:marca_id;');

			$editar->bindValue(':marca_id', $dados['marca_id'], PDO::PARAM_STR) ;
			$editar->bindValue(':marca_nome', $dados['marca_nome'], PDO::PARAM_STR) ;
			$editar->bindValue(':marca_imagem', $dados['marca_imagem'], PDO::PARAM_STR) ;
			

			return $editar->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function listar($marca_id=null){

		if(empty($marca_id)){
			$listar = $this->conn->prepare('SELECT * from marca ORDER BY marca_nome ASC');	
			$listar->execute();
			return $listar->fetchAll();
		}else{
			$listar = $this->conn->prepare('SELECT * from marca WHERE marca_id=:marca_id LIMIT 1 ');
			$listar->bindValue(':marca_id', $marca_id, PDO::PARAM_INT) ;

			$listar->execute();
			return $listar->fetch();
		}

	}

	public function listaNome($marca_id){

		if(!empty($marca_id)){

			try{			
				$listarNome = $this->conn->prepare('SELECT marca_id, marca_nome from marca WHERE marca_id=:marca_id LIMIT 1 ');	
				$listarNome->bindValue(':marca_id', $marca_id, PDO::PARAM_INT) ;
				$listarNome->execute();
				return $listarNome->fetch();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}




	public function excluir($marca_id){
		$excluir = $this->conn->prepare('DELETE from marca WHERE marca_id=:marca_id;');

		$excluir->bindValue(':marca_id', $marca_id, PDO::PARAM_INT);

		return $excluir->execute();
	}


	public function excluir_foto($marca_id){

		$excluir_foto = $this->conn->prepare('UPDATE marca set marca_imagem = "" WHERE marca_id=:marca_id');

		$excluir_foto->bindValue('marca_id', $marca_id, PDO::PARAM_INT);

		return $excluir_foto->execute();

	}

}