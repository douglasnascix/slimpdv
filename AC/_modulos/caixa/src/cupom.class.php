<?php

class Cupom{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}


	public function criar($pedido_id, $cupom_xml, $valorTotalCFe, $CPFCNPJValue, $status, $mensagem){
		try {
			
			$criar = $this->conn->prepare('INSERT INTO cupom (cupom_status, mensagem, pedido_id, cupom_xml, valorTotalCFe, CPFCNPJValue, cupom.timeStamp) VALUES (:cupom_status, :mensagem, :pedido_id, :cupom_xml, :valorTotalCFe, :CPFCNPJValue, :data_cupom)');
			
			
			$criar->bindValue(':cupom_status', $status, PDO::PARAM_STR);
			$criar->bindValue(':mensagem', $mensagem, PDO::PARAM_STR);
			$criar->bindValue(':data_cupom', date("Y-m-d H:i:s"), PDO::PARAM_STR);
			$criar->bindValue(':cupom_xml', $cupom_xml, PDO::PARAM_STR);
			$criar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);			
			$criar->bindValue(':valorTotalCFe', $valorTotalCFe, PDO::PARAM_STR);
			$criar->bindValue(':CPFCNPJValue', $CPFCNPJValue, PDO::PARAM_STR);

			return $criar->execute();

		}catch(PDOException $e) {
			echo $e->message;
		}

	}

	public function atualizar($pedido_id, $cupom_xml, $valorTotalCFe, $CPFCNPJValue, $status, $mensagem){
		try {
			
			$criar = $this->conn->prepare('UPDATE cupom SET cupom_status=:cupom_status, mensagem=:mensagem, cupom_xml=:cupom_xml, valorTotalCFe=:valorTotalCFe, CPFCNPJValue=:CPFCNPJValue, cupom.timeStamp=:data_cupom WHERE pedido_id=:pedido_id');
			
			
			$criar->bindValue(':cupom_status', $status, PDO::PARAM_STR);
			$criar->bindValue(':mensagem', $mensagem, PDO::PARAM_STR);
			$criar->bindValue(':data_cupom', date("Y-m-d H:i:s"), PDO::PARAM_STR);
			$criar->bindValue(':cupom_xml', $cupom_xml, PDO::PARAM_STR);
			$criar->bindValue(':pedido_id', $pedido_id, PDO::PARAM_INT);			
			$criar->bindValue(':valorTotalCFe', $valorTotalCFe, PDO::PARAM_STR);
			$criar->bindValue(':CPFCNPJValue', $CPFCNPJValue, PDO::PARAM_STR);

			return $criar->execute();

		}catch(PDOException $e) {
			echo $e->message;
		}

	}


	public function cancelar($chaveConsulta, $cupom_xml){
		try {

			$cancelar = $this->conn->prepare('UPDATE cupom SET cupom_status=:cupom_status, cupom_xml=:cupom_xml WHERE chaveConsulta=:chaveConsulta');
			$cancelar->bindValue(':cupom_status', "Cancelar", PDO::PARAM_STR);
			$cancelar->bindValue(':cupom_xml', $cupom_xml, PDO::PARAM_STR);
			$cancelar->bindValue(':chaveConsulta', $chaveConsulta, PDO::PARAM_STR);

			return $cancelar->execute();
			
		} catch (PDOException $e) {
			echo $e->message;
		}
	}

	public function lastInsertId($name = NULL) {
	    if(!$this->conn) {
	        throw new Exception('not connected');
	    }

	    return $this->conn->lastInsertId($name);
	}

	public function imprimir($chaveConsulta){
		try {

			$imprimir = $this->conn->prepare('UPDATE cupom SET cupom_status=:cupom_status WHERE chaveConsulta=:chaveConsulta');
			$imprimir->bindValue(':cupom_status', "Imprimir", PDO::PARAM_STR);
			$imprimir->bindValue(':chaveConsulta', $chaveConsulta, PDO::PARAM_STR);

			return $imprimir->execute();
			
		} catch (PDOException $e) {
			echo $e->message;
		}
	}

}?>