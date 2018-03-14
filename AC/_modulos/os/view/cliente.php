<h3 class="page-header"><?php  echo $cliente['cliente_nome'];?></h3>

<div class="row">
 	<div class="col-sm-12 form-group text-right">
		<a href="<?php echo $url."os/cadastrar/".$_GET['id']?>/" class="btn btn-primary"><i class="glyphicon glyphicon-file"></i> Novo</a>
	</div>
</div>

<div class="table-responsive">
	<?php if (count($oss) > 0){?>	
	
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>OS</b></td>
				<td>Equipamento</td>
				<td>Marca</td>
				<td>Status</td>
				<td></td>
			</tr>
		</thead>
	<?php 
	foreach ($oss as $os){
		echo '
		<tr>
			<td>'.str_pad($os['os_id'], 4, "0",STR_PAD_LEFT).'</td>
			<td>'.$os['os_equipamento'].'</td>
			<td>'.$os['marca_nome'].'</td>
			<td><b>'.$os['os_status'].'</b></td>
			<td align="right">
				<a href="'.$url.'os/editar/'.$os[0].'/" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Visualizar">
					<span class="fa fa-edit"></span>
				</a>
			</td>
		</tr>';
	}?>
	</table>
	<?php }?>
</div>