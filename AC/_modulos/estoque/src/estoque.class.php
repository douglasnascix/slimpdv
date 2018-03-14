<?php

class Estoque{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}


	public function listar(){

		$listar = $this->conn->prepare('SELECT produto_id, produto_nome, produto_estoque_min, produto_estoque FROM produto WHERE produto_estoque_min > 0 AND produto_estoque < produto_estoque_min ORDER BY produto_nome ASC ');	
		$listar->execute();
		return $listar->fetchAll();
	
	}


	public function listar_home(){

		$listar = $this->conn->prepare('SELECT produto_nome, produto_estoque, produto_estoque_min FROM produto WHERE produto_estoque_min > 0 AND produto_estoque < produto_estoque_min ORDER BY produto_nome ASC LIMIT 5');	
		$listar->execute();
		return $listar->fetchAll();
	
	}

	public function contar(){

		$contar = $this->conn->prepare('SELECT produto_id FROM produto WHERE produto_estoque_min > 0 AND produto_estoque < produto_estoque_min ORDER BY produto_nome ASC ');	
		$contar->execute();
		return $contar->rowCount();
	
	}

}