<?php
class Caixa{
	
	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}

	public function verificaStatusCaixa(){
		$data_atual = date('Y-m-d');

		$verifica_caixa = $this->conn->prepare("SELECT caixa_status FROM caixa WHERE caixa_data BETWEEN :data_ini and :data_end and caixa_status != 'Sangria' and caixa_status != 'Suprimento'  ORDER BY caixa_data DESC LIMIT 1");
		$verifica_caixa->bindValue(':data_ini', $data_atual.' 00:00:00');
		$verifica_caixa->bindValue(':data_end', $data_atual.' 23:59:59');
		$verifica_caixa->execute();
		$resultado = $verifica_caixa->fetch();

		if($resultado['caixa_status'] == 'Aberto'){
			return 'Aberto';
		}else{
			return 'Fechado';
		}
	}

	public function abrirCaixa($dados){

		$abrir = $this->conn->prepare('INSERT INTO caixa (caixa_data, caixa_valor, caixa_status) VALUES (:caixa_data, :caixa_valor, :caixa_status)');
			
		$abrir->bindValue(':caixa_data', $dados["caixa_data"], PDO::PARAM_STR);
		$abrir->bindValue(':caixa_valor', $dados["caixa_valor"], PDO::PARAM_STR);
		$abrir->bindValue(':caixa_status', $dados["caixa_status"], PDO::PARAM_STR);	

		return $abrir->execute();

	}

	public function sangriaSuprimento($dados){

		$sangriaSuprimento = $this->conn->prepare('INSERT INTO caixa (caixa_data, caixa_valor, caixa_status, caixa_obs) VALUES (:caixa_data, :caixa_valor, :caixa_status, :caixa_obs)');

		$sangriaSuprimento->bindValue(':caixa_data', $dados["caixa_data"], PDO::PARAM_STR);
		$sangriaSuprimento->bindValue(':caixa_valor', $dados["caixa_valor"], PDO::PARAM_STR);
		$sangriaSuprimento->bindValue(':caixa_status', $dados["caixa_status"], PDO::PARAM_STR);
		$sangriaSuprimento->bindValue(':caixa_obs', $dados["caixa_obs"], PDO::PARAM_STR);

		return $sangriaSuprimento->execute();

	}

	public function fecharCaixa($dados){
		$fechar = $this->conn->prepare('INSERT INTO caixa (caixa_data, caixa_valor, caixa_status) VALUES (:caixa_data, :caixa_valor, :caixa_status)');
			
		$fechar->bindValue(':caixa_data', $dados["caixa_data"], PDO::PARAM_STR);
		$fechar->bindValue(':caixa_valor', $dados["caixa_valor"], PDO::PARAM_STR);
		$fechar->bindValue(':caixa_status', $dados["caixa_status"], PDO::PARAM_STR);	

		return $fechar->execute();
	}


	public function listarMovimentacao($dados = NULL){
		if(is_null($dados)){
			$dados['data'] = date('Y-m-d');
		}

		$listarMovimentacao = $this->conn->prepare("SELECT caixa_status, SUM(caixa_valor) as caixa_total FROM caixa WHERE caixa_data BETWEEN :data_ini AND :data_end and caixa_status != 'Aberto' and caixa_status != 'Fechado' GROUP BY caixa_status");
		$listarMovimentacao->bindValue(':data_ini', $dados['data'].' 00:00:00');
		$listarMovimentacao->bindValue(':data_end', $dados['data'].' 23:59:59');
		$listarMovimentacao->execute();
		return $listarMovimentacao->fetchAll();
	}

	public function listarRecebimentos($dados = NULL){
		if(is_null($dados)){
			$dados['data'] = date('Y-m-d');
		}

		$listarRecebimentos = $this->conn->prepare("SELECT pagamento_nome, SUM(pedido_pagamento_valor) AS pagamento_valor FROM pedido_pagamento INNER JOIN pedido ON (pedido_pagamento.pedido_id=pedido.pedido_id) INNER JOIN pagamento ON (pedido_pagamento.pagamento_id=pagamento.pagamento_id) WHERE pedido_data BETWEEN :data_ini AND :data_end AND pedido_status = 'Venda' GROUP BY pagamento_nome");
		$listarRecebimentos->bindValue(':data_ini', $dados['data'].' 00:00:00');
		$listarRecebimentos->bindValue(':data_end', $dados['data'].' 23:59:59');
		$listarRecebimentos->execute();
		return $listarRecebimentos->fetchAll();
	}


	public function valorAberturaCaixa($dados = NULL){
		if(is_null($dados)){
			$dados['data'] = date('Y-m-d');
		}

		$valorAberturaCaixa = $this->conn->prepare("SELECT caixa_data, caixa_status, caixa_valor FROM caixa WHERE caixa_data BETWEEN :data_ini and :data_end and caixa_status != 'Sangria' and caixa_status != 'Suprimento'  ORDER BY caixa_data DESC LIMIT 1");
		$valorAberturaCaixa->bindValue(':data_ini', $dados['data'].' 00:00:00');
		$valorAberturaCaixa->bindValue(':data_end', $dados['data'].' 23:59:59');
		$valorAberturaCaixa->execute();
		return $valorAberturaCaixa->fetch();	
	}

	public function relatorio($dados){
		try {
			$verifica_caixa = $this->conn->prepare("SELECT * FROM caixa WHERE caixa_data BETWEEN :data_ini and :data_end ORDER BY caixa_data ASC");
			$verifica_caixa->bindValue(':data_ini', $dados['data_ini'].' 00:00:00');
			$verifica_caixa->bindValue(':data_end', $dados['data_fim'].' 23:59:59');
			$verifica_caixa->execute();
			return $verifica_caixa->fetchAll();	
		} catch (PDOException $e) {
			return $e;
		}

		
	}
}