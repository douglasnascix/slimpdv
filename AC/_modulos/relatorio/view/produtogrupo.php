<h3 class="page-header">Relatório / Categoria > Produtos</h3>


<?php foreach ($categorias as $categoria) {?>
	<div class="col-sm-12">
		<h3><?php echo $categoria['categoria_nome']?></h3>
		<?php
		$produtos = $produtoOBJ->produtocategoria($categoria['categoria_id']);
		if(count($produtos) > 0){?>
		<table width="100%">	
			<?php foreach ($produtos as $produto){
				echo '
				<tr>
					<td width="5%">'.$produto[0].'</td>
					<td width="85%">'.$produto[1].'</td>
					<td width="10%">R$ '.number_format($produto['produto_preco'], 2, ',', '.').'</td>

					</td>
				</tr>';
			};?>
		</table>
		<?php };?>
	</div>
<?php 
};
?>