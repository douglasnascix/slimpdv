<h3 class="page-header">Configuração / Usuário / Listar</h3>

<div class="text-right">
	<a href="<?php echo $url;?>usuario/cadastrar/" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Novo </a>
</div>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>Cod</b></td>
				<td><b>Nome</b></td>
				<td><b>&nbsp;</b></td>
			</tr>
		</thead>
	<?php foreach ($usuarios as $usuario){
		echo '
		<tr>
			<td>'.$usuario[0].'</td>
			<td>'.$usuario[1].'</td>
			<td align="right">
				<a href="'.$url.'usuario/editar/'.$usuario[0].'/" class="btn btn-primary btn-xs">
					<span class="fa fa-edit"></span>
				</a>
				<a href="'.$url.'usuario/excluir/'.$usuario[0].'/" class="btn btn-danger btn-xs">
					<span class="fa fa-trash"></span>
				</a>
			</td>
		</tr>';
	}?>
	</table>
</div>

<?php
$scriptsJS = '<script src="'.$url.'_modulos/usuario/view/js/usuarios.js"></script>';
?>