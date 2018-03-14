<h3 class="page-header">S@T</h3>
<form action="<?php echo $url;?>sat/editar/asdhasiudhasdiu/" method="POST">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Contato</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-3">
					<label for="sat_nSerie">Número de Serie</label>  	
					<input type="text" class="form-control" value="<?php echo $sat['sat_nSerie']; ?>" autocomplete="off" id="sat_nSerie" name="sat_nSerie">
				</div>

				<div class="form-group col-sm-3">
					<label for="sat_cod_ativacao">Código de Ativação</label>
					<input type="text" class="form-control" value="<?php echo $sat['sat_cod_ativacao']; ?>" autocomplete="off" id="sat_cod_ativacao" name="sat_cod_ativacao">
				</div>

				<div class="form-group col-sm-12">
					<label for="sat_signAC">signAC</label>  	
					<textarea type="text" class="form-control" id="sat_signAC" name="sat_signAC"><?php echo $sat['sat_signAC']; ?></textarea>
				</div>
			</div>
			<div class="panel-footer clearfix">
				<div class="col-sm-6">
					<a href="<?php echo $url;?>" class="form-control btn btn-default"> Cancelar </a>
				</div>
				<div class="col-sm-6">
					<button type="submit" class="form-control btn btn-success"> Salvar </button>
				</div>
			</div>
		</div>
	</div>			
</form>