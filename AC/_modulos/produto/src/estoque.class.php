<?php

class Estoque{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function verificar($dados){
		try {
			$veriicar = $this->conn->prepare('SELECT produto_estoque_id FROm produto_estoque WHERE produto_id = :produto_id and produto_cor = :produto_cor and produto_tam = :produto_tam LIMIT 1');
			$veriicar->bindValue(':produto_id', $dados['produto_id'], PDO::PARAM_INT);
			$veriicar->bindValue(':produto_cor', $dados['produto_cor'], PDO::PARAM_STR);
			$veriicar->bindValue(':produto_tam', $dados['produto_tam'], PDO::PARAM_STR);

			$veriicar->execute();
			return $veriicar->fetch();
			

		} catch (Exception $e) {
			echo 'Exception -> ';
    		var_dump($e->getMessage());
		}
	}



	public function adicionar($dados){

		$verifica_estoque = $this->verificar($dados);

		// $verifica_estoque['produto_estoque_id'];

		if($verifica_estoque['produto_estoque_id']>=1){

			try {
				$atualiza = $this->conn->prepare('UPDATE produto_estoque SET produto_estoque_min =:produto_estoque_min, produto_estoque =:produto_estoque WHERE produto_estoque_id = :produto_estoque_id');

				$atualiza->bindValue(':produto_estoque_id', $verifica_estoque['produto_estoque_id'], PDO::PARAM_INT);
				$atualiza->bindValue(':produto_estoque_min', $dados['produto_estoque_min'], PDO::PARAM_INT);
				$atualiza->bindValue(':produto_estoque', $dados['produto_estoque'], PDO::PARAM_INT);
				
				
				return $atualiza->execute();

			}catch(PDOException $e){ 
				echo $e->getMessage();
			};

		}else{

			try {
				$adicionar = $this->conn->prepare('INSERT INTO produto_estoque (produto_id, produto_cor, produto_tam, produto_estoque_min, produto_estoque) VALUES (:produto_id, :produto_cor, :produto_tam, :produto_estoque_min, :produto_estoque);');

				$adicionar->bindValue(':produto_id', $dados['produto_id'], PDO::PARAM_INT);
				$adicionar->bindValue(':produto_cor', $dados['produto_cor'], PDO::PARAM_STR);
				$adicionar->bindValue(':produto_tam', $dados['produto_tam'], PDO::PARAM_STR);
				$adicionar->bindValue(':produto_estoque_min', $dados['produto_estoque_min'], PDO::PARAM_INT);
				$adicionar->bindValue(':produto_estoque', $dados['produto_estoque'], PDO::PARAM_INT);
				
				
				return $adicionar->execute();

			}catch(PDOException $e){ 
				echo $e->getMessage();
			};
		}

	
	}


	public function listar($produto_id){

		$listar = $this->conn->prepare('SELECT * from produto_estoque 
			INNER JOIN cor ON (cor_id = produto_cor)
			INNER JOIN tamanho ON (tamanho_id = produto_tam)
			WHERE produto_id=:produto_id  order by produto_cor ASC');
		$listar->bindValue(':produto_id', $produto_id, PDO::PARAM_INT) ;

		$listar->execute();
		return $listar->fetchALL();
	}




	public function excluir($produto_estoque_id){
		try {

			$excluir = $this->conn->prepare('DELETE from produto_estoque WHERE produto_estoque_id=:produto_estoque_id ;');
			$excluir->bindValue(':produto_estoque_id', $produto_estoque_id, PDO::PARAM_INT);

			return $excluir->execute();	

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function excluirTudo($produto_id){
		try {

			$excluir = $this->conn->prepare('DELETE from produto_estoque WHERE produto_id=:produto_id ;');
			$excluir->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);

			return $excluir->execute();	

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

}