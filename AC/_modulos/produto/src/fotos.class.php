<?php

class Foto{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}



	public function adicionar($dados){
		try {
				
			$adicionar = $this->conn->prepare("INSERT into produto_foto (produto_id, produto_foto) VALUES (:produto_id, :produto_imagem);");

			$adicionar->bindValue(':produto_id', $dados['produto_id'], PDO::PARAM_INT);
			$adicionar->bindValue(':produto_imagem', $dados['produto_imagem'], PDO::PARAM_STR);

			return $adicionar->execute();

		} catch (PDOException $e) {
				
			echo $e->getMessage();
		}
	}

	public function listar($produto_id){

		$listar = $this->conn->prepare('SELECT * from produto_foto WHERE produto_id=:produto_id  order by produto_foto_id DESC');
		$listar->bindValue(':produto_id', $produto_id, PDO::PARAM_INT) ;

		$listar->execute();
		return $listar->fetchALL();
	}
	

	public function listarunico($produto_foto_id){

		$listar = $this->conn->prepare('SELECT * from produto_foto WHERE produto_foto_id=:produto_foto_id  LIMIT 1');
		$listar->bindValue(':produto_foto_id', $produto_foto_id, PDO::PARAM_INT) ;

		$listar->execute();
		return $listar->fetch();
	}





	public function excluir($produto_foto_id){
		try {

			$excluir = $this->conn->prepare('DELETE from produto_foto WHERE produto_foto_id=:produto_foto_id ;');
			$excluir->bindValue(':produto_foto_id', $produto_foto_id, PDO::PARAM_INT);

			return $excluir->execute();	

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}



	public function excluirtodas($produto_id){
		try {

			$excluir = $this->conn->prepare('DELETE from produto_foto WHERE produto_id=:produto_id ;');
			$excluir->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);

			return $excluir->execute();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}