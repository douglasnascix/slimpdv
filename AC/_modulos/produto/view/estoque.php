<h3 class="page-header">Catalogo / Produto / Estoque</h3>

<ul class="nav nav-pills" style="margin-bottom:30px;">
  <li role="presentation"><a href="<?php echo $url;?>produto/editar/<?php echo $produto[0];?>/">Dados do Produto</a></li>
  <li role="presentation" class="active"><a href="<?php echo $url;?>produto/estoque/<?php echo $produto[0];?>/">Estoque</a></li>
  <li role="presentation"><a href="<?php echo $url;?>produto/fotos/<?php echo $produto[0];?>/">Fotos</a></li>
</ul>

<form action="<?php echo $url;?>produto/estoque/<?php echo $produto[0];?>/" method="POST" enctype="multipart/form-data" id="form">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b><?php echo $produto[1];?></b></div>
			<div class="panel-body">
				<div class="form-group col-sm-3">
					<input type="hidden" class="form-control" required id="produto_id" name="produto_id" value="<?php echo $produto[0];?>">

					<label for="produto_nome">Cor</label>
					<select name="produto_cor" id="produto_cor" class="form-control ">
						<?php foreach ($cores as $cor) {
							echo '<option value="'.$cor['cor_id'].'" class="capitalize">'. ucwords(strtolower($cor['cor_nome'])).'</option>';
						};?>
					</select>
				</div>
				<div class="form-group col-sm-2">
					<label for="produto_tamanho">Tamanho</label>
					<select name="produto_tamanho" id="produto_tamanho" class="form-control">
						<?php foreach ($tamanhos as $tamanho) {
							echo '<option value="'.$tamanho['tamanho_id'].'" class="capitalize">'.ucwords(strtolower($tamanho['tamanho_nome'])).'</option>';
						};?>
					</select>
				</div>
				<div class="form-group col-sm-3">
					<label for="produto_estoque_min">Estoque Minimo</label>
					<input type="number" class="form-control" autocomplete="off" min="0" required id="produto_estoque_min" name="produto_estoque_min">
				</div>
				<div class="form-group col-sm-3">
					<label for="produto_estoque">Em Estoque</label>
					<input type="number" class="form-control" autocomplete="off" min="0" required id="produto_estoque" name="produto_estoque">
				</div>

				<div class="form-group col-sm-1">
					<label for="">&nbsp;</label>
					<button type="submit" class="form-control btn btn-success"> <span class="fa fa-plus-circle"></span> </button>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="row"></div>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>Cor</b></td>
				<td><b>Tamanho</b></td>
				<td><b>Estoque Minimo</b></td>
				<td><b>Em Estoque</b></td>
				<td><b>&nbsp;</b></td>
			</tr>
		</thead>
	<?php foreach ($estoques as $estoque){
		echo '
		<tr>
			<td>'.ucwords(strtolower($estoque['cor_nome'])).'</td>
			<td>'.ucwords(strtolower($estoque['tamanho_nome'])).'</td>
			<td>'.$estoque[4].'</td>
			<td>'.$estoque[5].'</td>
			<td align="right">
				<a href="'.$url.'produto/estoque/'.$produto[0].'/excluir/'.$estoque[0].'/" class="btn btn-danger btn-xs" id="btn-excluir"><span class="fa fa-trash"></span></button>
			</td>
		</tr>';
	}?>
	</table>
</div>