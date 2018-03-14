function apagar(id){
	$('#editar').modal()
}

$("#cliente_cnpj").mask("00.000.000/0000-00");

$("#cliente_cpf").mask("000.000.000-00");
$("#cliente_rg").mask("00.000.000-X", 
	{'translation': 
		{
    		X: {pattern: /[A-Za-z0-9]/}
		}
	}
);

$("#cliente_cep").mask("00000-000");
$("#cliente_telefone").mask("(00) 0000-0000");
$("#cliente_telefone_comercial").mask("(00) 0000-0000");
$("#cliente_celular").mask("(00) 00000-0000");
$("#cliente_outros").mask("(00) 00000-0000");