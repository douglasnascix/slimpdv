<style type="text/css">
	#bg-loader{
		display: block;
	}
</style>
<h3 class="page-header">Pedidos / Listar</h3>

<div class="panel panel-default">
	<div class="panel-body">

	<table class="table table-hover" id="paginacao">
		<thead>
			<tr>
				<th width="50px;">&nbsp;</th>
				<th>#ID</th>
				<th>Status</th>
				<th>Cliente</th>
				<th>Valor</th>
				<th>Data</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($pedidos as $pedido) {?>
			<tr>
				<td>					
					<button id="<?php echo $pedido['pedido_id'];?>" class="btn-excluir btn btn-xs btn-danger"><span class="fa fa-trash"></span></button>

					<?php if($pedido['pedido_status'] == "Orçamento"){?>
					<a href="<?php echo $url.'caixa/editaorcamento/'.$pedido['pedido_id'];?>" id="<?php echo $pedido['pedido_id'];?>" class="btn btn-xs btn-success"><span class="fa fa-edit"></span></a>
					<?php }?>
				</td>				
				<td><a href="<?php echo $url."pedido/visualizar/".$pedido['pedido_id'];?>/"><?php echo $pedido['pedido_id'];?></a></td>
				<th><?php echo $pedido['pedido_status'];?></th>
				<td><?php $nome = explode(" ", $pedido['cliente_nome']); echo $nome[0];?></td>
				<td>R$ <?php echo number_format($pedido['pedido_valor'], 2, "," , "." )?></td>
				<td><?php echo date_format(date_create($pedido['pedido_data']), "d/m/Y H:i:s" )?></td>
			</tr>
			<?php };?>
		</tbody>
	</table>

	</div>
</div>


<!-- Modal -->
<div id="excluir" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <div class="modal-body">
        <p>Deseja excluir o pedido <span id="pedido_id_aqui"></span> ?</p>
      </div>
      <div class="modal-footer">
      	<button type="button" id="confirmaExclusao" class="btn btn-danger">Sim</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
      </div>
    </div>

  </div>
</div>
<?php
$scriptsJS = '<script type="text/javascript" src="'.$url.'_modulos/pedido/view/js/excluir.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/js/jquery.dataTables.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/js/dataTables.bootstrap.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'view/js/dataTables.responsive.js"></script>';
$scriptsJS .= "<script>
				$('#paginacao').DataTable( {
			        \"searching\": false,
			        \"lengthMenu\": [[10, 25, 50], [10, 25, 50]],
			        \"ordering\": false,
			        \"info\":     false,
			        \"language\": {
			        	\"url\": \"".$url.'view/js/dataTables.ptbr.lang'."\"
		        	}
			    } );

			    $( document ).ready(function() {
					$('#bg-loader').hide();
				});

			</script>";
?>
