<h3 class="page-header">Catalogo / Produto / Cadastrar</h3>

<form action="<?php echo $url;?>produto/cadastrar/" method="POST" enctype="multipart/form-data" id="form">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Dados do Produto</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="produto_nome">Nome</label>  	
					<input type="text" class="form-control" autocomplete="off" required autofocus="true" id="produto_nome" name="produto_nome">
				</div>

				<div class="form-group col-sm-12">
					<label for="produto_codBarras">Cod. Barras</label>  	
					<div class="form-group input-group col-sm-12">
						<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
						<input type="text" class="form-control" autocomplete="off" id="produto_codBarras" name="produto_codBarras">
					</div>
				</div>


				<div class="form-group col-sm-12">
					<label for="produto_categoria">Categoria</label>  	
					<select id="produto_categoria" class="form-control" name="produto_categoria">
					    <option value="0">Selecione uma Categoria</option>
					    <?php 
					    foreach ($categorias as $categoria) {
					    	echo '<option value="'.$categoria[0].'">'.$categoria[1].'</option>';
					    }?>					    
					</select>
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_custo">Custo</label>
					<div class="form-group input-group col-sm-12">
						<span class="input-group-addon">R$</span>
						<input type="text" class="form-control" autocomplete="off" id="produto_custo" name="produto_custo">
					</div>
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_preco">Preço de Venda</label>  	
					<div class="form-group input-group col-sm-12">
						<span class="input-group-addon">R$</span>
						<input type="text" class="form-control" autocomplete="off" required id="produto_preco" name="produto_preco">
					</div>
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_estoque">Estoque</label>
					<input type="number" class="form-control" autocomplete="off" id="produto_estoque" name="produto_estoque" min="0">
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_estoque_min">Estoque Mínimo</label>
					<input type="number" class="form-control" autocomplete="off" id="produto_estoque_min" name="produto_estoque_min" min="0">
				</div>


				<div class="form-group col-sm-3">
					<label for="produto_unidade">Unidade Comercial</label>  	
					<select id="produto_unidade" class="form-control" name="produto_unidade">
					    <option value="UN">UN</option>
					    <option value="PC">PC</option>
					    <option value="CX">CX</option>
					    <option value="KG">KG</option>
					    <option value="MT">MT</option>
					</select>
				</div>

				<div class="form-group col-sm-3">
					<label for="produto_cst">CST</label>
					<select id="produto_cst" class="form-control" name="produto_cst">
					    <option value="0">Nacional</option>
					    <option value="1">Importado</option>
					</select>
				</div>

				<div class="form-group col-sm-3">
					<label for="produto_ncm">NCM</label>
					<input type="number" class="form-control" autocomplete="off" id="produto_ncm" name="produto_ncm" min="0">
				</div>

				<div class="form-group col-sm-3">
					<label for="produto_cest">CEST</label>
					<input type="number" class="form-control" autocomplete="off" id="produto_cest" name="produto_cest" min="0">
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_cfop">CFOP</label>
					<input type="text" name="produto_cfop" id="produto_cfop" class="form-control">
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_csosn">CSOSN</label>
					<select id="produto_csosn" class="form-control" name="produto_csosn">
					    <option value="102">102- Tributada pelo Simples Nacional sem permissão de crédito.</option>
					    <option value="300">300 – Imune</option>
					    <option value="400">400 – Não tributada</option>
					    <option value="500">500 – ICMS cobrado anteriormente por substituição tributária (substituído) ou por antecipação</option>
					</select>
				</div>


			</div>
			<div class="panel-footer clearfix">
				<div class="form-group col-sm-6">
					<a href="<?php echo $url;?>produto/listar/" class="form-control btn btn-default">ESC - Cancelar </a>
				</div>
				<div class="form-group col-sm-6">
					<button type="submit" class="form-control btn btn-success" id="btnCadastrar">F4 - Cadastrar </button>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
<?php
$scriptsJS = '<script src="'.$url.'_plugins/jquery.maskMoney.min.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/produto/view/js/produtos.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/produto/view/js/atalhos.js"></script>';

?>