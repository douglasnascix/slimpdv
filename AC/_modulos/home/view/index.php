<h3 class="page-header">Olá <?php echo $_SESSION["usuario_nome"]?></h3>
	
<div class="row">
<div class="col-lg-3 col-md-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="fa fa-barcode fa-5x"></i>
				</div>
				<div class="col-xs-9 text-right">
					<div class="huge"><?php echo $produto;?></div>
					<div>Produtos</div>
				</div>
			</div>
		</div>
		<a href="<?php echo $url?>produto/listar/">
			<div class="panel-footer">
				<span class="pull-left">Ver Detalhes</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>
<div class="col-lg-3 col-md-6">
	<div class="panel panel-green">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="fa fa-users fa-5x"></i>
				</div>
				<div class="col-xs-9 text-right">
					<div class="huge"><?php echo $cliente;?></div>
					<div>Clientes</div>
				</div>
			</div>
		</div>
		<a href="<?php echo $url?>cliente/listar/">
			<div class="panel-footer">
				<span class="pull-left">Ver Detalhes</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>
<div class="col-lg-3 col-md-6">
	<div class="panel panel-yellow">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="fa fa-shopping-cart fa-5x"></i>
				</div>
				<div class="col-xs-9 text-right">
					<div class="huge"><?php echo $novos; ?></div>
					<div>Pedidos</div>
				</div>
			</div>
		</div>
		<a href="<?php echo $url?>pedido/listar/">
			<div class="panel-footer">
				<span class="pull-left">Ver Detalhes</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>
<div class="col-lg-3 col-md-6">
	<div class="panel panel-red">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="fa fa-close fa-5x"></i>
				</div>
				<div class="col-xs-9 text-right">
					<div class="huge"><?php echo $estoque;?></div>
					<div>Estoque Baixo</div>
				</div>
			</div>
		</div>
		<a href="<?php echo $url?>estoque/listar/">
			<div class="panel-footer">
				<span class="pull-left">Ver Detalhes</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>
</div>
<!-- /.row -->

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				Pedidos
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#ID</th>
								<th>Cliente</th>
								<th>Valor</th>
								<th>Data</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pedidos as $pedido) {?>
							<tr>
								<td><a href="<?php echo $url."pedido/visualizar/".$pedido['pedido_id'];?>/"><?php echo $pedido['pedido_id'];?></a></td>
								<td><?php $nome = explode(" ", $pedido['cliente_nome']); echo $nome[0];?></td>
								<td>R$ <?php echo number_format($pedido['pedido_valor'], 2, "," , "." )?></td>
								<td><?php echo date_format(date_create($pedido['pedido_data']), "d/m/Y H:i:s" )?></td>
							</tr>
							<?php };?>
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->
				<div class="col-sm-12 text-center">
					<a href="<?php echo $url?>pedido/listar/">Ver Todos</a>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>


	<div class="col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				Orçamentos
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#ID</th>
								<th>Cliente</th>
								<th>Valor</th>
								<th>Data</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($orcamentos as $orcamento) {?>
							<tr>
								<td><a href="<?php echo $url.'caixa/editaorcamento/'.$orcamento['pedido_id'];?>/"><?php echo $orcamento['pedido_id'];?></a></td>
								<td><?php $nome = explode(" ", $orcamento['cliente_nome']); echo $nome[0];?></td>
								<td>R$ <?php echo number_format($orcamento['pedido_valor'], 2, "," , "." )?></td>
								<td><?php echo date_format(date_create($orcamento['pedido_data']), "d/m/Y H:i:s" )?></td>
							</tr>
							<?php };?>
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->
				<div class="col-sm-12 text-center">
					<a href="<?php echo $url?>pedido/listar/">Ver Todos</a>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>



	<div class="col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				Produtos Estoque Baixo
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Produto</th>
								<th>Minímo</th>
								<th>Estoque</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($estoqueMinimo as $estoque) {?>
							<tr>
								<td><?php echo substr($estoque['produto_nome'],0,30);?>...</td>
								<td><?php echo $estoque['produto_estoque_min'];?></td>
								<td><?php echo $estoque['produto_estoque'];?></td>
							</tr>
							<?php };?>
						</tbody>
					</table>					
				</div>
				<!-- /.table-responsive -->
				<div class="col-sm-12 text-center">
					<a href="<?php echo $url?>estoque/listar/">Ver Todos</a>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<div style="min-height:120px;">&nbsp;</div>
</div>

<div style="position: fixed;bottom:0;min-height:50px;background:#ebebeb;width:100%">
<div class="container">
	<div class="col-sm-3">
		<h3><b>Suporte</b><br><small>Seg a Sex 09:00 ás 18:00<br>Sab 09:00 ás 15:00</small></h3>
	</div>
	<div class="col-sm-9">
		<h3><b>Duvidas?</b><br><small>Fale conosco pelo chat<br>ou pelo telefone (11) 4352-7630 ou 2534-8329<br></small></h3>
	</div>
</div>
</div>
<?php
$scriptsJS .= '<script src="'.$url.'_modulos/home/view/js/relogio.js"></script>';
$scriptsJS .= '<script>relogio();</script>';

$scriptsJS .= "
    <!--Start of Tawk.to Script-->
    <script type=\"text/javascript\">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5955c3c250fd5105d0c8345a/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
";
?>