<h3 class="page-header">Configuração / Técnico / Editar</h3>

<form action="<?php echo $url;?>tecnico/editar/<?php echo $tecnico[0]?>/" method="POST" style="text-transform: capitalize;">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Novo Técnico</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="tecnico_nome">Nome</label>  	
					<input type="hidden" id="tecnico_id" name="tecnico_id" value="<?php echo $tecnico[0];?>">
					<input type="text" class="form-control" autocomplete="off" required id="tecnico_nome" name="tecnico_nome" value="<?php echo $tecnico[1];?>">
				</div>

			</div>

			<div class="panel-footer clearfix">
				<div class="col-sm-6">
					<a href="<?php echo $url;?>tecnico/listar/" class="form-control btn btn-default"> Cancelar </a>
				</div>
				<div class="col-sm-6">
					<button type="submit" class="form-control btn btn-success"> Salvar </button>
				</div>
			</div>
		</div>
	</div>


</form>
</div>
<?php
$scriptsJS = '<script src="'.$url.'_modulos/tecnico/view/js/tecnico.js"></script>';
?>