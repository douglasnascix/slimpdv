<h3 class="page-header">OS / Listar</h3>

<div class="text-right form-group col-sm-12 ">
	<a href="<?php echo $url?>cliente/listar/" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Novo </a>
</div>

<div class="col-sm-12">
<div class="panel panel-default">
  <div class="panel-body">
    <div class="table-responsive col-sm-12">
	<?php if (count($oss) > 0){?>	
	
	<table class="table table-striped table-hover" id="paginacao">
		<thead>
			<tr>
				<td><b>OS</b></td>
				<td>Cliente</td>
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
			<td>'.$os['cliente_nome'].'</td>
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
</div>
</div>
</div>

<?php
$scriptsJS = '<script src="'.$url.'view/js/jquery.dataTables.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/js/dataTables.bootstrap.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/js/dataTables.responsive.js"></script>';
$scriptsJS .="<script>
				$('#paginacao').DataTable( {
			        \"searching\": true,
			        \"ordering\": false,
			        \"info\":     false,
			        \"language\": {
			        	\"url\": \"".$url."/view/js/dataTables.ptbr.lang\"
		        }
			    } );
			</script>";
?>