<h3 class="page-header">Configuração / Marca / Cadastrar</h3>

<form action="<?php echo $url;?>marca/cadastrar/" method="POST" style="text-transform: capitalize;" enctype="multipart/form-data">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Novo Marca</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="marca_nome">Nome</label>
					<input type="text" class="form-control" autocomplete="off" required id="marca_nome" name="marca_nome">
				</div>
				<div class="form-group col-sm-12">
					<label for="marca_imagem">Imagem <small>200x100</small></label>
					<input type="file" class="form-control" id="marca_imagem" name="marca_imagem[]">
				</div>
			</div>

			<div class="panel-footer clearfix">
				<div class="col-sm-6">
					<a href="<?php echo $url.'/marca/listar/';?>" class="form-control btn btn-default"> Cancelar </a>
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
$scriptsJS = '<script src="'.$url.'_modulos/marca/view/js/marca.js"></script>';
?>