<h3 class="page-header">Configuração / Categoria / Cadastrar</h3>

<form action="<?php echo $url;?>categoria/cadastrar/" method="POST" style="text-transform: capitalize;">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Novo Categoria</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="categoria_nome">Nome</label>
					<input type="text" class="form-control" autocomplete="off" required id="categoria_nome" name="categoria_nome">
				</div>
			</div>

			<div class="panel-footer clearfix">
				<div class="col-sm-6">
					<a href="<?php echo $url;?>" class="form-control btn btn-default"> Cancelar </a>
				</div>
				<div class="col-sm-6">
					<button type="submit" class="form-control btn btn-success"> Cadastrar </button>
				</div>
			</div>
		</div>
	</div>


</form>
</div>
<?php
$scriptsJS = '<script src="'.$url.'_modulos/categoria/view/js/categoria.js"></script>';
?>