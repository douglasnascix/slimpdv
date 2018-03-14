<?php
class PagamentoSession{

	public $conn;

	public function __construct(Config $config){

		$this->conn = $config->conn();
	}



	public function add($id, $valor,$parcela){

		if(isset($_SESSION['pagamento'][$id])){
			$_SESSION['pagamento'][$id] = array( 
				"valor" => $_SESSION['pagamento'][$id]['valor'] + $valor,
				"parcela" => $parcela,
    	    );
		}else{
			$_SESSION['pagamento'][$id] = array( 
				"valor" => $valor,
				"parcela" => $parcela,
    	    );
		}
		
	}
	
	
	public function del($id){
		unset($_SESSION['pagamento'][$id]);
		if (count($_SESSION['pagamento']) == 0) {
			unset($_SESSION['pagamento']);
		}
	}

	public function limpa_tudo(){
		unset($_SESSION['pagamento']);
	}

}

?>