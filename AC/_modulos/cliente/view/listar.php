<h3 class="page-header">Clientes / Listar</h3>
<div class="text-right col-sm-12 ">
	<a href="<?php echo $url;?>cliente/cadastrar/" class="btn btn-primary"><span class="fa fa-plus-circle"></span> F2 - Novo </a>
</div>

<div class="col-sm-12 form-group"><br>
	<form action="<?php echo $url;?>cliente/listar/" method="POST" id="form">
		<input type="text" class="form-control" name="buscar" autocomplete="OFF" autofocus required id="buscar" placeholder="Buscar Cliente">
	</form>
</div>

<div class="clearfix"></div>

<div class="col-sm-12">
<div class="panel panel-default">
	<div class="panel-body">

		<div class="table-responsive col-sm-12">
			<?php if (count($clientes) > 0){?>	

			<table class="table table-hover">
				<thead>
					<tr>
						<td><b>Nome</b></td>
						<td><b>CPF</b></td>
						<td><b>Telefone</b></td>
						<td><b>Celular</b></td>
						<td><b>&nbsp;</b></td>
					</tr>
				</thead>
				<?php 
				foreach ($clientes as $cliente){
					echo '
					<tr>
					<td>'.$cliente['cliente_nome'].'</td>
					<td>'.$cliente['cliente_cpf'].'</b></td>
					<td>'.$cliente['cliente_telefone'].'</td>
					<td>'.$cliente['cliente_celular'].'</td>
					<td align="right">
					<a href="'.$url.'os/cliente/'.$cliente[0].'/" class="btn btn-success btn-xs">
					<span class="fa fa-wrench"></span>
					</a>
					<a href="'.$url.'cliente/editar/'.$cliente[0].'/" class="btn btn-primary btn-xs">
					<span class="fa fa-edit"></span>
					</a>
					<a href="'.$url.'cliente/excluir/'.$cliente[0].'/" class="btn btn-danger btn-xs">
					<span class="fa fa-trash"></span>
					</a>
					</td>
					</tr>';
				}?>
			</table>
			<?php }?>
		</div>
	</div>
</div>
</div>
<?php
$scriptsJS .= '<script src="'.$url.'_modulos/cliente/view/js/atalhos.js"></script>';

?>