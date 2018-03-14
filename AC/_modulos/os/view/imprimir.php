<div class="row">
	<div class="col-sm-6">
		<h1><?php echo $empresa['empresa_nome'];?></h1>
		<p><b><?php echo $empresa['empresa_site'];?></b><br>
	</div>
	<div class="col-sm-6 text-right">
		<h4>ORDEM DE SERVIÇO</h4>
		<h3>#<?php echo str_pad($os["os_id"], 5, "0",STR_PAD_LEFT);?></h3>
		<p><b><?php echo date_format(date_create($os['os_data']), "d/m/Y H:i:s")?></b></p>
	</div>
</div>

<div class="row">
	<hr>
	<div class="col-sm-12">
		<?php if($cliente['cliente_id'] > 0 ){?>
		<p><b>Cliente: </b><?php echo $cliente['cliente_nome']?> <b> Fone:</b> <?php echo $cliente['cliente_telefone'].' - '.$cliente['cliente_celular']?></p>
    	<p><b>Endereço:</b><?php echo $cliente['cliente_endereco'].', '.$cliente['cliente_numero']?> - <?php echo $cliente['cliente_complemento']?>
    	<?php echo $cliente['cliente_bairro']?> - <?php echo $cliente['cliente_municipio']?> - <?php echo $cliente['cliente_uf']?></p>    	    	
        <?php };?>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 table-responsive">	
	<table class="table table-striped">
		<tr>
			<td><b>Cod</b></td>
			<td><b>Produto</b></td>
			<td><b>Quantidade</b></td>
			<td><b>Unitario</b></td>
			<td align="right"><b>Total</b></td>
		</tr>
		<?php foreach($pedido_produtos as $produto){?>
			<tr>
				<td><?php echo $produto[0];?></td>
				<td><?php echo $produto['produto_nome'];?></td>
				<td><?php echo $produto['produto_quantidade'];?></td>
				<td><?php echo "R$ ".number_format($produto['produto_preco'], 2, ',','.');?></td>
				<td align="right"><?php echo "R$ ".number_format($produto['produto_preco']*$produto['produto_quantidade'], 2, ',','.');?></td>
			</tr>
		<?php };?>
		</table>

	</div>
</div>


<div class="row">
	<hr>
	<div class="col-sm-12 text-center">
		<p>
		<?php echo $empresa['empresa_endereco'].", ".$empresa['empresa_numero']." ".$empresa['empresa_bairro'].", ".$empresa['empresa_municipio']." - ".$empresa['empresa_uf'];?>
		
		<br><?php echo $empresa['empresa_telefone'].' / '.$empresa['empresa_telefone'];?>
		</p>
	</div>
</div>