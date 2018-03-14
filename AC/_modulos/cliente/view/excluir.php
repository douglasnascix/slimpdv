<h1 class="page-header">Clientes / Excluir</h1>

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Deseja Excluir o Cliente ?</b></div>
		<div class="panel-body">
			<form action="<?php echo $url;?>cliente/excluir/<?php echo $_GET['id']; ?>/" method="POST">
				<p><small>O seguinte cliente será excluido "<?php echo $clienteNome[1];?>"</small><br><br></p>
				<input type="hidden" name="cliente_id" value="<?php echo $_GET['id']; ?>">
				<input type="submit" class="btn btn-danger" name="sim" value="Sim"> <a href="<?php echo $url;?>cliente/listar/" class="btn btn-default"> Não </a>
			</form>
		</div>
	</div>
</div>
</div>