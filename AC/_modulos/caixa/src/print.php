<?php
session_start();

if(isset($_GET['pedido'])){
	$pedido_id = $_GET['pedido'];
}else{
	if(isset($_SESSION['PEDIDO'])){
		$pedido_id = $_SESSION['PEDIDO'];
	}else{
		header("Location: ../../../caixa/index/");
	}
}


include "../../../config/config.php";
include "../../empresa/src/empresa.class.php";
include "../../sat/src/sat.class.php";
include "../../pedido/src/pedido.class.php";
include "../../caixa/src/cupom.class.php";
include "../../cliente/src/clientes.class.php";


$pedidoOBJ = new Pedido(new Config());
$empresaOBJ = new Empresa(new Config());
$satOBJ = new Sat(new Config());
$cupomOBJ = new Cupom(new Config());
$clienteOBJ = new Cliente(new Config());



$empresa = $empresaOBJ->listar();
$pedido = $pedidoOBJ->listar($pedido_id);
$cliente = $clienteOBJ->listar($pedido['cliente_id']);
$produtos = $pedidoOBJ->listar_produto($pedido_id);
$pagamentos = $pedidoOBJ->listar_pagamento($pedido_id);
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
    </style>
</head>
<body>
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
			<div style="float:left">Pedido: 000<?php echo $pedido[0]?></div>
			<div style="float:right"><?php echo date_format(date_create($pedido['pedido_data']), "d/m/Y H:i:s");?></div>
			<div style="clear:both">&nbsp;</div>
			<p>-------------------------------------</p>

        	<?php if($pedido['pedido_status'] == 'Orçamento'){?>
        	<p align="center">Orçamento Orçamento Orçamento</p>
        	<p>-------------------------------------</p>
        	<?php }?>
        	<?php if($pedido['cliente_id'] != 1){?>
			<p><?php echo $cliente['cliente_nome']?></p>
        	<p><?php echo $cliente['cliente_endereco'].', '.$cliente['cliente_numero']?> <?php echo $cliente['cliente_complemento']?></p>
        	<p><?php echo $cliente['cliente_bairro']?> - <?php echo $cliente['cliente_municipio']?> - <?php echo $cliente['cliente_uf']?></p>
        	<p><?php echo $cliente['cliente_telefone'].' - '.$cliente['cliente_celular']?></p>
        	<div>&nbsp;</div>
        	<p>-------------------------------------</p>
        	<?php }; ?>
        	<p>
        		Codigo | Descrição | Qtd. | V.Unitario | Subtotal
        	</p>

        	<table width="100%">
        	<?php foreach($produtos as $produto){
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
				<tr>
        			<td align="left">SUBTOTAL</td>
        			<td align="right">R$ <?php echo number_format($pedido['pedido_valor'] + $pedido['pedido_desconto'] - $pedido['pedido_acrescimo'], 2, ',' , '.'); ?></td>
        		</tr>
        		<tr>
        		<?php
    			if($pedido['pedido_acrescimo'] > 0.00 or $pedido['pedido_desconto'] > 0.00){
					if($pedido['pedido_desconto'] > 0.00){
			            echo '<td align="left">Desconto</td><td align="right">R$ -'.number_format($pedido['pedido_desconto'], 2, ',' , '.').'</td>';
			          }else{
			            echo '<td align="left">Acrescimo</td><td align="right">R$ +'.number_format($pedido['pedido_acrescimo'], 2, ',' , '.').'</td>';
			          }
			      };
        		?>
        		</tr>
        		<tr>
        			<td align="left">TOTAL</td>
        			<td align="right">R$ <?php echo number_format($pedido['pedido_valor'], 2, ',' , '.'); ?></td>
        		</tr>

        		<?php
        			foreach ($pagamentos as $pagamento) { ?>

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
        		<?php
        		if($pedido['pedido_troco'] > 0){ ?>
        		<tr>
        			<td align="left">TROCO</td>
        			<td align="right">R$ <?php echo number_format($pedido['pedido_troco'], 2, ',' , '.'); ?></td>
        		</tr>
        		<?php }?>
        	</table>
        	<p>-------------------------------------</p>
			<br><br>
			<p align="center">COMPROVANTE NÃO FISCAL</p>
			<p align="center">OBRIGADO E VOLTE SEMPRE!</p>
			<br><br><br>

			
        </div>
    </div>
</div>
<?php 
include "../../caixa/src/limpa.php";
?>
<script type="text/javascript">
	window.print();
	setTimeout(function(){ location.href = '../../../caixa/index/' }, 2000);
</script>
</body>
</html>
