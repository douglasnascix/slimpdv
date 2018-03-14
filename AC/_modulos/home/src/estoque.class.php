<?php

class Estoque{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}


	public function listar(){

		$listar = $this->conn->prepare('SELECT produto_nome, produto_estoque, produto_estoque_min FROM produto WHERE produto_estoque_min > 0 AND produto_estoque < produto_estoque_min ORDER BY produto_nome ASC LIMIT 5');	
		$listar->execute();
		return $listar->fetchAll();
	
	}

}