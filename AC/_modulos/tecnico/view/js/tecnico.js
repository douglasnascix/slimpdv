$("form").submit(function(event) {

	//valida email
	/*er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
	if(!er.exec($("#tecnico_email").val())){

		$("#tecnico_email").focus();
		
		alert("Email Inválido !");
		event.preventDefault();
	}*/

	
	//valida senha
	if($("#tecnico_senha").val() !== $("#tecnico_senha2").val()){
	   
		$("#tecnico_senha").val("")
		$("#tecnico_senha2").val("")

		$("#tecnico_senha").focus();
		
		alert("Senhas não confere !");
		event.preventDefault();
	}
	

	$(".btn-success").prop('disabled', 'disabled');
    return;
	

	
});