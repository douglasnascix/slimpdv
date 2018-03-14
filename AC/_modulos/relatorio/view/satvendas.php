<h3 class="page-header">Relatório / Sat</h3>

<form action="<?php echo $url;?>relatorio/satvendas/" method="POST">
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Gerar Relatório</b></div>
		<div class="panel-body">
			<div class="form-group col-sm-3">
				<label for="ano">Ano</label>
				<select name="ano" id="ano" class="form-control">
					<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
					<option value="<?php echo $_POST['ano'] - 1;?>" <?php if($_POST['ano'] == $_POST['ano'] - 1){echo "Selected";}?>><?php echo $_POST['ano'] - 1;?></option>
					<option value="<?php echo $_POST['ano'];?>" <?php if($_POST['ano'] == $_POST['ano']){echo "Selected";}?> ><?php echo $_POST['ano'];?></option>
					<option value="<?php echo $_POST['ano'] + 1;?>" <?php if($_POST['ano'] == $_POST['ano'] + 1){echo "Selected";}?>><?php echo $_POST['ano'] + 1;?></option>
					<?php }else{?>
					<option value="<?php echo date("Y") - 1;?>" <?php if(date("Y") == date("Y") - 1){echo "Selected";}?>><?php echo date("Y") - 1;?></option>
					<option value="<?php echo date("Y");?>" <?php if(date("Y") == date("Y")){echo "Selected";}?> ><?php echo date("Y");?></option>
					<option value="<?php echo date("Y") + 1;?>" <?php if(date("Y") == date("Y") + 1){echo "Selected";}?>><?php echo date("Y") + 1;?></option>
					<?php };?>
				</select>
			</div>

			<div class="form-group col-sm-3">
				<label for="sat_cod_ativacao">Mês</label>
				<select name="mes" id="mes" class="form-control">
					<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
					<option value="1" <?php if($_POST['mes'] == 1){echo "Selected";}?>>Janeiro</option>
					<option value="2" <?php if($_POST['mes'] == 2){echo "Selected";}?>>Fevereiro</option>
					<option value="3" <?php if($_POST['mes'] == 3){echo "Selected";}?>>Março</option>
					<option value="4" <?php if($_POST['mes'] == 4){echo "Selected";}?>>Abril</option>
					<option value="5" <?php if($_POST['mes'] == 5){echo "Selected";}?>>Maio</option>
					<option value="6" <?php if($_POST['mes'] == 6){echo "Selected";}?>>Junho</option>
					<option value="7" <?php if($_POST['mes'] == 7){echo "Selected";}?>>Julho</option>
					<option value="8" <?php if($_POST['mes'] == 8){echo "Selected";}?>>Agosto</option>
					<option value="9" <?php if($_POST['mes'] == 9){echo "Selected";}?>>Setembro</option>
					<option value="10" <?php if($_POST['mes'] == 10){echo "Selected";}?>>Outubro</option>
					<option value="11" <?php if($_POST['mes'] == 11){echo "Selected";}?>>Novembro</option>
					<option value="12" <?php if($_POST['mes'] == 12){echo "Selected";}?>>Dezembro</option>

					<?php }else{?>

					<option value="1" <?php if(date("m") == 1){echo "Selected";}?>>Janeiro</option>
					<option value="2" <?php if(date("m") == 2){echo "Selected";}?>>Fevereiro</option>
					<option value="3" <?php if(date("m") == 3){echo "Selected";}?>>Março</option>
					<option value="4" <?php if(date("m") == 4){echo "Selected";}?>>Abril</option>
					<option value="5" <?php if(date("m") == 5){echo "Selected";}?>>Maio</option>
					<option value="6" <?php if(date("m") == 6){echo "Selected";}?>>Junho</option>
					<option value="7" <?php if(date("m") == 7){echo "Selected";}?>>Julho</option>
					<option value="8" <?php if(date("m") == 8){echo "Selected";}?>>Agosto</option>
					<option value="9" <?php if(date("m") == 9){echo "Selected";}?>>Setembro</option>
					<option value="10" <?php if(date("m") == 10){echo "Selected";}?>>Outubro</option>
					<option value="11" <?php if(date("m") == 11){echo "Selected";}?>>Novembro</option>
					<option value="12" <?php if(date("m") == 12){echo "Selected";}?>>Dezembro</option>
					<?php };?>

				</select>
			</div>

			<div class="form-group col-sm-2">
				<label for="gerar">&nbsp;</label>
				<button type="submit" class="form-control btn btn-success"> Gerar </button>
			</div>	

			<?php if($empresa['empresa_email_contabilidade'] != ""){?>
			<div class="form-group col-sm-3">
				<label for="sat_cod_ativacao">&nbsp;</label>
				<button type="button" id="contabilidade" class="form-control btn btn-primary"> Enviar p/ Contabilidade </button>
			</div>
			<?php };?>
		</div>
	</div>
</div>
</form>		

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Relatório</b></div>
			<div class="panel-body">		
	
				<div class="table-responsive" style="max-height:500px;overflow:auto;">
					<table class="table">
						<thead>
							<tr>
								<th>Chave Consulta</th>
								<th>Status</th>
								<th>Data</th>
								<th>Valor</th>								
							</tr>
						</thead>
						<tbody>
							<?php
							$totalGeral =0;
							foreach ($cupoms as $cupom) {

							switch($cupom['cupom_status']){
								case 'Falha':
									$status_cor = 'class="bg-warning"';
									$status_btn = '<a class="btn btn-primary" data-toggle="tooltip" title="'.$cupom['cupom_status'].' | '.$cupom['EEEEE'].' | '.$cupom['CCCC'].' | '.$cupom['mensagem'].'"><i class="fa fa-info"></i></a>';
									break;
								case 'Emitido':
									$status_cor = 'class="bg-success"';
									$status_btn = '<a href="'.$url.'_modulos/caixa/src/sat.php?acao=imprimir&chaveConsulta='.$cupom['chaveConsulta'].'" class="btn btn-default"><i class="fa fa-print"></i></a> ';
									break;
								case 'Cancelado':
									$status_cor = 'class="bg-danger"';
									$status_btn = '';
									break;
								default:
									$status_cor = '';
									$status_btn = '';

							};

							?>
							
							<tr>
								<td><?php if($cupom['chaveConsulta'] != "0"){echo $cupom['chaveConsulta'];}?></td>
								<td><?php echo $cupom['cupom_status'];?></td>
								<td><?php echo date_format(date_create($cupom['timeStamp']), "d/m/Y H:i:s");?></td>
								<td>R$ <?php echo number_format($cupom['valorTotalCFe'], 2, ',', '.') ?></td>
								<?php $totalGeral += $cupom['valorTotalCFe']?>
							</tr>
							<?php };?>
						</tbody>
					</table>
					<p class="text-right"><?php echo number_format($totalGeral, 2, ',', '.') ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
	


<?php
$scriptsJS .= '<script src="'.$url.'view/js/bootstrap-datepicker.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/locales/bootstrap-datepicker.pt-BR.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/relatorio/view/js/sat.js"></script>';
?>