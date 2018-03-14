<?php

class Pedido{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}


	public function criar($pedido_status, $os_id=0, $cliente_id, $cpf, $pedido_valor, $desconto, $acrescimo, $troco){
		try {
			
			$criar = $this->conn->prepare('INSERT INTO pedido (pedido_status, os_id, cliente_id, pedido_cpf, pedido_data, pedido_data_atualizacao, pedido_valor, pedido_desconto, pedido_acrescimo,pedido_troco) VALUES (:pedido_status, :os_id, :cliente_id, :pedido_cpf, :pedido_data, :pedido_data_atualizacao, :pedido_valor, :pedido_desconto, :pedido_acrescimo, :pedido_troco)');
			
			$criar->bindValue(':pedido_status', $pedido_status, PDO::PARAM_STR);
			$criar->bindValue(':os_id', $os_id, PDO::PARAM_INT);
			$criar->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT);
			$criar->bindValue(':pedido_cpf', $cpf, PDO::PARAM_STR);
			$criar->bindValue(':pedido_data', date("Y-m-d H:i:s"), PDO::PARAM_STR);
			$criar->bindValue(':pedido_data_atualizacao', date("Y-m-d H:i:s"), PDO::PARAM_STR);
			$criar->bindValue(':pedido_valor', $pedido_valor, PDO::PARAM_STR);
			$criar->bindValue(':pedido_desconto', $desconto, PDO::PARAM_STR);
			$criar->bindValue(':pedido_acrescimo', $acrescimo, PDO::PARAM_STR);
			$criar->bindValue(':pedido_troco', $troco, PDO::PARAM_STR);

			return $criar->execute();

		}catch(PDOException $e) {
			return $e->message;
		}

	}


	public function editar($pedido_id, $pedido_status, $os_id=0, $cliente_id, $cpf, $pedido_valor, $desconto, $acrescimo, $troco){
		try {
			
			$editar = $this->conn->prepare('UPDATE pedido SET pedido_status=:pedido_status, os_id=:os_id, cliente_id=:cliente_id, pedido_cpf=:pedido_cpf, pedido_data=:pedido_data, pedido_data_atualizacao=:pedido_data_atualizacao, pedido_valor=:pedido_valor, pedido_desconto=:pedido_desconto, pedido_acrescimo=:pedido_acrescimo, pedido_troco=:pedido_troco WHERE pedido_id =:pedido_id');
			
			$editar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);
			$editar->bindValue(':pedido_status', $pedido_status, PDO::PARAM_STR);
			$editar->bindValue(':os_id', $os_id, PDO::PARAM_INT);
			$editar->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT);
			$editar->bindValue(':pedido_cpf', $cpf, PDO::PARAM_STR);
			$editar->bindValue(':pedido_data', date("Y-m-d H:i:s"), PDO::PARAM_STR);
			$editar->bindValue(':pedido_data_atualizacao', date("Y-m-d H:i:s"), PDO::PARAM_STR);
			$editar->bindValue(':pedido_valor', $pedido_valor, PDO::PARAM_STR);
			$editar->bindValue(':pedido_desconto', $desconto, PDO::PARAM_STR);
			$editar->bindValue(':pedido_acrescimo', $acrescimo, PDO::PARAM_STR);
			$editar->bindValue(':pedido_troco', $troco, PDO::PARAM_STR);

			return $editar->execute();

		}catch(PDOException $e) {
			return $e->message;
		}

	}

	public function lastInsertId($name = NULL) {
	    if(!$this->conn) {
	        throw new Exception('not connected');
	    }

	    return $this->conn->lastInsertId($name);
	}

	
	public function addItem($pedido_id, $produto_id, $produto_quantidade, $produto_custo, $produto_preco){
		try {
			$addItem = $this->conn->prepare('INSERT INTO pedido_produto (pedido_id, produto_id, produto_quantidade, produto_custo, produto_preco) VALUES (:pedido_id, :produto_id, :produto_quantidade, :produto_custo, :produto_preco)');

			$addItem->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);
			$addItem->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
			$addItem->bindValue(':produto_quantidade', $produto_quantidade, PDO::PARAM_INT);
			$addItem->bindValue(':produto_custo', $produto_custo, PDO::PARAM_STR);
			$addItem->bindValue(':produto_preco', $produto_preco, PDO::PARAM_STR);

			$atualiza_estoque = $this->conn->prepare('UPDATE produto SET produto_estoque = (produto_estoque - :produto_estoque) WHERE produto_id = :produto_id ');

			$atualiza_estoque->bindValue(':produto_estoque', $produto_quantidade, PDO::PARAM_INT);
			$atualiza_estoque->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
			$atualiza_estoque->execute();


			return $addItem->execute();
			
		} catch (PDOException $e) {
			echo $e->message;
		}
	}

	public function addPagamento($pedido_id, $pagamento_id, $pedido_pagamento_valor, $pedido_pagamento_parcela, $pedido_pagamento_data=0){
		try {

			$addPagamento = $this->conn->prepare('INSERT INTO pedido_pagamento (pedido_id, pagamento_id, pedido_pagamento_valor, pedido_pagamento_parcela, pedido_pagamento_data) VALUES (:pedido_id, :pagamento_id, :pedido_pagamento_valor, :pedido_pagamento_parcela, :pedido_pagamento_data)');
			
			$addPagamento->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);
			$addPagamento->bindValue(':pagamento_id', $pagamento_id, PDO::PARAM_INT);
			$addPagamento->bindValue(':pedido_pagamento_valor', $pedido_pagamento_valor, PDO::PARAM_STR);
			$addPagamento->bindValue(':pedido_pagamento_parcela', $pedido_pagamento_parcela, PDO::PARAM_INT);
			$addPagamento->bindValue(':pedido_pagamento_data', $pedido_pagamento_data, PDO::PARAM_INT);

			return $addPagamento->execute();

		} catch (PDOException $e) {
			
		}
	}


	public function listar_produto($pedido_id){
		try {
			$listar = $this->conn->prepare('SELECT produto.produto_id, pedido_produto_id, produto_nome, produto_quantidade, pedido_produto.produto_preco from pedido_produto
			INNER JOIN produto ON (pedido_produto.produto_id = produto.produto_id)
			WHERE pedido_produto.pedido_id =:pedido_id');

			$listar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT) ;
			$listar->execute();

			return $listar->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function listar($pedido_id){
		try {
			$listar = $this->conn->prepare('SELECT * from pedido WHERE pedido_id =:pedido_id');

			$listar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT) ;
			$listar->execute();

			return $listar->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function listarOS($os_id){
		try {
			$listar = $this->conn->prepare('SELECT pedido_id from pedido WHERE os_id =:os_id');

			$listar->bindValue(':os_id', $os_id, PDO::PARAM_INT) ;
			$listar->execute();

			return $listar->fetch();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function delItem($pedido_produto_id, $produto_id, $produto_quantidade){
		try {
			$delItem = $this->conn->prepare('DELETE FROM pedido_produto WHERE pedido_produto_id = :pedido_produto_id');
			$delItem->bindValue(':pedido_produto_id', $pedido_produto_id, PDO::PARAM_INT);

			$atualiza_estoque = $this->conn->prepare('UPDATE produto SET produto_estoque = (produto_estoque + :produto_estoque) WHERE produto_id = :produto_id ');

			$atualiza_estoque->bindValue(':produto_estoque', $produto_quantidade, PDO::PARAM_INT);
			$atualiza_estoque->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
			$atualiza_estoque->execute();

			return $delItem->execute();
			
		} catch (PDOException $e) {
			echo $e->message;			
		}
	}

	public function cancelaOS_estoque($produto_id, $produto_quantidade){
		$atualiza_estoque = $this->conn->prepare('UPDATE produto SET produto_estoque = (produto_estoque + :produto_estoque) WHERE produto_id = :produto_id ');

			$atualiza_estoque->bindValue(':produto_estoque', $produto_quantidade, PDO::PARAM_INT);
			$atualiza_estoque->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
			$atualiza_estoque->execute();
	}	


	public function delPagamento($pedido_pagamento_id){
		try {
			$delPagamento = $this->conn->prepare('DELETE FROM pedido_pagamento WHERE pedido_pagamento_id = :pedido_pagamento_id');
			$delPagamento->bindValue(':pedido_pagamento_id', $pedido_pagamento_id, PDO::PARAM_INT);

			return $delPagamento->execute();
			
		} catch (PDOException $e) {
			echo $e->message;			
		}
	}
	
	public function listar_pagamento($pedido_id){
		try {
			$listar = $this->conn->prepare('SELECT pedido_pagamento_id, pagamento_nome, pedido_pagamento_valor, pedido_pagamento_parcela, pedido_pagamento_data from pedido_pagamento INNER JOIN pagamento ON (pedido_pagamento.pagamento_id = pagamento.pagamento_id) WHERE pedido_pagamento.pedido_id =:pedido_id ORDER BY pedido_pagamento_id DESC'); 

			$listar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT) ;
			$listar->execute();

			return $listar->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function limpaValores($pedido_id){
		try {
			$limpaValores = $this->conn->prepare('UPDATE pedido SET pedido_valor=0 WHERE pedido_id =:pedido_id');

			$limpaValores->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT) ;
			$limpaValores->execute();

			return $limpaValores->fetch();

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

}
?>