<h3 class="page-header">Dados da Empresa</h3>
<form action="<?php echo $url;?>empresa/editar/" method="POST">

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Dados da Empresa</b></div>
		<div class="panel-body">
			<div class="form-group col-sm-12">
				<label for="empresa_nome">Nome Fantasia</label>  	
				<input type="text" class="form-control" autocomplete="off" required id="empresa_nome" name="empresa_nome" value="<?php echo $empresa['empresa_nome']; ?>">
			</div>

			<div class="form-group col-sm-12">
				<label for="empresa_razao">Razão Social</label>  	
				<input type="text" class="form-control" autocomplete="off" id="empresa_razao" name="empresa_razao" value="<?php echo $empresa['empresa_razao']; ?>">
			</div>

			<div class="form-group col-sm-3">
				<label for="empresa_cnpj">CNPJ</label>
				<input type="text" class="form-control" autocomplete="off" id="empresa_cnpj" name="empresa_cnpj" value="<?php echo $empresa['empresa_cnpj']; ?>">
			</div>

			<div class="form-group col-sm-3">
				<label for="empresa_ie">Inscrição Estadual</label>
				<input type="text" class="form-control" autocomplete="off" id="empresa_ie" name="empresa_ie" value="<?php echo $empresa['empresa_ie']; ?>">
			</div>

			<div class="form-group col-sm-3">
				<label for="empresa_im">Inscrição Municipal</label>
				<input type="text" class="form-control" autocomplete="off" id="empresa_im" name="empresa_im" value="<?php echo $empresa['empresa_im']; ?>">
			</div>

			<div class="form-group col-sm-3">
				<label for="empresa_RegTribISSQN">Regime Tributo ISSQN</label>
				<select class="form-control" id="empresa_RegTribISSQN" name="empresa_RegTribISSQN">
					<option value="1" <?php if($empresa['empresa_RegTribISSQN'] == "1"){echo "selected";} ?>>Microempresa Municipal</option>
				</select>
			</div>

			<div class="form-group col-sm-3">
				<label for="empresa_indRatISSQN">Rateio ISSQN</label>
				<select class="form-control" id="empresa_indRatISSQN" name="empresa_indRatISSQN">
					<option value="S" <?php if($empresa['empresa_indRatISSQN'] == "S"){echo "selected";} ?> title="Sim - Desconto sobre subtotal será rateado entre os itens sujeitos ao ISSQN.">Sim</option>
					<option value="N" <?php if($empresa['empresa_indRatISSQN'] == "N"){echo "selected";} ?> title="Não - Desconto sobre subtotal não será rateado entre os itens sujeitos ao ISSQN. Os itens sujeitos à tributação pelo ICMS sempre participarão do rateio, independente da participação dos itens sujeitos ao ISSQN.">Não</option>
				</select>
			</div>
			<div class="form-group col-sm-6">
				<label for="empresa_email_contabilidade">E-mail Contabilidade</label>  	
				<input type="text" class="form-control" value="<?php echo $empresa['empresa_email_contabilidade']; ?>" autocomplete="off" id="empresa_email_contabilidade" name="empresa_email_contabilidade">
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading"><b>Contato</b></div>
		<div class="panel-body">
			<div class="form-group col-sm-3">
				<label for="empresa_telefone">Telefone 1</label>  	
				<input type="text" class="form-control" value="<?php echo $empresa['empresa_telefone']; ?>" autocomplete="off" id="empresa_telefone" name="empresa_telefone">
			</div>

			<div class="form-group col-sm-3">
				<label for="empresa_telefone_outro">Telefone 2</label>
				<input type="text" class="form-control" value="<?php echo $empresa['empresa_telefone_outro']; ?>" autocomplete="off" id="empresa_telefone_outro" name="empresa_telefone_outro">
			</div>

			<div class="form-group col-sm-6">
				<label for="empresa_email">E-mail</label>  	
				<input type="text" class="form-control" value="<?php echo $empresa['empresa_email']; ?>" autocomplete="off" id="empresa_email" name="empresa_email">
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Endereço</b></div>
			<div class="panel-body">

				<div class="form-group col-sm-3">
					<label for="empresa_cep">Cep</label>  	
					<input type="text" class="form-control" value="<?php echo $empresa['empresa_cep']; ?>" autocomplete="off" id="empresa_cep" name="empresa_cep">
				</div>

				<div class="form-group col-sm-9">
					<label for="empresa_endereco">Endereço</label>  	
					<input type="text" class="form-control" value="<?php echo $empresa['empresa_endereco']; ?>" autocomplete="off" id="empresa_endereco" name="empresa_endereco">
				</div>

				<div class="form-group col-sm-3">
					<label for="empresa_numero">Numero</label>  	
					<input type="text" class="form-control" value="<?php echo $empresa['empresa_numero']; ?>" autocomplete="off" id="empresa_numero" name="empresa_numero">
				</div>

				<div class="form-group col-sm-9">
					<label for="empresa_complemento">complemento</label>  	
					<input type="text" class="form-control" value="<?php echo $empresa['empresa_complemento']; ?>" autocomplete="off" id="empresa_complemento" name="empresa_complemento">
				</div>

				<div class="form-group col-sm-6">
					<label for="empresa_bairro">Bairro</label>  	
					<input type="text" class="form-control" value="<?php echo $empresa['empresa_bairro']; ?>" autocomplete="off" id="empresa_bairro" name="empresa_bairro">
				</div>

				<div class="form-group col-sm-6">
					<label for="empresa_municipio">Municipio</label>  	
					<input type="text" class="form-control" value="<?php echo $empresa['empresa_municipio']; ?>" autocomplete="off" id="empresa_municipio" name="empresa_municipio">
				</div>

				<div class="form-group col-sm-2">
					<label for="empresa_uf">Estado</label>  	
					<input type="text" class="form-control" value="<?php echo $empresa['empresa_uf']; ?>" autocomplete="off" id="empresa_uf" name="empresa_uf">
				</div>				
			</div>

			<div class="panel-footer clearfix">
				<div class="col-sm-6">
					<a href="<?php echo $url;?>" class="form-control btn btn-default"> Cancelar </a>
				</div>
				<div class="col-sm-6">
					<button type="submit" class="form-control btn btn-success"> Salvar </button>
				</div>
			</div>
		</div>
	</div>
</form>
	<?php $scriptsJS .= '<script src="'.$url.'_modulos/empresa/view/js/cep.js"></script>';?>
	<?php $scriptsJS .= '<script src="'.$url.'_plugins/jquery.mask.js"></script>';?>
	<?php $scriptsJS .= '<script src="'.$url.'_modulos/empresa/view/js/empresa.js"></script>';?>