<?php

class Os{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO os (cliente_id, tecnico_id, os_status, os_carro, os_placa, os_frota, os_motorista, os_motorista_fone, os_problema, os_obs, os_fornecedor, os_data, os_data_atualizado, usuario_id) VALUES (:cliente_id, :tecnico_id, :os_status, :os_carro, :os_placa, :os_frota, :os_motorista, :os_motorista_fone, :os_problema, :os_obs, :os_fornecedor, :os_data, :os_data_atualizado, :usuario_id) ;');

		$adicionar->bindValue(':cliente_id', $dados['cliente_id'], PDO::PARAM_INT);
		$adicionar->bindValue(':tecnico_id', $dados['tecnico_id'], PDO::PARAM_INT);
		$adicionar->bindValue(':usuario_id', $dados['usuario_id'], PDO::PARAM_INT);
		$adicionar->bindValue(':os_status', $dados['os_status'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_carro', $dados['os_carro'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_placa', $dados['os_placa'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_frota', $dados['os_frota'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_motorista', $dados['os_motorista'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_motorista_fone', $dados['os_motorista_fone'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_problema', $dados['os_problema'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_obs', $dados['os_obs'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_fornecedor', $dados['os_fornecedor'], PDO::PARAM_STR);

		$data_atual = date("Y/m/d H:i:s");

		$adicionar->bindValue(':os_data', $data_atual, PDO::PARAM_STR);
		$adicionar->bindValue(':os_data_atualizado', $data_atual, PDO::PARAM_STR);

				
		return $adicionar->execute();

	}catch(PDOException $e){ 
		echo $e->getMessage();
	};
	
	}

	public function editar($dados){
		try {
			$editar = $this->conn->prepare('UPDATE os SET cliente_id=:cliente_id, tecnico_id=:tecnico_id, os_status=:os_status, os_carro=:os_carro, os_placa=:os_placa, os_frota=:os_frota, os_motorista=:os_motorista, os_motorista_fone=:os_motorista_fone, os_problema=:os_problema, os_obs=:os_obs, os_fornecedor=:os_fornecedor, os_data_atualizado=:os_data_atualizado, usuario_id=:usuario_id WHERE os_id = :os_id');

			$editar->bindValue(':cliente_id', $dados['cliente_id'], PDO::PARAM_INT);
			$editar->bindValue(':tecnico_id', $dados['tecnico_id'], PDO::PARAM_INT);
			$editar->bindValue(':usuario_id', $dados['usuario_id'], PDO::PARAM_INT);
			$editar->bindValue(':os_status', $dados['os_status'], PDO::PARAM_STR);
			$editar->bindValue(':os_carro', $dados['os_carro'], PDO::PARAM_STR);
			$editar->bindValue(':os_placa', $dados['os_placa'], PDO::PARAM_STR);
			$editar->bindValue(':os_frota', $dados['os_frota'], PDO::PARAM_STR);
			$editar->bindValue(':os_motorista', $dados['os_motorista'], PDO::PARAM_STR);
			$editar->bindValue(':os_motorista_fone', $dados['os_motorista_fone'], PDO::PARAM_STR);
			$editar->bindValue(':os_problema', $dados['os_problema'], PDO::PARAM_STR);
			$editar->bindValue(':os_obs', $dados['os_obs'], PDO::PARAM_STR);
			$editar->bindValue(':os_fornecedor', $dados['os_fornecedor'], PDO::PARAM_STR);
			$editar->bindValue(':os_id', $dados['os_id'], PDO::PARAM_INT);

			$data_atual = date("Y/m/d H:i:s");

			$editar->bindValue(':os_data_atualizado', $data_atual, PDO::PARAM_STR);

			return $editar->execute();


		} catch (PDOException $e) {
			echo $e;
		}
	}

	public function lastInsertId($name = NULL) {
    if(!$this->conn) {
        throw new Exception('not connected');
    }

    return $this->conn->lastInsertId($name);
	}


	public function listar($os_id=NULL){

		if(empty($os_id)){

			$listar = $this->conn->prepare('SELECT os_id, os_data, cliente_nome, os_carro, os_placa, os_status from os INNER JOIN cliente ON (cliente.cliente_id=os.cliente_id) ORDER BY os_data DESC');
			$listar->execute();
			return $listar->fetchAll();

		}else{
			$listar = $this->conn->prepare('SELECT * from os WHERE os_id=:os_id  ORDER BY os_data DESC');
			$listar->bindValue(':os_id', $os_id, PDO::PARAM_INT) ;
			$listar->execute();
			return $listar->fetch();
		}

	}


	public function listar_cliente($cliente_id){
		
		$listar = $this->conn->prepare('SELECT * from os WHERE cliente_id=:cliente_id ORDER BY os_data DESC');
		$listar->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT) ;

		$listar->execute();
		return $listar->fetchAll();


	}

}