<h3 class="page-header">Catalogo / Produto / Listar</h3>

<div class="text-right col-sm-12 ">
	<a href="<?php echo $url;?>produto/cadastrar/" class="btn btn-primary"><span class="fa fa-plus-circle"></span> F2 - Novo </a>
</div>

<div class="col-sm-12 form-group"><br>
	<form action="<?php echo $url;?>produto/listar/" method="POST" id="form">
		<input type="text" class="form-control" name="buscar" autocomplete="OFF" autofocus required id="buscar" placeholder="Buscar Cod. de Barras">
	</form>
</div>


<div class="col-sm-12">
<div class="panel panel-default">
  <div class="panel-body">
    <div class="table-responsive col-sm-12">
	<table class="table table-striped table-hover" id="paginacao">
	<?php if(count($produtos) > 0){?>
		<thead>
			<tr>
				<td><b>Cod.</b></td>
				<td><b>Nome</b></td>
				<td><b>Preço</b></td>
				<td><b>&nbsp;</b></td>
			</tr>
		</thead>
	<?php foreach ($produtos as $produto){
		echo '
		<tr>
			<td>'.$produto[0].'</td>
			<td>'.$produto[1].'</td>
			<td>R$ '.number_format($produto['produto_preco'], 2, ',', '.').'</td>
			<td align="right">
				<a href="'.$url.'produto/editar/'.$produto[0].'/" class="btn btn-primary btn-xs">
					<span class="fa fa-edit"></span>
				</a>
				<a href="'.$url.'produto/excluir/'.$produto[0].'/" class="btn btn-danger btn-xs">
					<span class="fa fa-trash"></span>
				</a>
			</td>
		</tr>';
	}};?>
	</table>
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
			        \"lengthMenu\": [[50, 25, 10], [50, 25, 10]],
			        \"ordering\": false,
			        \"info\":     false,
			        \"language\": {
			        	\"url\": \"".$url.'view/js/dataTables.ptbr.lang'."\"
		        	}
			    } );
			</script>";

$scriptsJS .= '<script src="'.$url.'_modulos/produto/view/js/atalhos.js"></script>';
?>