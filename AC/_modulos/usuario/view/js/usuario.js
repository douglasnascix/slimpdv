$("form").submit(function(event) {

	//valida email
	/*er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
	if(!er.exec($("#usuario_email").val())){

		$("#usuario_email").focus();
		
		alert("Email Inválido !");
		event.preventDefault();
	}*/

	
	//valida senha
	if($("#usuario_senha").val() !== $("#usuario_senha2").val()){
	   
		$("#usuario_senha").val("")
		$("#usuario_senha2").val("")

		$("#usuario_senha").focus();
		
		alert("Senhas não confere !");
		event.preventDefault();
	}
	

	$(".btn-success").prop('disabled', 'disabled');
    return;
	

	
});