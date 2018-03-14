<h3 class="page-header">Pedidos / Visualizar</h3>

<div class="pedido">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Dados do Pedido</b></div>
			<div class="panel-body">
				<div class="col-sm-2">
					<span>Pedido ID</span>
					<h2><?php echo $pedidos['pedido_id'];?></h2>
				</div>

				<div class="col-sm-3">
					<span>Data</span>
					<?php echo date_format(date_create($pedidos['pedido_data']), "d/m/Y H:i:s"); ?>
				</div>

				<div class="col-sm-8">
					<span>Cliente</span>
					<?php echo $pedidos['cliente_id']." - ".$pedidos['cliente_nome']; ?>
				</div>

			</div>
		</div>
	</div>

	<div class="col-sm-12 table-responsive">	
		<table class="table table-striped">
			<tr>
				<td><b>ID</b></td>	
				<td><b>Produto</b></td>
				<td><b>Quantidade</b></td>
				<td><b>Unitario</b></td>
				<td align="right"><b>Total</b></td>
			</tr>
			<?php foreach($produtos as $produto){?>
				<tr>
					<td><?php echo $produto['produto_id'];?></td>
					<td><?php echo $produto['produto_nome'];?></td>
					<td><?php echo $produto['produto_quantidade'];?></td>
					<td><?php echo "R$ ".number_format($produto['produto_preco'], 2, ',','.');?></td>
					<td align="right"><?php echo "R$ ".number_format($produto['produto_preco']*$produto['produto_quantidade'], 2, ',','.');?></td>
				</tr>
			<?php };?>
			</table>
			<div class="text-right">
				<div><p><b>Subtotal</b> <?php echo "R$ ".number_format($pedidos['pedido_valor'] + $pedidos['pedido_desconto'] - $pedidos['pedido_acrescimo'], 2, ',','.') ?></p></div>

				<?php if($pedidos['pedido_desconto'] > 0){?>
				<div><p><b>Desconto</b> <?php echo "R$ ".number_format($pedidos['pedido_desconto'], 2, ',','.') ?></p></div>
				<?php };?>

				<?php if($pedidos['pedido_acrescimo'] > 0){?>
				<div><p><b>Acrescimo</b> <?php echo "R$ ".number_format($pedidos['pedido_acrescimo'], 2, ',','.') ?></p></div>
				<?php };?>

				<div><h2>Total <?php echo "R$ ".number_format($pedidos['pedido_valor'], 2, ',','.') ?></h2></div>
			</div>

			<div class="print">
				
			</div>
		</div>	

	</div>