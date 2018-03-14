<?php 
include ROOT.DS."_modulos".DS."os".DS."view".DS."menu.php";
?>
<div class="row">
<form action="" method="POST">
	<div class="col-sm-6">
		<div class="form-group input-group">
			<select class="form-control" autocomplete="off" autofocus placeholder="Digite o codigo ou descrição do produto" name="produto_id" id="produto_id">
			<option id="0" disabled selected>Selecione o Produto</option>
			<?php foreach ($produtos as $produto) { ?>
				<option id="<?php echo $produto['produto_id']?>"><?php echo $produto['produto_id'].'-'.$produto['produto_nome']?></option>
			<?php }?>
			</select>
			<span class="input-group-addon"><span class="fa fa-barcode"></span></span>
		</div>
	</div>

	<div class="col-sm-2">
		<div class="form-group input-group">
			<input type="number" class="form-control" placeholder="Qtd." name="produto_qtd" id="produto_qtd" value="1">
			<span class="input-group-addon">X</span>
		</div>
	</div>

	<div class="col-sm-3">
		<div class="form-group input-group">
			<span class="input-group-addon">R$</span>
			<input type="text" class="form-control" name="produto_valor" id="produto_valor">
		</div>
	</div>

	<div class="col-sm-1">
		<div class="form-group input-group">
			<button type="submit" class="btn btn-success btn-block" <?php if($os['os_status'] == "Cancelado"){echo "disabled";}?>><i class="fa fa-plus-circle"></i></button>
		</div>
	</div>
</form>
</div>

<div class="col-sm-12">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Produto</th>
				<th>Quantidade</th>
				<th>Valor</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($pedido_produtos as $pedido_produto){?>
			<tr>
				<td><?php echo $pedido_produto['produto_nome']?></td>
				<td><?php echo $pedido_produto['produto_quantidade']?></td>
				<td>R$ <?php echo number_format($pedido_produto['produto_preco'], 2, ',', '.')?></td>
				<td align="right"><button class="btn btn-xs btn-danger pecasExcluir" <?php if($os['os_status'] == "Cancelado"){echo "disabled";}?> id="<?php echo $pedido_produto['pedido_produto_id'].'_'. $pedido_produto['produto_id'].'_'. $pedido_produto['produto_quantidade']?>"><i class="fa fa-ban"></i></button></td>
			</tr>
			<?php };?>
		</tbody>
	</table>
</div>

<?php
$scriptsJS .= '<script src="'.$url.'_plugins/jquery.maskMoney.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/os/view/js/pecas.js"></script>';
$scriptsJS .= '<script src="'.$url.'_plugins/select2/select2.min.js"></script>';
$scriptsJS .= "<script>
	$(document).ready(function() {
   $(\"#produto_id\").select2({
   	theme: \"bootstrap\"
   });

   $(\"#produto_id\").on(\"select2:select\", function () {
   	buscarProduto();
   })
});
</script>";
?>