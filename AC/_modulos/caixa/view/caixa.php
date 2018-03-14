<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Caixa Fechado</h4>
		</div>
		<div class="modal-body">				
			<form action="<?php echo $url; ?>caixa/caixa/" method="POST">
				<p>Informe o valor para abrir o caixa </p>
				<div class="col-sm-6">
					<div class="col-sm-12 form-group input-group">
						<span class="input-group-addon">R$</span>
						<input type="text" name="valorAbreCaixa" id="valorAbreCaixa" class="form-control" autocomplete="off" required="required">
					</div>
				</div>
				<div class="col-sm-6">
					<input type="submit" value="Abrir Caixa" class="btn btn-success">
				</div>
			</form>
			<div class="clearfix"></div>
		</div>
		<div class="modal-footer">
		</div>
	</div>
</div>
<?php

$scriptsJS .= '<script src="'.$url.'_plugins/jquery.maskMoney.min.js"></script>';
$scriptsJS .= "<script>$('#valorAbreCaixa').maskMoney({thousands:'.', decimal:',', allowZero:true});</script>";

?>