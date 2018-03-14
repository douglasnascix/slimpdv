<h3 class="page-header">Configuração / Categoria / Listar</h3>

<div class="text-right">
	<a href="<?php echo $url;?>categoria/cadastrar/" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Novo </a>
</div>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>Nome</b></td>
				<td><b>&nbsp;</b></td>
			</tr>
		</thead>
	<?php foreach ($categorias as $categoria){
		echo '
		<tr>
			<td>'.$categoria[1].'</td>
			<td align="right">
				<a href="'.$url.'categoria/editar/'.$categoria[0].'/" class="btn btn-primary btn-xs">
					<span class="fa fa-edit"></span>
				</a>
				<a href="'.$url.'categoria/excluir/'.$categoria[0].'/" class="btn btn-danger btn-xs">
					<span class="fa fa-trash"></span>
				</a>
			</td>
		</tr>';
	}?>
	</table>
</div>

<?php
$scriptsJS = '<script src="'.$url.'_modulos/categoria/view/js/categorias.js"></script>';
?>