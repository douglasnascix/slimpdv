<h1 class="page-header">Clientes / Editar</h1>

<form action="<?php echo $url;?>cliente/editar/<?php echo $cliente[0]; ?>/" method="POST" style="text-transform: capitalize;">

	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Dados Pessoais</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="cliente_nome">nome</label>  	
					<input type="hidden" value="<?php echo $cliente[0]; ?>" id="cliente_id" name="cliente_id">
					<input type="text" class="form-control" value="<?php echo $cliente[1]; ?>" autocomplete="off" required id="cliente_nome" name="cliente_nome">
				</div>

				<div class="form-group col-sm-12">
					<label for="cliente_razao">razao</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[2]; ?>" autocomplete="off" id="cliente_razao" name="cliente_razao">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_cnpj">cnpj</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[3]; ?>" autocomplete="off" id="cliente_cnpj" name="cliente_cnpj">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_ie">ie</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[4]; ?>" autocomplete="off" id="cliente_ie" name="cliente_ie">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_cpf">cpf</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[5]; ?>" autocomplete="off" id="cliente_cpf" name="cliente_cpf">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_rg">rg</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[6]; ?>" autocomplete="off" id="cliente_rg" name="cliente_rg">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Endereço</b></div>
			<div class="panel-body">

				<div class="form-group col-sm-3">
					<label for="cliente_cep">cep</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[13]; ?>" autocomplete="off" id="cliente_cep" name="cliente_cep">
				</div>

				<div class="form-group col-sm-9">
					<label for="cliente_endereco">endereco</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[7]; ?>" autocomplete="off" id="cliente_endereco" name="cliente_endereco">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_numero">numero</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[8]; ?>" autocomplete="off" id="cliente_numero" name="cliente_numero">
				</div>

				<div class="form-group col-sm-9">
					<label for="cliente_complemento">complemento</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[9]; ?>" autocomplete="off" id="cliente_complemento" name="cliente_complemento">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_bairro">bairro</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[10]; ?>" autocomplete="off" id="cliente_bairro" name="cliente_bairro">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_municipio">municipio</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[11]; ?>" autocomplete="off" id="cliente_municipio" name="cliente_municipio">
				</div>

				<div class="form-group col-sm-2">
					<label for="cliente_uf">Estado</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[12]; ?>" autocomplete="off" id="cliente_uf" name="cliente_uf">
				</div>

				
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Contato</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-3">
					<label for="cliente_telefone">telefone</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[14]; ?>" autocomplete="off" id="cliente_telefone" name="cliente_telefone">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_telefone_comercial">comercial</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[15]; ?>" autocomplete="off" id="cliente_telefone_comercial" name="cliente_telefone_comercial">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_celular">celular</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[16]; ?>" autocomplete="off" id="cliente_celular" name="cliente_celular">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_outros">outros</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[17]; ?>" autocomplete="off" id="cliente_outros" name="cliente_outros">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_email">email</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[18]; ?>" autocomplete="off" id="cliente_email" name="cliente_email">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_site">site</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[19]; ?>" autocomplete="off" id="cliente_site" name="cliente_site">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_contato">contato</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[20]; ?>" autocomplete="off" id="cliente_contato" name="cliente_contato">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_contato_email">contato email</label>  	
					<input type="text" class="form-control" value="<?php echo $cliente[21]; ?>" autocomplete="off" id="cliente_contato_email" name="cliente_contato_email">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Outros</b></div>
			<div class="panel-body">

				<div class="form-group col-sm-6">
					<label for="cliente_data_cadastro">Data Cadastro</label>  	
					<input type="text" class="form-control" value="<?php echo date_format(date_create($cliente[22]), "d/m/Y H:i:s"); ?>" disabled autocomplete="off" id="cliente_data_cadastro" name="cliente_data_cadastro">
				</div>
				<div class="form-group col-sm-6">
					<label for="cliente_data_atualizado">Data Atualização</label>  	
					<input type="text" class="form-control" value="<?php echo date_format(date_create($cliente[23]), "d/m/Y H:i:s"); ?>" disabled autocomplete="off" id="cliente_data_atualizado" name="cliente_data_atualizado">
				</div>

				<div class="form-group col-sm-12">
					<label for="cliente_obs">obs</label>  	
					<textarea name="cliente_obs" class="form-control" autocomplete="off" id="cliente_obs" rows="3"><?php echo $cliente[25]; ?></textarea>
				</div>
			</div>
			<div class="panel-footer clearfix">
				<div class="form-group col-sm-6">
					<a href="<?php echo $url;?>cliente/listar/" class="form-control btn btn-default">ESC - Cancelar </a>
				</div>
				<div class="form-group col-sm-6">
					<button type="submit" class="form-control btn btn-success" id="btnCadastrar">F4 - Salvar </button>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
<?php
$scriptsJS = '<script src="'.$url.'_modulos/cliente/view/js/cep.js"></script>';
$scriptsJS .= '<script src="'.$url.'_plugins/jquery.mask.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/cliente/view/js/clientes.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/cliente/view/js/atalhos.js"></script>';
?>