<h3 class="page-header">Estoque Baixo</h3>	

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Produto</th>
				<th>Minímo</th>
				<th>Em Estoque</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($estoqueMinimo as $estoque) {?>
			<tr>
				<td><?php echo $estoque['produto_nome'];?></td>
				<td><?php echo $estoque['produto_estoque_min'];?></td>
				<td><?php echo $estoque['produto_estoque'];?></td>
			</tr>
			<?php };?>
		</tbody>
	</table>					
</div>