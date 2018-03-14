<?php 
include ROOT.DS."_modulos".DS."os".DS."view".DS."menu.php";
?>
<div class="row">
<div class="col-sm-12">
	<h3>&nbsp;&nbsp;Valor Total: R$<?php echo number_format($total, 2, ',','.');?><br><br></h3>
</div>


	<div class="col-sm-12">
		<form action="" method="POST">
		<div class="form-group col-sm-3" id="divformapagamento">
		<select id="pagamento_id" name="pagamento_id" class="form-control" >
			<?php foreach ($pagamentos as $pagamento) {
				echo '<option value="'.$pagamento['pagamento_id'].'">'.$pagamento['pagamento_nome'].'</option>';
			}?>
		</select>
		</div>


		<div class="form-group col-sm-3">
			<input type="text" class="form-control" value="<?php echo date("d/m/Y") ?>" autocomplete="off" id="pagamento_data" name="pagamento_data">
		</div>

		<div class="col-sm-3"  id="divvalorpagamento">
			<div class="form-group input-group">
				<span class="input-group-addon">R$</span>
				<input type="text" class="form-control selecionaTudo" id="pagamento_valor" value="<?php echo number_format($total, 2, ',','.');?>" name="pagamento_valor" autocomplete="off" value="0,00">
			</div>
		</div>

		<div class="col-sm-1">
			<div class="form-group input-group">
				<button type="submit" class="btn btn-success btn-block" <?php if($os['os_status'] == "Cancelado"){echo "disabled";}?>><i class="fa fa-plus-circle"></i></button>
			</div>
		</div>

		</form>

		<div id="pagou">
			<table class="table table-hover">
				<tbody>
					<?php foreach($pedido_pagamentos as $pedido_pagamento){?>
					<tr>
						<td><?php echo $pedido_pagamento[1]?></td>
						<td><?php echo date_format(date_create($pedido_pagamento[4]), "d/m/Y")?></td>
						<td>R$ <?php echo number_format($pedido_pagamento[2], 2, ',', '.')?></td>
						<td align="right"><button class="btn btn-xs btn-danger pagamentoExcluir" <?php if($os['os_status'] == "Cancelado"){echo "disabled";}?> id="del<?php echo $pedido_pagamento[0]?>"><i class="fa fa-ban"></i></button></td>
					</tr>
					<?php };?>
				</tbody>
			</table>
		</div>

		
	</div>

</div>

<?php
$scriptsJS .= '<script src="'.$url.'_plugins/jquery.maskMoney.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_plugins/select2/select2.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/js/bootstrap-datepicker.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/locales/bootstrap-datepicker.pt-BR.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/os/view/js/pagamentos.js"></script>';
?>