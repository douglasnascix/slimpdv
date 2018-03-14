<h3 class="page-header">Catalogo / Produto / Excluir</h3>

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Deseja Excluir o Produto ?</b></div>
		<div class="panel-body">
			<form action="<?php echo $url;?>produto/excluir/<?php echo $_GET['id']; ?>/" method="POST">
				<p><small>O seguinte produto será excluido "<?php echo $produtoNome[1];?>"</small><br><br></p>
				<input type="hidden" name="produto_id" value="<?php echo $_GET['id']; ?>">
				<input type="submit" class="btn btn-danger" name="sim" value="Sim"> <a href="<?php echo $url;?>produto/listar/" class="btn btn-default"> Não </a>
			</form>
		</div>
	</div>
</div>
</div>