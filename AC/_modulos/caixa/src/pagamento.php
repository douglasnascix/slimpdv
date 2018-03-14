<?php
session_start();
include "../../../config/config.php";
include "../../caixa/src/pagamento.class.php";
include "../../pagamento/src/pagamentos.class.php";

$pagamento = new PagamentoSession(new Config());
$pagamentoOBJ = new Pagamento(new Config());


//total no session
function calculaTotal(){	
	$total = 0;
	if(isset($_SESSION["pagamento"])){
	foreach ($_SESSION["pagamento"] as $produto => $valor) {
		$total += $valor["valor"];
	}
		$_SESSION['totalRecebido'] = $total; 
	}else{
		$_SESSION['totalRecebido'] = 0; 
	}
}


if(isset($_GET['acao'])){

	$acao = $_GET['acao'];

	if(isset($_GET['id'])){$id = $_GET['id'];};
	if(isset($_GET['valor'])){$valor = $_GET['valor'];};
	if(isset($_GET['parcela'])){$parcela = $_GET['parcela'];};
	

	if($acao == "add"){
		$pagamento->add($id, $valor, $parcela);
		calculaTotal();
	}

	if($acao == "del"){
		$pagamento->del($id);
		calculaTotal();
	}

	if($acao == "limpar"){
		unset($_SESSION['pagamento']);
		calculaTotal();
	}

	if($acao == "cancela_item"){
		$pagamento->cancela_item($id);
		calculaTotal();
	}

	if($acao == "limpa_tudo"){
			$pagamento->limpa_tudo();
			calculaTotal();
	}

}



	if(isset($_SESSION['pagamento'])){

		echo '<div class="col-sm-12">
		<input type="hidden" name="totalPago" id="totalPago" value="'.number_format($_SESSION['totalRecebido'],'2',',','.').'">
		<table class="table table-hover">
				<tbody>';
		foreach ($_SESSION['pagamento'] as $pagou => $valor) {
			$pagamentoAtivo = $pagamentoOBJ->listaNome($pagou);
?>
			<tr>
				<td><?php echo $pagamentoAtivo['pagamento_nome'];?></td>
				<td>R$ <?php echo number_format($valor['valor'], 2, ',', '.');?></td>
				<?php if($valor['parcela'] > 1){
					echo '<td>Em '.$valor['parcela'].'x</td>';
				}?>
			</tr>

<?php 
		}
		echo '</tbody></table>
		</div>';
	}else{
		echo '<input type="hidden" name="totalPago" id="totalPago" value="0">';
	}
?>