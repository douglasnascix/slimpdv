<?php

class Os{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO os (cliente_id, tecnico_id, os_status, marca_id, os_nserie, os_equipamento, os_modelo, os_acessorio, os_defeito, os_laudo, os_obs, os_obs_interna, os_data, os_data_atualizado, usuario_id) VALUES (:cliente_id, :tecnico_id, :os_status, :marca_id, :os_nserie, :os_equipamento, :os_modelo, :os_acessorio, :os_defeito, :os_laudo, :os_obs, :os_obs_interna, :os_data, :os_data_atualizado, :usuario_id) ');

		$adicionar->bindValue(':cliente_id', $dados['cliente_id'], PDO::PARAM_INT);
		$adicionar->bindValue(':tecnico_id', $dados['tecnico_id'], PDO::PARAM_INT);
		$adicionar->bindValue(':usuario_id', $dados['usuario_id'], PDO::PARAM_INT);
		$adicionar->bindValue(':os_status', $dados['os_status'], PDO::PARAM_STR);
		$adicionar->bindValue(':marca_id', $dados['marca_id'], PDO::PARAM_INT);
		$adicionar->bindValue(':os_nserie', $dados['os_nserie'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_equipamento', $dados['os_equipamento'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_modelo', $dados['os_modelo'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_acessorio', $dados['os_acessorio'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_defeito', $dados['os_defeito'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_laudo', $dados['os_laudo'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_obs', $dados['os_obs'], PDO::PARAM_STR);
		$adicionar->bindValue(':os_obs_interna', $dados['os_obs_interna'], PDO::PARAM_STR);		
		
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
			$editar = $this->conn->prepare('UPDATE os SET tecnico_id=:tecnico_id, os_status=:os_status, marca_id=:marca_id, os_nserie=:os_nserie, os_equipamento=:os_equipamento, os_modelo=:os_modelo, os_acessorio=:os_acessorio, os_defeito=:os_defeito, os_laudo=:os_laudo, os_obs=:os_obs, os_obs_interna=:os_obs_interna, os_data_atualizado=:os_data_atualizado WHERE os_id = :os_id');

			$editar->bindValue(':os_id', $dados['os_id'], PDO::PARAM_INT);
			$editar->bindValue(':tecnico_id', $dados['tecnico_id'], PDO::PARAM_INT);			
			$editar->bindValue(':os_status', $dados['os_status'], PDO::PARAM_STR);
			$editar->bindValue(':marca_id', $dados['marca_id'], PDO::PARAM_INT);
			$editar->bindValue(':os_nserie', $dados['os_nserie'], PDO::PARAM_STR);
			$editar->bindValue(':os_equipamento', $dados['os_equipamento'], PDO::PARAM_STR);
			$editar->bindValue(':os_modelo', $dados['os_modelo'], PDO::PARAM_STR);
			$editar->bindValue(':os_acessorio', $dados['os_acessorio'], PDO::PARAM_STR);
			$editar->bindValue(':os_defeito', $dados['os_defeito'], PDO::PARAM_STR);
			$editar->bindValue(':os_laudo', $dados['os_laudo'], PDO::PARAM_STR);
			$editar->bindValue(':os_obs', $dados['os_obs'], PDO::PARAM_STR);
			$editar->bindValue(':os_obs_interna', $dados['os_obs_interna'], PDO::PARAM_STR);

			$data_atual = date("Y/m/d H:i:s");

			$editar->bindValue(':os_data_atualizado', $data_atual, PDO::PARAM_STR);

			return $editar->execute();


		} catch (PDOException $e) {
			return $e;
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

			$listar = $this->conn->prepare('SELECT os_id, os_data, cliente_nome, marca_nome, os_equipamento, os_status from os left JOIN marca ON (marca.marca_id=os.marca_id) INNER JOIN cliente ON (cliente.cliente_id=os.cliente_id) ORDER BY os_data DESC LIMIT 500');
			$listar->execute();
			return $listar->fetchAll();

		}else{
			$listar = $this->conn->prepare('SELECT * from os left JOIN marca ON (marca.marca_id=os.marca_id) INNER JOIN cliente ON (cliente.cliente_id=os.cliente_id) WHERE os_id=:os_id  ORDER BY os_data DESC');
			$listar->bindValue(':os_id', $os_id, PDO::PARAM_INT) ;
			$listar->execute();
			return $listar->fetch();
		}

	}


	public function listar_cliente($cliente_id){
		
		$listar = $this->conn->prepare('SELECT * from os left JOIN marca ON (marca.marca_id=os.marca_id)  WHERE cliente_id=:cliente_id ORDER BY os_data DESC');
		$listar->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT) ;

		$listar->execute();
		return $listar->fetchAll();


	}

}