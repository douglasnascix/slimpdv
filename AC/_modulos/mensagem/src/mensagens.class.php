<?php

class Mensagem{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}



	public function contar(){
		try {
			$contar = $this->conn->prepare("SELECT mensagem_id from mensagem WHERE mensagem_status = 'Não Lido'");
			$contar->execute();
			return $contar->rowCount();

		} catch (PDOException $e) {
			echo $e->getMessage();	
		}
	}
}