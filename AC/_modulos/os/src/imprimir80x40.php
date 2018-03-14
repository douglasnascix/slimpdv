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
        font: 9pt "lucida console";
        font-weight:bold;
	    }
		
		p{margin: 0px;padding: 0px;}

	    * {
	        box-sizing: border-box;
	        -moz-box-sizing: border-box;
	    }
	    .page {
	        width: 80mm;
	        margin: 10mm auto;
	        border-radius: 5px;
	        background: white;
	        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	    }
	    .subpage {
	        padding: 3mm;
	    }
	    

	    @media print {
	        html, body {
	            width: 80mm;
	     
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
	    .row{
	    	width: 100%;
	    	clear: both;
	    	margin-bottom: 20px;
	    }
	    .col{
	    	float: left;
	    	width: 50%
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

	    .precos{
	    	margin: 0px;padding: 0px;
	    	text-align: justify
	    }
    </style>
</head>
<body>
	<div class="row noprint">
		<div class="container">
			<a href="<?php echo $url."os/editar/".$os['os_id']?>/" class="btn" style="font: 12pt 'arial'"><br>&nbsp;&nbsp;&nbsp;&nbsp;X </a>
		</div>
	</div>
	<div class="book">
    <div class="page">
        <div class="subpage">
        	<center>
	        	<p><?php echo $empresa['empresa_nome'];?></p>
	        	<p><?php echo $empresa['empresa_endereco'].", ".$empresa['empresa_numero']." ".$empresa['empresa_bairro']."</br>".$empresa['empresa_municipio']." ".$empresa['empresa_uf'];?></p>
	        	<p><?php echo $empresa['empresa_telefone'];?></p>
        	</center>
        	<br>
        	<p>-------------------------------------</p>
			<div style="clear:both">&nbsp;</div>
			<div style="float:left">OS: 000<?php echo $pedido[0]?></div>
			<div style="float:right"><?php echo date_format(date_create($os['os_data']), "d/m/Y H:i:s");?></div>
			<div style="clear:both">&nbsp;</div>
			<p>-------------------------------------</p>

        	<?php if($os['os_status'] == 'Orçamento'){?>
        	<p align="center">Orçamento Orçamento Orçamento</p>
        	<p>-------------------------------------</p>
        	<?php }?>
        	<?php if($os['cliente_id'] != 1){?>
			<p><?php echo $cliente['cliente_nome']?></p>
        	<p><?php echo $cliente['cliente_endereco'].', '.$cliente['cliente_numero']?> <?php echo $cliente['cliente_complemento']?></p>
        	<p><?php echo $cliente['cliente_bairro']?> - <?php echo $cliente['cliente_municipio']?> - <?php echo $cliente['cliente_uf']?></p>
        	<p><?php echo $cliente['cliente_telefone'].' - '.$cliente['cliente_celular']?></p>
        	<div>&nbsp;</div>
        	<p>-------------------------------------</p>
        	
        	<p><b>Equipamento: </b><?php echo $os['os_equipamento'];?></p>
        	<p><b>Marca: </b><?php echo $os['marca_nome'];?></p>
			<p><b>Modelo: </b><?php echo $os['os_modelo'];?></p>
			<p><b>Nº Serie: </b><?php echo $os['os_nserie'];?></p>
        	<p>-------------------------------------</p>
        	<p><b>Acessórios: </b><?php echo $os['os_acessorio'];?></p>
        	<p>-------------------------------------</p>
        	<p><b>Defeito: </b><?php echo nl2br($os['os_defeito']);?></p>
				<p style="text-transform: capitalize;"><b>Observação: </b><?php echo nl2br($os['os_obs']);?></p>
        	<p>-------------------------------------</p>
        	<p><b>Técnico: </b><?php echo $tecnico['tecnico_nome'];?></p>
        	<p><b>Laudo: </b><?php echo nl2br($os['os_laudo']);?></p>
        	<p>-------------------------------------</p>
        	<?php }; ?>

        	<?php if(count($pedido_produtos) > 0){?>
        	<p>
        		Codigo | Descrição | Qtd. | V.Unitario | Subtotal
        	</p>

        	<table width="100%">
        	<?php foreach($pedido_produtos as $produto){
        	echo '			
				<tr>
					<td>'.$produto['produto_id'].'</td>
					<td colspan="2">'.$produto['produto_nome'].'</td>
				</tr>
				<tr>
					<td align="left">'.number_format($produto['produto_preco'],2,',','.').'</td>
					<td align="center"> x '.$produto['produto_quantidade'].'</td>					
					<td align="right">'.number_format($produto['produto_quantidade']*$produto['produto_preco'], 2, ',','.').'</td>
				</tr>';
        	}?>
        	</table>
        	<p>-------------------------------------</p>
        	<table width="100%">
				<?php
        			foreach ($pedido_pagamentos as $pagamento) { ?>

        			<tr>
						<td align="left"><?php echo $pagamento['pagamento_nome']?></td>
						<td align="right">
						<?php 
						if($pagamento['pedido_pagamento_parcela'] > 1){
							echo $pagamento['pedido_pagamento_parcela'].'x R$ '.number_format($pagamento['pedido_pagamento_valor'] / $pagamento['pedido_pagamento_parcela'], 2, ',' , '.');
						}else{
							echo 'R$ '.number_format($pagamento['pedido_pagamento_valor'], 2, ',' , '.');
						}?>
						</td>
					</tr>
        		<?php };?>
        	</table>
        	<p>-------------------------------------</p>
        	<?php }?>
			<br><br>
			<p align="center"></p>
			<br><br><br>

			
        </div>
    </div>
</div>
<?php 
include "../../caixa/src/limpa.php";
?>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>
