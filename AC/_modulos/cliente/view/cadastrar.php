<h3 class="page-header">Cliente / Cadastrar</h3>

<form action="<?php echo $url;?>cliente/cadastrar/" method="POST" style="text-transform: capitalize;">

	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Dados Pessoais</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="cliente_nome">nome</label>  	
					<input type="text" class="form-control" autocomplete="off" required id="cliente_nome" name="cliente_nome">
				</div>

				<div class="form-group col-sm-12">
					<label for="cliente_razao">razao</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_razao" name="cliente_razao">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_cnpj">cnpj</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_cnpj" name="cliente_cnpj">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_ie">ie</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_ie" name="cliente_ie">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_cpf">cpf</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_cpf" name="cliente_cpf">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_rg">rg</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_rg" name="cliente_rg">
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
					<input type="text" class="form-control" autocomplete="off" id="cliente_cep" name="cliente_cep">
				</div>

				<div class="form-group col-sm-9">
					<label for="cliente_endereco">endereco</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_endereco" name="cliente_endereco">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_numero">numero</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_numero" name="cliente_numero">
				</div>

				<div class="form-group col-sm-9">
					<label for="cliente_complemento">complemento</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_complemento" name="cliente_complemento">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_bairro">bairro</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_bairro" name="cliente_bairro">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_municipio">municipio</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_municipio" name="cliente_municipio">
				</div>

				<div class="form-group col-sm-2">
					<label for="cliente_uf">uf</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_uf" name="cliente_uf">
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
					<input type="text" class="form-control" autocomplete="off" id="cliente_telefone" name="cliente_telefone">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_telefone_comercial">comercial</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_telefone_comercial" name="cliente_telefone_comercial">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_celular">celular</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_celular" name="cliente_celular">
				</div>

				<div class="form-group col-sm-3">
					<label for="cliente_outros">outros</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_outros" name="cliente_outros">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_email">email</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_email" name="cliente_email">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_site">site</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_site" name="cliente_site">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_contato">contato</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_contato" name="cliente_contato">
				</div>

				<div class="form-group col-sm-6">
					<label for="cliente_contato_email">contato email</label>  	
					<input type="text" class="form-control" autocomplete="off" id="cliente_contato_email" name="cliente_contato_email">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Outros</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="cliente_obs">obs</label>  	
					<textarea name="cliente_obs" class="form-control" autocomplete="off" id="cliente_obs" rows="3"></textarea>
				</div>
			</div>
			<div class="panel-footer clearfix">
				<div class="form-group col-sm-6">
					<a href="<?php echo $url;?>cliente/listar/" class="form-control btn btn-default">ESC - Cancelar </a>
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
$scriptsJS = '<script src="'.$url.'_modulos/cliente/view/js/cep.js"></script>';
$scriptsJS .= '<script src="'.$url.'_plugins/jquery.mask.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/cliente/view/js/clientes.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/cliente/view/js/atalhos.js"></script>';
?>