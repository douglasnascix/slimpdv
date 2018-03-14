<h3 class="page-header">Relatório / Produtos sem Ncm</h3>

<div class="col-sm-12">
<div class="panel panel-default">
  <div class="panel-body">
  <h3>Total: <?php echo count($produtos); ?></h3>
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
			        \"paging\":   false,
        			\"ordering\": false,
        			\"info\":     false
			        \"language\": {
			        	\"url\": \"".$url.'view/js/dataTables.ptbr.lang'."\"
		        	}
			    } );
			</script>";

$scriptsJS .= '<script src="'.$url.'_modulos/produto/view/js/atalhos.js"></script>';
?>