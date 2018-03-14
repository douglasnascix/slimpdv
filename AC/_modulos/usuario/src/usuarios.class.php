<?php

class Usuario{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO usuario (usuario_nome, usuario_senha) VALUES (:usuario_nome, :usuario_senha) ;');

		$adicionar->bindValue(':usuario_nome', $dados['usuario_nome'], PDO::PARAM_STR);
		$adicionar->bindValue(':usuario_email', $dados['usuario_email'], PDO::PARAM_STR);
		$adicionar->bindValue(':usuario_senha', $dados['usuario_senha'], PDO::PARAM_STR);
		
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
			$editar = $this->conn->prepare('UPDATE usuario SET usuario_nome=:usuario_nome, usuario_email=:usuario_email, usuario_senha=:usuario_senha WHERE usuario_id=:usuario_id;');

			$editar->bindValue(':usuario_id', $dados['usuario_id'], PDO::PARAM_STR) ;
			$editar->bindValue(':usuario_nome', $dados['usuario_nome'], PDO::PARAM_STR) ;
			$editar->bindValue(':usuario_email', $dados['usuario_email'], PDO::PARAM_STR) ;
			$editar->bindValue(':usuario_senha', $dados['usuario_senha'], PDO::PARAM_STR) ;


			return $editar->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function listar($usuario_id=null){

		if(empty($usuario_id)){
			$listar = $this->conn->prepare('SELECT usuario_id, usuario_nome, usuario_email  from usuario ORDER BY usuario_id DESC');	
			$listar->execute();
			return $listar->fetchAll();
		}else{
			$listar = $this->conn->prepare('SELECT * from usuario WHERE usuario_id=:usuario_id LIMIT 1 ');
			$listar->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT) ;

			$listar->execute();
			return $listar->fetch();
		}

	}

	public function listaNome($usuario_id){

		if(!empty($usuario_id)){

			try{			
				$listarNome = $this->conn->prepare('SELECT usuario_id, usuario_nome from usuario WHERE usuario_id=:usuario_id LIMIT 1 ');	
				$listarNome->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT) ;
				$listarNome->execute();
				return $listarNome->fetch();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}




	public function excluir($usuario_id){
		$excluir = $this->conn->prepare('DELETE from usuario WHERE usuario_id=:usuario_id;');

		$excluir->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);

		return $excluir->execute();
	}


}