<h3 class="page-header">Pedidos / Listar Cancelados</h3>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Cliente</th>
				<th>Valor</th>
				<th>Data</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($pedidos) > 0){
			foreach($pedidos as $pedido){?>
			<tr>
				<td><a href="<?php echo $url."pedido/visualizar/".$pedido['pedido_id'];?>/"><?php echo $pedido['pedido_id'];?></a></td>
				<td><?php $nome = explode(" ", $pedido['cliente_nome']); echo $nome[0];?></td>
				<td>R$ <?php echo number_format($pedido['pedido_valor'], 2, "," , "." )?></td>
				<td><?php echo date_format(date_create($pedido['pedido_data']), "d/m/Y H:i:s" )?></td>
				<td><?php echo $pedido['pedido_status']?></td>
			</tr>
			<?php }};?>
		</tbody>
	</table>
</div>