<h3 class="page-header">Configuração / Marca / Listar</h3>

<div class="text-right">
	<a href="<?php echo $url;?>marca/cadastrar/" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Novo </a>
</div>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>&nbsp;</b></td>
				<td><b>&nbsp;</b></td>
			</tr>
		</thead>
	<?php foreach ($marcas as $marca){
		echo '
		<tr>
			<td><img src="'.$url.'marcas/'.$marca["marca_imagem"].'" alt="'.$marca["marca_nome"].'" title="'.$marca["marca_nome"].'"></td>
			<td align="right">
				<a href="'.$url.'marca/editar/'.$marca[0].'/" class="btn btn-primary btn-xs">
					<span class="fa fa-edit"></span>
				</a>
				<a href="'.$url.'marca/excluir/'.$marca[0].'/" class="btn btn-danger btn-xs">
					<span class="fa fa-trash"></span>
				</a>
			</td>
		</tr>';
	}?>
	</table>
</div>

<?php
$scriptsJS = '<script src="'.$url.'_modulos/marca/view/js/marcas.js"></script>';
?>