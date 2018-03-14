<?php

class Cart{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}




	public function verifica($id){
		try {
			$verifica = $this->conn->prepare('SELECT produto_id FROM produto WHERE produto_id = :produto_id LIMIT 1');
			$verifica->bindValue(':produto_id', $id, PDO::PARAM_INT);
			$verifica->execute();

			return $verifica->rowCount();

		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}

	public function verifica_estoque($id){
		try {
			$verifica = $this->conn->prepare('SELECT produto_estoque FROM produto_estoque WHERE produto_estoque_id = :produto_estoque_id LIMIT 1');
			$verifica->bindValue(':produto_estoque_id', $id, PDO::PARAM_INT);
			$verifica->execute();

			return $verifica->fetch();

		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function add($id, $qtd, $valor){

		$_SESSION['cart'][] = array( 
			"id" => $id,
			"qtd" => $qtd,
			"valor" => $valor,
        );
	}
	
	
	public function del($id){
		unset($_SESSION['cart'][$id]);
		if (count($_SESSION['cart']) == 0) {
			unset($_SESSION['cart']);
		}
	}

	public function limpa_tudo(){
		unset($_SESSION['cart']);
	}


	public function upd($id, $qtd){
		if($qtd == 0){
			$this->del($id);
		}else{
			$verifica_estoque = $this->verifica_estoque($id);
			$emEstoque = $verifica_estoque['produto_estoque'];

			if($emEstoque > $qtd){
				$_SESSION['cart'][$id]['qtd'] = $qtd;
			}else{
				$_SESSION['cart'][$id]['qtd'] = $emEstoque;
			}		
			
		}
	}


	public function cancela_item($id){
		$this->del($id-1);
	}

}

?>