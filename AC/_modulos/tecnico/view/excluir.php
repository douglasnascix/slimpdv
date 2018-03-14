<h3 class="page-header">Configuração / Técnico / Excluir</h3>

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Deseja Excluir o Técnico ?</b></div>
		<div class="panel-body">
			<form action="<?php echo $url;?>tecnico/excluir/<?php echo $_GET['id']; ?>/" method="POST">
				<p><small>O seguinte usuário será excluido "<?php echo $tecnicoNome[1];?>"</small><br><br></p>
				<input type="hidden" name="tecnico_id" value="<?php echo $_GET['id']; ?>">
				<input type="submit" class="btn btn-danger" name="sim" value="Sim"> <a href="<?php echo $url;?>tecnico/listar/" class="btn btn-default"> Não </a>
			</form>
		</div>
	</div>
</div>
</div>