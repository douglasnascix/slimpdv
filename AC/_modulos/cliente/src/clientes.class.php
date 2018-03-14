<?php

class Cliente{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO cliente (cliente_nome, cliente_razao, cliente_cnpj, cliente_ie, cliente_cpf, cliente_rg, cliente_endereco, cliente_numero, cliente_complemento, cliente_bairro, cliente_municipio, cliente_uf, cliente_cep, cliente_telefone, cliente_telefone_comercial, cliente_celular, cliente_outros, cliente_email, cliente_site, cliente_contato, cliente_contato_email, cliente_data_cadastro, cliente_data_atualizado, cliente_status, cliente_obs) VALUES (:cliente_nome,:cliente_razao,:cliente_cnpj,:cliente_ie,:cliente_cpf,:cliente_rg,:cliente_endereco,:cliente_numero,:cliente_complemento,:cliente_bairro,:cliente_municipio,:cliente_uf,:cliente_cep,:cliente_telefone,:cliente_telefone_comercial,:cliente_celular,:cliente_outros,:cliente_email,:cliente_site,:cliente_contato,:cliente_contato_email,:cliente_data_cadastro,:cliente_data_atualizado,:cliente_status,:cliente_obs);');

		$adicionar->bindValue(':cliente_nome', $dados['cliente_nome'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_razao', $dados['cliente_razao'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_cnpj', $dados['cliente_cnpj'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_ie', $dados['cliente_ie'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_cpf', $dados['cliente_cpf'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_rg', $dados['cliente_rg'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_endereco', $dados['cliente_endereco'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_numero', $dados['cliente_numero'], PDO::PARAM_INT) ;
		$adicionar->bindValue(':cliente_complemento', $dados['cliente_complemento'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_bairro', $dados['cliente_bairro'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_municipio', $dados['cliente_municipio'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_uf', $dados['cliente_uf'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_cep', $dados['cliente_cep'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_telefone', $dados['cliente_telefone'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_telefone_comercial', $dados['cliente_telefone_comercial'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_celular', $dados['cliente_celular'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_outros', $dados['cliente_outros'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_email', $dados['cliente_email'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_site', $dados['cliente_site'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_contato', $dados['cliente_contato'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_contato_email', $dados['cliente_contato_email'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_status', $dados['cliente_status'], PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_obs', $dados['cliente_obs'], PDO::PARAM_STR) ;


		$data_atual = date("Y/m/d H:i:s");

		$adicionar->bindValue(':cliente_data_cadastro', $data_atual, PDO::PARAM_STR) ;
		$adicionar->bindValue(':cliente_data_atualizado', $data_atual, PDO::PARAM_STR) ;
		
		
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
			$editar = $this->conn->prepare('UPDATE cliente SET cliente_nome=:cliente_nome, cliente_razao=:cliente_razao, cliente_cnpj=:cliente_cnpj, cliente_ie=:cliente_ie, cliente_cpf=:cliente_cpf, cliente_rg=:cliente_rg, cliente_endereco=:cliente_endereco, cliente_numero=:cliente_numero, cliente_complemento=:cliente_complemento, cliente_bairro=:cliente_bairro, cliente_municipio=:cliente_municipio, cliente_uf=:cliente_uf, cliente_cep=:cliente_cep, cliente_telefone=:cliente_telefone, cliente_telefone_comercial=:cliente_telefone_comercial, cliente_celular=:cliente_celular, cliente_outros=:cliente_outros, cliente_email=:cliente_email, cliente_site=:cliente_site, cliente_contato=:cliente_contato, cliente_contato_email=:cliente_contato_email, cliente_status=:cliente_status, cliente_obs=:cliente_obs, cliente_data_atualizado=:cliente_data_atualizado WHERE cliente_id=:cliente_id;');

			$editar->bindValue(':cliente_id', $dados['cliente_id'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_nome', $dados['cliente_nome'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_razao', $dados['cliente_razao'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_cnpj', $dados['cliente_cnpj'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_ie', $dados['cliente_ie'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_cpf', $dados['cliente_cpf'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_rg', $dados['cliente_rg'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_endereco', $dados['cliente_endereco'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_numero', $dados['cliente_numero'], PDO::PARAM_INT) ;
			$editar->bindValue(':cliente_complemento', $dados['cliente_complemento'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_bairro', $dados['cliente_bairro'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_municipio', $dados['cliente_municipio'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_uf', $dados['cliente_uf'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_cep', $dados['cliente_cep'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_telefone', $dados['cliente_telefone'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_telefone_comercial', $dados['cliente_telefone_comercial'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_celular', $dados['cliente_celular'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_outros', $dados['cliente_outros'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_email', $dados['cliente_email'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_site', $dados['cliente_site'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_contato', $dados['cliente_contato'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_contato_email', $dados['cliente_contato_email'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_status', $dados['cliente_status'], PDO::PARAM_STR) ;
			$editar->bindValue(':cliente_obs', $dados['cliente_obs'], PDO::PARAM_STR) ;

			$data_atual = date("Y/m/d H:i:s");

			$editar->bindValue(':cliente_data_atualizado', $data_atual, PDO::PARAM_STR) ;


			return $editar->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function lista100(){
		$listar = $this->conn->prepare('SELECT cliente_id, cliente_nome, cliente_cpf, cliente_telefone, cliente_celular from cliente ORDER BY cliente_id DESC LIMIT 100');
		$listar->execute();
		return $listar->fetchAll();
	}

	public function listar($cliente_id=null){

		if(empty($cliente_id)){
			$listar = $this->conn->prepare('SELECT cliente_id, cliente_nome, cliente_cpf, cliente_telefone, cliente_celular from cliente ORDER BY cliente_id DESC');
			$listar->execute();
			return $listar->fetchAll();
		}else{
			$listar = $this->conn->prepare('SELECT * from cliente WHERE cliente_id=:cliente_id LIMIT 1 ');
			$listar->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT) ;

			$listar->execute();
			return $listar->fetch();
		}

	}

	public function listaNome($cliente_id){

		if(!empty($cliente_id)){

			try{			
				$listarNome = $this->conn->prepare('SELECT cliente_id, cliente_nome, cliente_telefone, cliente_celular from cliente WHERE cliente_id=:cliente_id LIMIT 1 ');	
				$listarNome->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT) ;
				$listarNome->execute();
				return $listarNome->fetch();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}


	public function buscar($cliente_nome){

		if(!empty($cliente_nome)){

			try{			
				$buscar = $this->conn->prepare('SELECT cliente_id, cliente_nome, cliente_cpf, cliente_telefone, cliente_celular from cliente WHERE cliente_nome LIKE :busca OR cliente_id = :busca_id ');	
				
				$buscar_nome = '%'.$cliente_nome.'%';

				$buscar->bindValue(':busca', $buscar_nome, PDO::PARAM_STR) ;
				$buscar->bindValue(':busca_id', $cliente_nome, PDO::PARAM_INT) ;
				$buscar->execute();
				return $buscar->fetchALL();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}

	public function contar(){
		try {
			$contar = $this->conn->prepare("SELECT cliente_id from cliente ");
			$contar->execute();
			return $contar->rowCount();

		} catch (PDOException $e) {
			echo $e->getMessage();	
		}
	}


	public function excluir($cliente_id){
		$excluir = $this->conn->prepare('DELETE from cliente WHERE cliente_id=:cliente_id;');

		$excluir->bindValue(':cliente_id', $cliente_id, PDO::PARAM_INT);

		return $excluir->execute();
	}


	public function url($cliente_titulo){
		$url = strtolower($cliente_titulo);
		$url = preg_replace('/[^a-z0-9]\ -/', '', $url);
		$url = preg_replace('/[ ]/', '_', $url);
		return $url;
	}
}