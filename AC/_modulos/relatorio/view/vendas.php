<h3 class="page-header">Relatório / Vendas</h3>

<form action="<?php echo $url;?>relatorio/vendas/" method="POST">
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Gerar Relatório</b></div>
		<div class="panel-body">
			<div class="form-group col-sm-3">
				<label for="data_ini">Data inícial</label>
				<input type="text" class="form-control" value="<?php if(isset($_POST['data_ini'])){echo $_POST['data_ini'];}; ?>" autocomplete="off" id="data_ini" name="data_ini">
			</div>

			<div class="form-group col-sm-3">
				<label for="data_fim">Data final</label>
				<input type="text" class="form-control" value="<?php if(isset($_POST['data_fim'])){echo $_POST['data_fim'];}; ?>" autocomplete="off" id="data_fim" name="data_fim">
			</div>

			<div class="form-group col-sm-2">
				<label for="gerar">&nbsp;</label>
				<button type="submit" class="form-control btn btn-success" name="gerar" id="gerear"> Gerar </button>
			</div>	

		</div>
	</div>
</div>
</form>		
<?php if(isset($_POST['data_ini'])){ ?>
<div class="col-sm-12">
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>Pedido</b></td>
				<td><b>Data</b></td>
				<td><b>&nbsp;</b></td>
			</tr>
		</thead>
	<?php 
	
	$total = 0;
	foreach($pedidos as $pedido){
		echo '
		<tr>
			<td>'.$pedido['pedido_id'].'</td>
			<td>'.date_format(date_create($pedido['pedido_data']), "d/m/Y H:i:s").'</td>
			<td>R$ '.number_format($pedido['pedido_valor'], '2', ',', '.' ).'</td>
			
		</tr>';

		$total += $pedido['pedido_valor'];
	};?>
	</table>
</div>
</div>
<div align="center">
<?php foreach ($pagamentos as $pagamento) {
	echo $pagamento['pagamento_nome']. " R$ ".number_format($pagamento['Total'], '2', ',', '.' )." | ";
}?>
Total R$ <?php echo number_format($total, '2', ',', '.' );?></div>
<?php }?>
<?php
$scriptsJS .= '<script src="'.$url.'view/js/bootstrap-datepicker.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/locales/bootstrap-datepicker.pt-BR.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/relatorio/view/js/sat.js"></script>';
?>