<h3 class="page-header">Catalogo / Produto / Foto</h3>

<ul class="nav nav-pills" style="margin-bottom:30px;">
  <li role="presentation"><a href="<?php echo $url;?>produto/editar/<?php echo $produto[0];?>/">Dados do Produto</a></li>
  <li role="presentation"><a href="<?php echo $url;?>produto/estoque/<?php echo $produto[0];?>/">Estoque</a></li>
  <li role="presentation" class="active"><a href="<?php echo $url;?>produto/fotos/<?php echo $produto[0];?>/">Fotos</a></li>
</ul>

<form action="<?php echo $url;?>produto/fotos/<?php echo $produto[0];?>/" method="POST" enctype="multipart/form-data" id="form">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b><?php echo $produto[1];?></b></div>
			<div class="panel-body">
				<div class="form-group col-sm-11">
					<label for="produto_imagem">Adicionar Imagem</label>
					<input type="hidden" required id="produto_id" name="produto_id" value="<?php echo $produto[0];?>">
					<input type="file" class="form-control" required id="produto_imagem" name="produto_imagem[]">
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

<div class="col-sm-12">
	<?php foreach ($fotos as $foto){
		echo '
		<div class="col-sm-3 col-lg-2 text-center">
		<img src="'.str_replace("/__admin", "", $url).'img/produto/M'.$foto[2].' " class="img-responsive center-block"><br>
		<a href="'.$url.'produto/fotos/'.$produto[0].'/excluir/'.$foto[0].'/" class="btn btn-danger">
			<span class="fa fa-trash"></span>
		</a>
		</div>';
	}?>
</div> 