<h3 class="page-header">Configuração / Categoria / Excluir</h3>

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Deseja Excluir o Categoria ?</b></div>
		<div class="panel-body">
			<form action="<?php echo $url;?>categoria/excluir/<?php echo $_GET['id']; ?>/" method="POST">
				<p><small>A seguinte categoria será excluido "<?php echo $categoriaNome[1];?>"</small><br><br></p>
				<input type="hidden" name="categoria_id" value="<?php echo $_GET['id']; ?>">
				<input type="submit" class="btn btn-danger" name="sim" value="Sim"> <a href="<?php echo $url;?>categoria/listar/" class="btn btn-default"> Não </a>
			</form>
		</div>
	</div>
</div>
</div>