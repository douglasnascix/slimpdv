<!-- 
<h3 class="page-header">&nbsp;<span class="pull-right"><small><?php echo date("d/m/Y H:i:s");?></small></span></h3>
-->

<div class="row">

	<div class="col-sm-6">
		<div class="form-group input-group">
			<input type="text" class="form-control" autocomplete="off" data-provide="typeahead" placeholder="Digite o codigo ou descrição do produto" name="nome" id="nome">
			<input type="hidden" name="produto_id" id="produto_id">
			<span class="input-group-addon"><span class="fa fa-barcode"></span></span>
		</div>
	</div>

	<div class="col-sm-3">
		<div class="form-group input-group">
			<input type="number" class="form-control" placeholder="Qtd." name="produto_qtd" id="produto_qtd" value="1">
			<span class="input-group-addon">X</span>
		</div>
	</div>

	<div class="col-sm-3">
		<div class="form-group input-group">
			<span class="input-group-addon">R$</span>
			<input type="text" class="form-control" name="produto_valor" id="produto_valor">
		</div>
	</div>
</div>



<div class="well col-sm-12 cupom" style="max-height: 420px;overflow: auto;">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<td>Item</td>
					<td width="70%"><b>Cod. / Produto</b></td>
					<td><b>Qtd.</b></td>							
					<td><b>V. Unitario</b></td>
					<td><b>Subtotal</b></td>
				</tr>
			</thead>
			<tbody>
				<?php 
				if(isset($_SESSION["cart"])){
					$i=1;
					$cartReverso = array_reverse($_SESSION["cart"], true);



				foreach ($cartReverso as $produto => $valor) {

            	$produto_banco = $produtoOBJ->listar($valor['id']); ?>
				<tr>
					<td><?php echo $produto+1;?></td>
					<td><?php echo str_pad($produto_banco["produto_id"], 4, "0",STR_PAD_LEFT)." - <small>".$produto_banco["produto_nome"]?></small></td>
					<td><?php echo $valor['qtd'];?></td>							
					<td><?php echo number_format((float)$valor['valor'], 2, ',', '.');?></td>
					<td><?php echo number_format($valor['qtd'] * $valor['valor'], 2, ',', '.')?></td>
				</tr>
				<?php $i++; };}; ?>
			</tbody>
		</table>
	</div>			
</div>	


<div style="position:relative;bottom:0;z-index:-99;">
<div class="container">
	<div class="col-sm-8"></div>
	<div class="col-sm-4" id="produto">
		<p class="valorTotal azulValor">
			<?php if(isset($_SESSION['total'])){echo "R$ ".number_format($_SESSION['total'],2,',','.');}?>&nbsp;
		</p>
	</div>
</div>
</div>


<div style="position:fixed;bottom: 0">
	<p style="font-weight:normal">F1-Cancela Item | F2-Pagamentos | F3-CPF | F4-Cliente | F8 Sangria/Suprimento | F9-Fechar Caixa | F10-Nova Venda</p>
</div>






<div class="modal fade" tabindex="-3" role="dialog" id="cancelarModal">
	<div class="modal-dialog" role="document">
	      <div class="panel panel-danger">
			<div class="panel-heading">Cancelar Item<button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="panel-body">		
				<div class="form-group">
					<label for="cpf">Informe Item que será cancelado</label>
					<input type="text" class="form-control" name="cancelar_id" id="cancelar_id" autocomplete="off">
				</div>			
			</div>

			<div class="panel-footer">
				<button class="btn btn-danger btn-block" id="btnCancelar" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="cpfModal">
	<div class="modal-dialog" role="document">
		<div class="panel panel-primary">
		<div class="panel-heading">CPF/CNPJ na nota?<button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="panel-body">
				<div class="col-sm-3 form-group">
					<label for="cpf">CPF/CNPJ</label>
					<select name="cpfCnpj" id="cpfCnpj" class="form-control" required="required">
						<option value="cpf" <?php 
						if(isset($_SESSION['cpf'])){
							if(strlen($_SESSION['cpf']) == 14){
								echo "selected";
							};
						};
					?>>CPF</option>
						<option value="cnpj" <?php 
						if(isset($_SESSION['cpf'])){
							if(strlen($_SESSION['cpf']) == 18){
								echo "selected";
							};
						};
					?>>CNPJ</option>
					</select>
				</div>
				<div class="col-sm-9 form-group">
					<label for="cpf">&nbsp;</label>
					<input type="text" class="form-control" name="cpf" id="cpf" autocomplete="off" value="<?php if(isset($_SESSION['cpf'])){echo $_SESSION['cpf'];};?>">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary btn-block" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-2" role="dialog" id="clienteModal">
	<div class="modal-dialog" role="document">
		<div class="panel panel-primary">
		<div class="panel-heading">Buscar Cliente<button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="modal-body">
				<div class="form-group">
					<label for="cpf">Cliente</label>
					<input type="text" class="form-control" id="cliente_nome" name="cliente_nome" autocomplete="off" value="<?php if(isset($_SESSION['cliente_nome'])){echo $_SESSION['cliente_nome'];};?>">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary btn-block" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-99" role="dialog" id="pagamentos">
  <div class="modal-dialog modal-lg" role="document">
      <div class="panel panel-success">
      	<div class="panel-heading">
			Pagamento<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>

	<div class="panel-body">


	<div class="col-sm-6">
		<div class="col-sm-12">
		<label class="radio-inline"><input type="radio" name="ad" value="acrescimo">Acréscimo</label>
		<label class="radio-inline"><input type="radio" name="ad" value="desconto" checked>Desconto</label>
		<div class="clearfix">&nbsp;</div>
	</div>

	<div class="col-sm-6 form-group">
		<div class="form-group input-group">					
			<span class="input-group-addon">R$</span>
			<input type="text" class="form-control" id="acrescimoDesconto" autocomplete="off" value="0,00">
		</div>
	</div>

	<div class="col-sm-6 form-group">
		<div class="form-group input-group">					
			<span class="input-group-addon">%</span>
			<input type="number" class="form-control" id="acrescimoDescontoPorcentagem" autocomplete="off" value="0" max="99">
		</div>
	</div>

	<div class="clearfix"></div>
		
		<div class="col-sm-12 valorTotal azulValor">
			<span>Total: </span>
			R$ <span id="valorTotal"><?php if(isset($_SESSION['total'])){echo number_format($_SESSION['total'],2,',','.');}?></span>
			<input type="hidden" id="vSTotal" name="vSTotal" value="<?php if(isset($_SESSION['total'])){echo number_format($_SESSION['total'],2,',','.');}?>">
			<input type="hidden" id="vTotal" name="vTotal" value="<?php if(isset($_SESSION['total'])){echo number_format($_SESSION['total'],2,',','.');}?>">
		</div>

		<div class="col-sm-12 valorTotal azul hide" id="divTroco">
			<span id="trocoMSG"></span>
			<span id="troco"></span>
			<input type="hidden" id="vTroco" name="vTroco"  value="0,00">
		</div>
	</div>

	<div class="col-sm-6">
		<div class="col-sm-6" id="divformapagamento">
		<label for="">Forma de Pgto</label>
		<select id="formaPagamento" class="form-control" >
			<?php foreach ($pagamentos as $pagamento) {
				echo '<option value="'.$pagamento['pagamento_id'].'">'.$pagamento['pagamento_nome'].'</option>';
			}?>
		</select>
		</div>


		<div class="col-sm-6 hide" id="parcela">
					<label for="">Parcelas</label>
					<div class="form-group">
						<select class="form-control" id="parcelas">
							<option value="1">1x</option>
							<option value="2">2x</option>
							<option value="3">3x</option>
							<option value="4">4x</option>
							<option value="5">5x</option>
							<option value="6">6x</option>
							<option value="7">7x</option>
							<option value="8">8x</option>
							<option value="9">9x</option>
							<option value="10">10x</option>
							<option value="11">11x</option>
							<option value="12">12x</option>
						</select>
					</div>
				</div>

		<div class="col-sm-6"  id="divvalorpagamento">
				<label for="">Valor</label>
			<div class="form-group input-group">
				<span class="input-group-addon">R$</span>
				<input type="text" class="form-control selecionaTudo" id="valorPagamento" autocomplete="off" value="0,00">
			</div>
		</div>

		<div class="col-sm-6 hide" id="vparcela">
			<label for="">Valor Parcela</label>
			<div class="form-group input-group">
				<span class="input-group-addon">R$</span>
				<input type="text" class="form-control" id="vParcela" autocomplete="off" value="0,00" readonly>
			</div>
		</div>

		<div id="pagou"></div>

		
	</div>
		
	</div>
	<div class="modal-footer text-right">
		<button class="btn btn-success hide" id="finalizaVenda" >Finalizar Venda</button>
	</div>

    </div>
  </div>
</div>

<div class="modal fade" id="finalizar-Venda">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Finalizar Venda</h4>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-success" id="emitir_cupom">Emitir Cupom</button>
				<button type="button" class="btn btn-default" id="imprimir_cupom">Imprimir</button>
				<button type="button" class="btn btn-default" id="fechar_venda">Fechar</button>				
			</div>			
		</div>
	</div>
</div>

<div class="modal fade" id="gerarOrcamento">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Finalizar Como Orçamento?</h4>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-success" id="orcamento_sim">Sim</button>
				<button type="button" class="btn btn-default" id="orcamento_nao" data-dismiss="modal">Não</button>
			</div>			
		</div>
	</div>
</div>


<div class="modal fade" tabindex="-22" role="dialog" id="alertas">
	<div class="modal-dialog modal-sm" role="document">
	      <div class="panel panel-danger">
			<div class="panel-heading" id="alertasTitulo"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
			<div class="panel-body">		
				<p id="alertasMensagem"></p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-22" role="dialog" id="fechaCaixa">
	<div class="modal-dialog " role="document">
	      <div class="panel">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Fechamento do caixa</h4>
			</div>
			<div class="panel-body">								
				<form action="<?php echo $url ?>caixa/caixa/" method="POST">

					<div class="col-sm-6">
						<p>Movimentação Caixa</p>
						<?php $valorCaixaInicial = $caixaOBJ->valorAberturaCaixa();?>
						<p></p>
						<table class="table table-striped" style="border:1px solid #ccc">
							<thead>
								<tr>
									<th>Caixa aberto ás <?php echo date_format(date_create($valorCaixaInicial['caixa_data']), "H:i:s");?></th>
									<th><?php echo number_format($valorCaixaInicial['caixa_valor'],2,',','.');?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$amovimentacao = $caixaOBJ->listarMovimentacao();
								$sangriaTotal=0;$suprimentoTotal=0;
								foreach($amovimentacao as $movimentacao){
								?>
								<tr>
									<td><?php echo $movimentacao['caixa_status'];?></td>
									<td><?php echo number_format($movimentacao['caixa_total'],2,',','.');?></td>
									<?php
										if($movimentacao['caixa_status'] == 'Sangria'){
											$sangriaTotal = $movimentacao['caixa_total'];
										}else{
											$suprimentoTotal = $movimentacao['caixa_total'];
										}
									?>
								</tr>
								<?php };?>
							</tbody>
						</table>
					</div>

					<div class="col-sm-6">
						<p>Recebimentos</p>
						<table class="table table-striped" style="border:1px solid #ccc">
							<tbody>
								<?php
								$recebimentos = $caixaOBJ->listarRecebimentos();
								$totalRecebimentos=0;
								foreach($recebimentos as $recebimento){
								?>
								<tr>
									<td><?php echo $recebimento['pagamento_nome'];?></td>
									<td><?php echo number_format($recebimento['pagamento_valor'],2,',','.');?></td>
								</tr>
								<?php $totalRecebimentos = $totalRecebimentos + $recebimento['pagamento_valor']; };?>
								<tr>
									<td>Total</td>
									<td><?php echo number_format($totalRecebimentos,2,',','.'); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
					<div class="col-sm-6 form-group text-center">
						<h3>Total Geral</h3>
						<h3>R$ <?php echo number_format($valorCaixaInicial['caixa_valor']+$totalRecebimentos+$suprimentoTotal-$sangriaTotal, 2, ',', '.'); ;?></h3>
					</div>
					<div class="col-sm-6 form-group">
						<label for="valorFechaCaixa">Informe o valor que consta no caixa</label>
						<input type="valorFechaCaixa" name="valorFechaCaixa" id="valorFechaCaixa" class="form-control">
						<br>
						<button type="submit" class="btn btn-success" id="fechaCaixa_sim">Fechar Caixa</button>
						<button type="button" class="btn btn-default" id="fechaCaixa_nao" data-dismiss="modal">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="sangriaSuprimento">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Sangria / Suprimento</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo $url?>caixa/caixa/" method="POST">
				<div class="col-sm-6 form-group">
					<label for="caixa_status">Tipo de lançamento</label>
					<select name="caixa_status" id="caixa_status" class="form-control">
						<option>Sangria</option>
						<option>Suprimento</option>
					</select>
				</div>
				
				<div class="col-sm-6 form-group">
					<label for="caixa_valor">Informe o valor</label>
					<input type="text" class="form-control" name="caixa_valor" id="caixa_valor" autocomplete="off" required="required">
				</div>
					
				<div class="col-sm-12 form-group">
					<label for="caixa_obs">Motivo / Descrição</label>
					<textarea class="form-control" name="caixa_obs" id="caixa_obs" required="required"></textarea>
				</div>

				<div class="col-sm-12 form-group">
					<button type="submit" class="btn btn-success" id="sangriaSuprimento_sim">Salvar</button>
					<button type="button" class="btn btn-default" id="sangriaSuprimento_nao" data-dismiss="modal">Cancelar</button>
				</div>
				</form>
				<div class="clearfix"></div>
			</div>			
		</div>
	</div>
</div>

<?php
$scriptsJS .= '<script src="'.$url.'_plugins/jquery.maskMoney.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_plugins/jquery.mask.js"></script>';
$scriptsJS .= '<script src="'.$url.'_plugins/bootstrap3-typeahead.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/caixa/view/js/atalhos.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/caixa/view/js/caixa.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/caixa/view/js/autocomplete.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/caixa/view/js/validaCpf.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/caixa/view/js/cliente.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/caixa/view/js/pagamentos.js"></script>';
?>