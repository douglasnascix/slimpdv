<?php

class Pedido{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}


	public function listar($pedido_id=null, $home=null){

		if(empty($pedido_id) and $home == "home"){
			$listar = $this->conn->prepare("SELECT * from pedido INNER JOIN cliente ON (pedido.cliente_id = cliente.cliente_id) WHERE pedido_status = 'Venda' ORDER BY pedido_data DESC LIMIT 5");
			$listar->execute();
			return $listar->fetchAll();
		}
		if(empty($pedido_id) and empty($home)){
			$listar = $this->conn->prepare('SELECT * from pedido INNER JOIN cliente ON (pedido.cliente_id = cliente.cliente_id) ORDER BY pedido_data DESC');
			$listar->execute();
			return $listar->fetchAll();
		}
		if(!empty($pedido_id) and empty($home)){
			try {
	
				$listar = $this->conn->prepare('SELECT * from pedido 
				INNER JOIN cliente ON (pedido.cliente_id = cliente.cliente_id) 
				WHERE pedido.pedido_id=:pedido_id ORDER BY pedido_data DESC LIMIT 1 ');
	
				$listar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT) ;

				$listar->execute();
				return $listar->fetch();	
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			
		}

	}

	public function listar_produto($pedido_id){
		try {
			$listar = $this->conn->prepare('SELECT produto.produto_id, produto_nome, produto_cfop, produto_csosn, produto_unidade, produto_quantidade, pedido_produto.produto_preco, produto_ncm, produto_cst from pedido_produto
			INNER JOIN produto ON (pedido_produto.produto_id = produto.produto_id)
			WHERE pedido_produto.pedido_id =:pedido_id');

			$listar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT) ;
			$listar->execute();

			return $listar->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function listar_pagamento($pedido_id){
		try {
			$listar = $this->conn->prepare('SELECT pagamento_nome, pedido_pagamento_valor, pedido_pagamento_parcela, pagamento_cod from pedido_pagamento INNER JOIN pagamento ON (pedido_pagamento.pagamento_id = pagamento.pagamento_id) WHERE pedido_id =:pedido_id');

			$listar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT) ;
			$listar->execute();

			return $listar->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function cancelados(){
		try {
			$cancelados = $this->conn->prepare("SELECT pedido_id from pedido WHERE pedido_status = 'Cancelada' ");
			$cancelados->execute();

			return $cancelados->rowCount();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function listar_cancelados(){
		try {

			$listar = $this->conn->prepare("SELECT * from pedido INNER JOIN cliente ON (pedido.cliente_id = cliente.cliente_id) WHERE pedido_status = 'Cancelada' ORDER BY pedido_data DESC");
			$listar->execute();
			return $listar->fetchAll();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function atualiza_estoque(){
		//LISTA ITENS CANCELADO
		$lista = $this->conn->prepare("SELECT pedido.pedido_id, produto_id, produto_quantidade FROM pedido_produto INNER JOIN pedido ON (pedido_produto.pedido_id = pedido.pedido_id) WHERE pedido_status = 'Cancelada' and pedido_estoque != 'ok' ");
		$lista->execute();
		$pedidos = $lista->fetchAll();

		foreach($pedidos as $pedido){
			$produto_estoque_id = $pedido['produto_id'];
			$produto_quantidade = $pedido['produto_quantidade'];
			$pedido_id = $pedido['pedido_id'];


			//ATUALIZA ESTOQUE
			$atualiza_estoque = $this->conn->prepare('UPDATE produto_estoque SET produto_estoque = (produto_estoque + :produto_estoque) WHERE				produto_estoque_id = :produto_estoque_id ');
			$atualiza_estoque->bindValue(':produto_estoque_id', $produto_estoque_id, PDO::PARAM_INT);
			$atualiza_estoque->bindValue(':produto_estoque', $produto_quantidade, PDO::PARAM_INT);
			$atualiza_estoque->execute();


			$estoque_ok = $this->conn->prepare("UPDATE pedido SET pedido_estoque = 'ok' WHERE pedido_id = :pedido_id ");
			$estoque_ok->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);

			$estoque_ok->execute();

		}
	}

	public function verifica_se_e_sat($pedido_id){
		// verifica se nao é cupom S@T
		$cupom_sat = $this->conn->prepare("SELECT cupom_id FROM cupom WHERE pedido_id = :pedido_id ");
		$cupom_sat->bindValue(":pedido_id", $pedido_id, PDO::PARAM_INT);
		$cupom_sat->execute();
		

		return $cupom_sat->rowCount();
	}


	public function cancela_pedido($pedido_id){

		// verifica se nao é cupom S@T
		$cupom_sat = $this->conn->prepare("SELECT cupom_id FROM cupom WHERE pedido_id = :pedido_id ");
		$cupom_sat->bindValue(":pedido_id", $pedido_id, PDO::PARAM_INT);
		$cupom_sat->execute();
		

		$cupomExiste = $cupom_sat->rowCount();

		if($cupomExiste == 0){

			$cancela_pedido = $this->conn->prepare("UPDATE pedido SET pedido_status = 'Cancelado' WHERE pedido_status != 'Cancelado' and pedido_id = :pedido_id ");
			$cancela_pedido->bindValue(":pedido_id", $pedido_id, PDO::PARAM_INT);
			$cancela_pedido->execute();

			if($cancela_pedido->rowCount() == 1){		

				//pega pedido cancelado
				$lista = $this->conn->prepare("SELECT pedido.pedido_id, produto_id, produto_quantidade FROM pedido_produto INNER JOIN pedido ON (pedido_produto.pedido_id = pedido.pedido_id) WHERE pedido.pedido_id =:pedido_id ");
				$lista->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);
				$lista->execute();
				$pedidos = $lista->fetchAll();

				foreach ($pedidos as $pedido) {				
					$produto_id = $pedido['produto_id'];
					$produto_quantidade = $pedido['produto_quantidade'];

					//ATUALIZA ESTOQUE
					$atualiza_estoque = $this->conn->prepare('UPDATE produto SET produto_estoque = (produto_estoque + :produto_estoque) WHERE				produto_id = :produto_id ');
					$atualiza_estoque->bindValue(':produto_estoque', $produto_quantidade, PDO::PARAM_INT);
					$atualiza_estoque->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
					$atualiza_estoque->execute();

				}

				$status = "Cancelado com Sucesso !";
				return $status;
			}else{
				$status = "Pedido já está Cancelado";
				return $status;
			}

		}else{
			$status = "Pedido não pode ser cancelado devido estar vinculado a um Cupom Fiscal S@t.";
			return $status;		
		}
	}



	public function novos(){
		try {
			$novos = $this->conn->prepare("SELECT pedido_id from pedido");

			$novos->execute();

			return $novos->rowCount();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function relatorio($dados){
		try {
			$listar = $this->conn->prepare("SELECT pedido_id, pedido_valor, pedido_data from pedido WHERE pedido_status = 'Venda' AND pedido_data >= :data_ini AND pedido_data <= :data_fim ");
			$listar->bindValue(':data_ini', $dados['data_ini'], PDO::PARAM_STR);
			$listar->bindValue(':data_fim', $dados['data_fim']." 23:59:59", PDO::PARAM_STR);

			$listar->execute();
			return $listar->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function relatorioPagamento($dados){
		try {
			$listar = $this->conn->prepare("SELECT pagamento_nome, SUM(pedido_pagamento_valor)-SUM(pedido.pedido_troco) as Total from pedido_pagamento INNER JOIN pedido on (pedido_pagamento.pedido_id = pedido.pedido_id) INNER JOIN pagamento ON (pedido_pagamento.pagamento_id=pagamento.pagamento_id) WHERE pedido_status !='Cancelado' AND pedido_data >= :data_ini AND pedido_data <= :data_fim GROUP BY pedido_pagamento.pagamento_id");

			$listar->bindValue(':data_ini', $dados['data_ini'], PDO::PARAM_STR);
			$listar->bindValue(':data_fim', $dados['data_fim']." 23:59:59", PDO::PARAM_STR);

			$listar->execute();
			return $listar->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function orcamentos(){
		try {
			$orcamentos = $this->conn->prepare("SELECT pedido_id, cliente_nome, pedido_valor, pedido_data from pedido INNER JOIN cliente ON (pedido.cliente_id = cliente.cliente_id) WHERE pedido_status = 'Orçamento' ORDER BY pedido_id DESC LIMIT 5");

			$orcamentos->execute();
			return $orcamentos->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


}