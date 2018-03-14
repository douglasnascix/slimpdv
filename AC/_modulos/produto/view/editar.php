<h3 class="page-header">Catalogo / Produto / Editar</h3>

<form action="<?php echo $url;?>produto/editar/<?php echo $produto[0];?>/" method="POST" enctype="multipart/form-data" id="form">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Dados do Produto</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-3">
					<label for="produto_nome">Cod</label>  	
					<input type="text" class="form-control" id="produto_id" name="produto_id" readonly value="<?php echo $produto[0]?>">
				</div>
				<div class="text-right col-sm-9">
					<a href="<?php echo $url;?>produto/cadastrar/" class="btn btn-primary"><span class="fa fa-plus-circle"></span> F2 - Novo </a>
				</div>
				<div class="form-group col-sm-12">
					<label for="produto_nome">Nome</label>  	
					<input type="hidden" id="produto_id" name="produto_id" value="<?php echo $produto[0]?>">
					<input type="text" class="form-control" autocomplete="off" required id="produto_nome" name="produto_nome" value="<?php echo $produto['produto_nome']?>">
				</div>

				<div class="form-group col-sm-12">
					<label for="produto_codBarras">Cod. Barras</label>  	
					<div class="form-group input-group col-sm-12">
						<span class="input-group-addon"><i class="fa fa-barcode"></i></span>
						<input type="text" class="form-control" autocomplete="off" id="produto_codBarras" name="produto_codBarras" value="<?php echo $produto['produto_codBarras']?>">
					</div>
				</div>

				

				<div class="form-group col-sm-12">
					<label for="produto_categoria">Categoria</label>  	
					<select id="produto_categoria" class="form-control" name="produto_categoria">
					    <option value="0">Selecione uma Categoria</option>
					    <?php 
					    foreach ($categorias as $categoria) {
					    	
					    	if($categoria[0] == $produto['produto_categoria']){ $selecionado = "selected";}
					    	else{$selecionado = "";};

					    	echo '<option value="'.$categoria[0].'" '.$selecionado.' >'.$categoria[1].'</option>';
					    }?>					    
					</select>
				</div>
				
				<div class="row"></div>

				<div class="form-group col-sm-6">
					<label for="produto_custo">Custo</label>
					<div class="form-group input-group col-sm-12">
						<span class="input-group-addon">R$</span>
						<input type="text" class="form-control" autocomplete="off" id="produto_custo" name="produto_custo" value="<?php echo number_format($produto['produto_custo'], 2, ",", ".");?>">
					</div>
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_preco">Preço de Venda</label>  	
					<div class="form-group input-group col-sm-12">
						<span class="input-group-addon">R$</span>
						<input type="text" class="form-control" autocomplete="off" required id="produto_preco" name="produto_preco" value="<?php echo number_format($produto['produto_preco'], 2, ",", "."); ?>">
					</div>
				</div>
				
				<div class="form-group col-sm-6">
					<label for="produto_estoque">Estoque</label>
					<input type="number" class="form-control" autocomplete="off" id="produto_estoque" name="produto_estoque" min="0" value="<?php echo $produto['produto_estoque']?>">
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_estoque_min">Estoque Mínimo</label>
					<input type="number" class="form-control" autocomplete="off" id="produto_estoque_min" name="produto_estoque_min" min="0" value="<?php echo $produto['produto_estoque_min']?>">
				</div>


				<div class="form-group col-sm-3">
					<label for="produto_unidade">Unidade Comercial</label>  	
					<select id="produto_unidade" class="form-control" name="produto_unidade">
					    <option value="UN" <?php if($produto['produto_unidade'] == "UN"){echo "selected";} ?>>UN</option>
					    <option value="PC" <?php if($produto['produto_unidade'] == "PC"){ echo "selected";}?>>PC</option>
					    <option value="CX" <?php if($produto['produto_unidade'] == "CX"){ echo "selected";}?>>CX</option>
					    <option value="KG" <?php if($produto['produto_unidade'] == "KG"){ echo "selected";}?>>KG</option>
					    <option value="MT" <?php if($produto['produto_unidade'] == "MT"){ echo "selected";}?>>MT</option>
					</select>
				</div>

				<div class="form-group col-sm-3">
					<label for="produto_cst">CST</label>
					<select id="produto_cst" class="form-control" name="produto_cst">
					    <option value="0" <?php if($produto['produto_cst'] == "0"){echo "selected";} ?>>Nacional</option>
					    <option value="1" <?php if($produto['produto_cst'] == "1"){echo "selected";} ?>>Importado</option>
					</select>
				</div>

				<div class="form-group col-sm-3">
					<label for="produto_ncm">NCM</label>
					<input type="number" class="form-control" autocomplete="off" id="produto_ncm" name="produto_ncm" min="0" value="<?php echo $produto['produto_ncm']?>">
				</div>

				<div class="form-group col-sm-3">
					<label for="produto_cest">CEST</label>
					<input type="number" class="form-control" autocomplete="off" id="produto_cest" name="produto_cest" min="0" value="<?php echo $produto['produto_cest']?>">
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_cfop">CFOP</label>
					<input type="text" name="produto_cfop" id="produto_cfop" class="form-control" value="<?php echo $produto['produto_cfop']; ?>">
				</div>

				<div class="form-group col-sm-6">
					<label for="produto_csosn">CSOSN</label>
					<select id="produto_csosn" class="form-control" name="produto_csosn">
					    <option value="102" <?php if($produto['produto_csosn'] == "102"){echo "selected";} ?>>102 - Tributada pelo Simples Nacional sem permissão de crédito.</option>
					    <option value="300" <?php if($produto['produto_csosn'] == "300"){echo "selected";} ?>>300 – Imune</option>
					    <option value="400" <?php if($produto['produto_csosn'] == "400"){echo "selected";} ?>>400 – Não tributada</option>
					    <option value="500" <?php if($produto['produto_csosn'] == "500"){echo "selected";} ?>>500 – ICMS cobrado anteriormente por substituição tributária (substituído) ou por antecipação</option>
					</select>
				</div>

			</div>
			<div class="panel-footer clearfix">
				<div class="form-group col-sm-4">
					<a href="<?php echo $url;?>produto/listar/" class="form-control btn btn-default">ESC - Cancelar </a>
				</div>
				<div class="form-group col-sm-4">
					<button type="button" class="form-control btn btn-primary" id="btnCadastrarNovo"> Salvar Novo</button>
				</div>
				<div class="form-group col-sm-4">
					<button type="submit" class="form-control btn btn-success" id="btnCadastrar">F4 - Salvar </button>
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