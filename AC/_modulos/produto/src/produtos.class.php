<?php

class Produto{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function adicionar($dados){
	try {
		$adicionar = $this->conn->prepare('INSERT INTO produto (produto_nome, produto_codBarras, produto_categoria, produto_marca, produto_custo, produto_preco, produto_estoque,  produto_estoque_min, produto_unidade, produto_cfop, produto_csosn, produto_ncm, produto_cst, produto_cest, produto_data_cadastro, produto_data_atualizado) VALUES (:produto_nome, :produto_codBarras, :produto_categoria, :produto_marca, :produto_custo, :produto_preco, :produto_estoque, :produto_estoque_min, :produto_unidade, :produto_cfop, :produto_csosn, :produto_ncm, :produto_cst, :produto_cest, :produto_data_cadastro, :produto_data_atualizado);');

		$adicionar->bindValue(':produto_nome', $dados['produto_nome'], PDO::PARAM_STR);
		$adicionar->bindValue(':produto_codBarras', $dados['produto_codBarras'], PDO::PARAM_STR);
		$adicionar->bindValue(':produto_categoria', $dados['produto_categoria'], PDO::PARAM_INT);
		$adicionar->bindValue(':produto_marca', $dados['produto_marca'], PDO::PARAM_INT);
		$adicionar->bindValue(':produto_custo', $dados['produto_custo'], PDO::PARAM_STR);
		$adicionar->bindValue(':produto_preco', $dados['produto_preco'], PDO::PARAM_STR);
		$adicionar->bindValue(':produto_estoque', $dados['produto_estoque'], PDO::PARAM_INT);
		$adicionar->bindValue(':produto_estoque_min', $dados['produto_estoque_min'], PDO::PARAM_INT);
		$adicionar->bindValue(':produto_unidade', $dados['produto_unidade'], PDO::PARAM_STR);
		$adicionar->bindValue(':produto_cfop', $dados['produto_cfop'], PDO::PARAM_INT);
		$adicionar->bindValue(':produto_csosn', $dados['produto_csosn'], PDO::PARAM_INT);
		$adicionar->bindValue(':produto_ncm', $dados['produto_ncm'], PDO::PARAM_INT);
		$adicionar->bindValue(':produto_cst', $dados['produto_cst'], PDO::PARAM_INT);
		$adicionar->bindValue(':produto_cest', $dados['produto_cest'], PDO::PARAM_INT);
		
		$data_atual = date("Y/m/d H:i:s");

		$adicionar->bindValue(':produto_data_cadastro', $data_atual, PDO::PARAM_STR) ;
		$adicionar->bindValue(':produto_data_atualizado', $data_atual, PDO::PARAM_STR) ;
		
		
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
			$editar = $this->conn->prepare('UPDATE produto SET produto_nome = :produto_nome, produto_codBarras = :produto_codBarras, produto_categoria = :produto_categoria, produto_marca = :produto_marca, produto_custo = :produto_custo, produto_preco = :produto_preco, produto_estoque = :produto_estoque, produto_estoque_min = :produto_estoque_min, produto_unidade = :produto_unidade, produto_cfop = :produto_cfop, produto_csosn = :produto_csosn, produto_ncm = :produto_ncm, produto_cst = :produto_cst, produto_cest = :produto_cest, produto_data_atualizado = :produto_data_atualizado WHERE produto_id=:produto_id;');

			$editar->bindValue(':produto_id', $dados['produto_id'], PDO::PARAM_INT);
			$editar->bindValue(':produto_nome', $dados['produto_nome'], PDO::PARAM_STR);
			$editar->bindValue(':produto_codBarras', $dados['produto_codBarras'], PDO::PARAM_INT);
			$editar->bindValue(':produto_categoria', $dados['produto_categoria'], PDO::PARAM_INT);
			$editar->bindValue(':produto_marca', $dados['produto_marca'], PDO::PARAM_INT);
			$editar->bindValue(':produto_custo', $dados['produto_custo'], PDO::PARAM_STR);
			$editar->bindValue(':produto_preco', $dados['produto_preco'], PDO::PARAM_STR);
			$editar->bindValue(':produto_estoque', $dados['produto_estoque'], PDO::PARAM_INT);
			$editar->bindValue(':produto_estoque_min', $dados['produto_estoque_min'], PDO::PARAM_INT);
			$editar->bindValue(':produto_unidade', $dados['produto_unidade'], PDO::PARAM_STR);
			$editar->bindValue(':produto_cfop', $dados['produto_cfop'], PDO::PARAM_INT);
			$editar->bindValue(':produto_csosn', $dados['produto_csosn'], PDO::PARAM_INT);
			$editar->bindValue(':produto_ncm', $dados['produto_ncm'], PDO::PARAM_INT);
			$editar->bindValue(':produto_cst', $dados['produto_cst'], PDO::PARAM_INT);
			$editar->bindValue(':produto_cest', $dados['produto_cest'], PDO::PARAM_INT);

			$data_atual = date("Y/m/d H:i:s");

			$editar->bindValue(':produto_data_atualizado', $data_atual, PDO::PARAM_STR) ;


			return $editar->execute();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		};
	}


	public function listar($produto_id=null){

		if(empty($produto_id)){
			$listar = $this->conn->prepare('SELECT * from produto ORDER BY produto_id DESC');
			//$listar = $this->conn->prepare('SELECT produto_id, produto_nome, produto_preco from produto ORDER BY produto_id DESC');	
			$listar->execute();
			return $listar->fetchAll();
		}else{
			$listar = $this->conn->prepare('SELECT * from produto WHERE produto_id=:produto_id or produto_codBarras=:busca_codBarras LIMIT 1 ');
			$listar->bindValue(':produto_id', $produto_id, PDO::PARAM_INT) ;
			$listar->bindValue(':busca_codBarras', $produto_id, PDO::PARAM_STR) ;

			$listar->execute();
			return $listar->fetch();
		}

	}

	public function listaNome($produto_id){

		if(!empty($produto_id)){

			try{			
				$listarNome = $this->conn->prepare('SELECT produto_id, produto_nome from produto WHERE produto_id=:produto_id  LIMIT 1 ');	
				$listarNome->bindValue(':produto_id', $produto_id, PDO::PARAM_INT) ;
				$listarNome->execute();
				return $listarNome->fetch();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}

	public function produtoncm(){

		try{
			$produtoncm = $this->conn->prepare('SELECT produto_id, produto_nome, produto_preco from produto WHERE produto_ncm = 0 ');	
			$produtoncm->execute();
			return $produtoncm->fetchALL();
		}catch(PDOException $e){ 
			echo $e->getMessage();
		}

	}

	public function produtocategoria($categoria_id){

		if(!empty($categoria_id)){

			try{			
				$produtocategoria = $this->conn->prepare('SELECT produto_id, produto_nome, produto_preco from produto WHERE produto_categoria=:categoria_id');	
				$produtocategoria->bindValue(':categoria_id', $categoria_id, PDO::PARAM_INT) ;
				$produtocategoria->execute();
				return $produtocategoria->fetchAll();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}



	public function buscar($produto_nome){

		if(!empty($produto_nome)){

			try{			
				$buscar = $this->conn->prepare('SELECT produto_id, produto_nome, produto_preco from produto WHERE produto_nome LIKE :busca OR produto_id = :busca_id OR produto_codBarras = :busca_codBarras');

				$buscar_nome = '%'.$produto_nome.'%';

				$buscar->bindValue(':busca', $buscar_nome, PDO::PARAM_STR) ;
				$buscar->bindValue(':busca_id', $produto_nome, PDO::PARAM_INT) ;
				$buscar->bindValue(':busca_codBarras', $produto_nome, PDO::PARAM_STR) ;
				$buscar->execute();
				return $buscar->fetchALL();
			}catch(PDOException $e){ 
				echo $e->getMessage();
			}
		}
	}


	public function contar(){
		try {
			$contar = $this->conn->prepare("SELECT produto_id from produto ");
			$contar->execute();
			return $contar->rowCount();

		} catch (PDOException $e) {
			echo $e->getMessage();	
		}
	}


	public function excluir($produto_id){
		$excluir = $this->conn->prepare('DELETE from produto WHERE produto_id=:produto_id;');

		$excluir->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);

		return $excluir->execute();
	}



	public function excluir_foto($produto_id){

		$excluir_foto = $this->conn->prepare('UPDATE produto set produto_imagem = "" WHERE produto_id=:produto_id');

		$excluir_foto->bindValue('produto_id', $produto_id, PDO::PARAM_INT);

		return $excluir_foto->execute();

	}



	public function trata_valor($valor){
		//"1.300,00"
		$ok = str_replace(".", "", $valor);
		//"1300,00"
		$ok = str_replace(",", ".", $ok);
		//"1300.00"
		return $ok;
	}
	

}