<h3 class="page-header">Configuração / Usuário / Editar</h3>

<form action="<?php echo $url;?>usuario/editar/<?php echo $usuario[0]?>/" method="POST" style="text-transform: capitalize;">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Novo Usuário</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="usuario_nome">Nome</label>  	
					<input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $usuario[0];?>">
					<input type="text" class="form-control" autocomplete="off" required id="usuario_nome" name="usuario_nome" value="<?php echo $usuario[1];?>">
				</div>

				<div class="form-group col-sm-12">
					<label for="usuario_email">Email</label>  	
					<input type="text" class="form-control" autocomplete="off" id="usuario_email" name="usuario_email" value="<?php echo $usuario[2];?>">
				</div>

				<div class="form-group col-sm-6">
					<label for="usuario_senha">Senha</label>  	
					<input type="password" class="form-control" autocomplete="off" id="usuario_senha" name="usuario_senha">
				</div>

				<div class="form-group col-sm-6">
					<label for="usuario_senha2">Repete Senha</label>  	
					<input type="password" class="form-control" autocomplete="off" id="usuario_senha2" name="usuario_senha2">
				</div>

			</div>

			<div class="panel-footer clearfix">
				<div class="col-sm-6">
					<a href="<?php echo $url;?>usuario/listar/" class="form-control btn btn-default"> Cancelar </a>
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
$scriptsJS = '<script src="'.$url.'_modulos/usuario/view/js/usuario.js"></script>';
?>