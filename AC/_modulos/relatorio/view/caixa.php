<h3 class="page-header">Relatório / Caixa</h3>

<form action="<?php echo $url;?>relatorio/caixa/" method="POST">
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Relatório Caixa</b></div>
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
				<button type="submit" class="form-control btn btn-success" name="gerar" id="gerar"> Gerar </button>
			</div>	

		</div>
	</div>
</div>
</form>		
<?php if(isset($_POST['data_ini'])){ ?>
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Relatório Caixa</b></div>
		<div class="panel-body">
<div class="table-responsive" style="background-color: #fff">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>Data</b></td>
				<td><b>Status</b></td>
				<td><b>Valor</b></td>
				<td><b>Obs</b></td>
			</tr>
		</thead>
	<?php 
	
	$total = 0;
	foreach($relatorios as $relatorio){
		echo '
		<tr>
			<td>'.date_format(date_create($relatorio['caixa_data']), "d/m/Y H:i:s").'</td>
			<td>'.$relatorio['caixa_status'].'</td>
			<td>R$ '.number_format($relatorio['caixa_valor'], '2', ',', '.' ).'</td>
			<td>'.$relatorio['caixa_obs'].'</td>
			
		</tr>';

	};?>
	</table>
</div>
</div></div></div></div>

<?php }?>
<?php
$scriptsJS .= '<script src="'.$url.'view/js/bootstrap-datepicker.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/locales/bootstrap-datepicker.pt-BR.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/relatorio/view/js/sat.js"></script>';
?>