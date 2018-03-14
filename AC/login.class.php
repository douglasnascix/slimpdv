<?php

class Login{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function criar_sessao($dados){
		$_SESSION["usuario_id"] = $dados["usuario_id"];
		$_SESSION["usuario_nome"] = $dados["usuario_nome"];
	}

	public function sair(){
		unset($_SESSION["usuario_id"]);
		unset($_SESSION["usuario_nome"]);
	}

	public function logar($dados){

		$this->sair();

		try{
			$verifica = $this->conn->prepare('SELECT usuario_id, usuario_nome from usuario WHERE usuario_id=:usuario_email and usuario_senha=:usuario_senha LIMIT 1 ');	
			$verifica->bindValue(':usuario_email', $dados["usuario_email"], PDO::PARAM_INT) ;
			$verifica->bindValue(':usuario_senha', md5($dados["usuario_senha"]), PDO::PARAM_STR) ;
			$verifica->execute();
			$row = $verifica->fetch(PDO::FETCH_OBJ);

			
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};

		if($verifica->rowCount() > 0){
			$login["usuario_id"] = $row->usuario_id;
			$login["usuario_nome"] = $row->usuario_nome;

			$this->criar_sessao($login);
			return true;
		}else{
			return false;
		}
	}

}

?>