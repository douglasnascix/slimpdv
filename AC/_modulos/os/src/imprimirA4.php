<?php
if(!isset($_GET['id'])){
	header("Location: ".$url);
}


include "../../../config/config.php";
include "../../empresa/src/empresa.class.php";
include "../../cliente/src/clientes.class.php";
include "../../tecnico/src/tecnicos.class.php";
include "../../os/src/os.class.php";
include "../../caixa/src/class.pedido.php";
include "../../pagamento/src/pagamentos.class.php";


$empresaOBJ = new Empresa(new Config());
$empresa = $empresaOBJ->listar();

$osOBJ = new Os(new Config());

$os = $osOBJ->listar($_GET['id']);

$pedidoOBJ = new Pedido(new Config());
$pedido = $pedidoOBJ->listarOS($os['os_id']);

$pedido_produtos = $pedidoOBJ->listar_produto($pedido['pedido_id']);

$clienteOBJ = new Cliente(new Config());
$cliente = $clienteOBJ->listar($os['cliente_id']);

$tecnicoOBJ = new Tecnico(new Config());
$tecnico = $tecnicoOBJ->listar($os['tecnico_id']);

$pagamentosOBJ = new Pagamento(new Config());
$pedido_pagamentos = $pedidoOBJ->listar_pagamento($pedido['pedido_id']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Print</title>
	<style>
	    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #ccc;
        font: 10pt "Arial";
	    }
		
		p{margin: 0px;padding: 0px;}

	    * {
	        box-sizing: border-box;
	        -moz-box-sizing: border-box;
	        margin: 0px;
	    }
	    p{
	    	margin-bottom: 5mm;
	    	margin-top: 2mm;
	    }
	    .page {
	        width: 210mm;
	        min-height: 297mm;
	        margin: 10mm auto;
	        border-radius: 5px;
	        background: white;
	        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	    }
	    .subpage {
	        padding: 5mm;
	    }
	    

	    @media print {
	        html, body {
	            width: 210mm;
	     
	        }

	        .noprint, .noprint *{
		        display: none !important;
		    }

	        .page {
	            margin: 0;
	            border: initial;
	            border-radius: initial;
	            width: initial;
	            min-height: initial;
	            box-shadow: initial;
	            background: initial;
	            page-break-after: always;
	        }
	    }

	    .precos{
	    	margin: 0px;padding: 0px;
	    	text-align: justify
	    }

	    .borda td{
	    	border-bottom: 1px solid #000;
	    }
	    .row{
	    	width: 100%;
	    	clear: both;
	    	margin-bottom: 20px;
	    }
	    .col{
	    	float: left;
	    	width: 50%
	    }
	    .col-3{
	    	float: left;
	    	width: 33.3%
	    }

	    .col-4{
	    	float: left;
	    	width: 25%
	    }


	    .rodape{
	    	position: relative;
	    	bottom: 100px;
	    }

	    .btn{
	    	padding-top: 50px;
	    	padding-left: 20px;
	    	padding-right: 20px;
	    	padding-bottom: 20px;
	    	text-decoration: none;
	    	background-color: #fff;
	    	color: #000;
	    }
	    p{
	    	margin-bottom: 10px;
	    }
	    hr{
	    	margin-bottom:5px;
	    	margin-top: 5px;
	    }

	    .clearfix{
	    	clear: both;
	    }

    </style>
</head>
<body>
	<div class="row noprint">
		<div class="container">
			<a href="<?php echo $url."os/editar/".$os['os_id']?>/" class="btn"><br>&nbsp;&nbsp;&nbsp;&nbsp;X </a>
		</div>
	</div>
	<div class="book">
	    <div class="page">
	        <div class="subpage">
	        <div class="row">
				<div class="col-3">
					<?php if(file_exists('../../../view/img/empresa.png')){
						echo '<img src="../../../view/img/empresa.png">';
					};?>

					<p><b><?php echo $empresa['empresa_site'];?></b></p>					
				</div>			
				<div class="col-3" align="center">
					<p>Whatsapp 98412-2121<br>
						4352-7630 / 2534-83229
					</p>
				</div>
				<div class="col-3" align="right">
					<h4>ORDEM DE SERVIÇO</h4>
					<h2>#<?php echo str_pad($os["os_id"], 5, "0",STR_PAD_LEFT);?></h2>
					<p><?php echo date_format(date_create($os['os_data']), "d/m/Y H:i:s")?></p>
				</div>
				<div class="clearfix"></div>
			</div>
			
			<div class="row">
				<?php if($cliente['cliente_id'] > 0 ){?>
				<div class="col"><p><b>Cliente: </b><?php echo $cliente['cliente_nome']?></p></div>
				<div class="col"><p><b>CPF: </b><?php echo $cliente['cliente_cpf']?></p></div>
				<div class="col"><p><b> Fone:</b> <?php echo $cliente['cliente_telefone'].' - '.$cliente['cliente_celular']?></p></div>
				<p><b>Endereço: </b><?php echo $cliente['cliente_endereco'].', '.$cliente['cliente_numero']?> - <?php echo $cliente['cliente_complemento']?>
				<?php echo $cliente['cliente_bairro']?> - <?php echo $cliente['cliente_municipio']?> - <?php echo $cliente['cliente_uf']?></p>    	    	
			    <?php };?>
			</div>
			<hr>
			<div class="row">				
				<div class="col-4"><p><b>Equipamento: </b><br><?php echo $os['os_equipamento'];?></p></div>
				<div class="col-4"><p><b>Marca: </b><br><?php echo $os['marca_nome'];?></p></div>				
				<div class="col-4"><p><b>Modelo: </b><br><?php echo $os['os_modelo'];?></p></div>
				<div class="col-4"><p><b>Nº Serie: </b><br><?php echo $os['os_nserie'];?></p></div>				
			</div>
			<hr>
			<div class="row">
				<p><b>Acessórios: </b><?php echo $os['os_acessorio'];?></p>
			</div>
			<hr>
			<div class="row">
				<p><b>Defeito: </b><br><?php echo nl2br($os['os_defeito']);?></p>	<hr>			
				<p><b>Observação:<br> </b><?php echo nl2br($os['os_obs']);?></p>
			</div>

			<?php if($os['os_laudo'] != ""){?>
			<hr>
			<div class="row">
				<p><b>Técnico: </b><?php echo $tecnico['tecnico_nome'];?></p>
				<p><b>Laudo: </b><?php echo nl2br($os['os_laudo']);?></p>				
			</div>
			<?php }else{?>
			<div class="row">
				<small>
					<p align="center">POLITICA PARA ORÇAMENTOS</p>
					<p>Fica estabelecido o prazo de <b>1 a 7 dias uteis para orçamento</b>; Orçamentos serão informados através de <b>telefone, e-mail ou Whatsapp</b>; Equipamentos aprovados ou reprovados <u>devem ser retirados em até 30 dias</u>. Após esta data será cobrado estadia com valor fixado de <u>R$ 2,00 por dia</u>. <b>Após 90 dias</b> o equipamento será vendido com o objetivo de cobrir as despesas de peças e mão de obra.<br><br><br>
					</p>
				</small>
			</div>
			<?php };?>

			<?php if(count($pedido_produtos) > 0){?>
			<div class="row" style="margin-top: 80px;">
			<p align="center"><b>Descrição dos Serviços Realizados</b></p>
				<table width="100%" cellpadding="5">
					<thead>
						<td><b>Cod</b></td>
						<td><b>Produto</b></td>
						<td><b>Quantidade</b></td>
						<td><b>Unitario</b></td>
						<td align="right"><b>SubTotal</b></td>
					</thead>
					<?php $total=0; foreach($pedido_produtos as $produto){?>
						<tr class="borda">
							<td><?php echo $produto[0];?></td>
							<td><?php echo $produto['produto_nome'];?></td>
							<td><?php echo $produto['produto_quantidade'];?></td>
							<td><?php echo "R$ ".number_format($produto['produto_preco'], 2, ',','.');?></td>
							<td align="right"><?php $subtotal = $produto['produto_preco']*$produto['produto_quantidade'] ;echo "R$ ".number_format($subtotal, 2, ',','.');?></td>
						</tr>
					<?php $total+= $subtotal; };?>
				</table>

				<h3 align="right">
					<br>Total <?php echo "R$ ".number_format($total, 2, ',','.');?>
				</h3>

			</div>
			<?php }else{ ?>
			<div style="margin-top: 50px;"></div>	
	<div class="col">
					<?php if(file_exists('../../../view/img/empresa.png')){
						echo '<img src="../../../view/img/empresa.png">';
					};?>

					<p><b><?php echo $empresa['empresa_site'];?></b><br>
				</div>
				<div class="col" align="right">
					<h4>ORDEM DE SERVIÇO</h4>
					<h2>#<?php echo str_pad($os["os_id"], 5, "0",STR_PAD_LEFT);?></h2>
					<p><?php echo date_format(date_create($os['os_data']), "d/m/Y H:i:s")?></p>
					<br>
				</div>

			<div class="row cliente">
				<?php if($cliente['cliente_id'] > 0 ){?>
				<div class="col"><p><b>Cliente: </b><?php echo $cliente['cliente_nome']?></p></div>
				<div class="col"><p><b>CPF: </b><?php echo $cliente['cliente_cpf']?></p></div>
				<div class="col"><p><b> Fone:</b> <?php echo $cliente['cliente_telefone'].' - '.$cliente['cliente_celular']?></p></div>
				<p><b>Endereço: </b><?php echo $cliente['cliente_endereco'].', '.$cliente['cliente_numero']?> - <?php echo $cliente['cliente_complemento']?>
				<?php echo $cliente['cliente_bairro']?> - <?php echo $cliente['cliente_municipio']?> - <?php echo $cliente['cliente_uf']?></p>    	    	
			    <?php };?>
			</div>
			<hr>
			<div class="row">				
				<div class="col-4"><p><b>Equipamento: </b><br><?php echo $os['os_equipamento'];?></p></div>
				<div class="col-4"><p><b>Marca: </b><br><?php echo $os['marca_nome'];?></p></div>				
				<div class="col-4"><p><b>Modelo: </b><br><?php echo $os['os_modelo'];?></p></div>
				<div class="col-4"><p><b>Nº Serie: </b><br><?php echo $os['os_nserie'];?></p></div>				
			</div>
			<hr>
			<div class="row">
				<p><b>Acessórios: </b><?php echo $os['os_acessorio'];?></p>
			</div>
			<hr>
			<div class="row">
				<p><b>Defeito: </b><br><?php echo nl2br($os['os_defeito']);?></p>	<hr>			
				<p><b>Observação:<br> </b><?php echo nl2br($os['os_obs']);?></p>
			</div>
			<div class="row">
				<small>
					<p align="center">POLITICA PARA ORÇAMENTOS</p>
					<p>Fica estabelecido o prazo de <b>1 a 7 dias uteis para orçamento</b>; Orçamentos serão informados através de <b>telefone, e-mail ou Whatsapp</b>; Equipamentos aprovados ou reprovados <u>devem ser retirados em até 30 dias</u>. Após esta data será cobrado estadia com valor fixado de <u>R$ 2,00 por dia</u>. <b>Após 90 dias</b> o equipamento será vendido com o objetivo de cobrir as despesas de peças e mão de obra.<br><br><br>
					</p>
				</small>

				<p align="right">_________________________________________</p>
			</div>

			<?php };?>
			<?php 
			if(count($pedido_pagamentos) > 0){?>
			<div class="row">
			<p align="center"><b>Descrição dos Pagamentos</b></p>
				<table width="100%">
					<?php foreach($pedido_pagamentos as $pedido_pagamento){?>
						<tr class="borda">
							<td><?php echo $pedido_pagamento[1]?></td>
							<td align="center"><?php echo date_format(date_create($pedido_pagamento[4]), "d/m/Y")?></td>
							<td align="right">R$ <?php echo number_format($pedido_pagamento[2], 2, ',', '.')?></td>
						</tr>
					<?php };?>
				</table>
			</div>
			<?php };?>



	        </div>
	    </div>
    </div>

    <?php if(count($pedido_produtos) > 0){?>
	<div class="row rodape" align="center">
		<p><?php echo $empresa['empresa_endereco'].", ".$empresa['empresa_numero'].", ".$empresa['empresa_bairro'].", ".$empresa['empresa_municipio']." - ".$empresa['empresa_uf'];?>	
		<br><?php echo $empresa['empresa_telefone'].' / '.$empresa['empresa_telefone'];?>
		</p>

	</div>	
	<?php };?>
	<script type="text/javascript">
		//window.print();
	</script>

</body>
</html>