<h3 class="page-header">NCM / Buscar</h3>

<div class="col-sm-12 form-group"><br>
	<form action="<?php echo $url;?>ncm/listar/" method="POST" id="form">
		<input type="text" class="form-control" name="buscar" autocomplete="OFF" required id="buscar" placeholder="Digite a descrição do produto">
	</form>
</div>

<div class="clearfix"></div>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>NCM</b></td>
				<td><b>Descricao</b></td>
			</tr>
		</thead>
	<?php if(isset($ncms))foreach ($ncms as $ncm){
		echo '
		<tr>
			<td>'.$ncm['codigo'].'</td>
			<td>'.$ncm['descricao'].'</td>	
		</tr>';
	}?>
	</table>
</div>
<?php
$scriptsJS = '<script src="'.$url.'_modulos/ncm/view/js/ncms.js"></script>';
?>