$('#clienteModal').on('shown.bs.modal', function () {
  $('#cliente_nome').focus();
})


$("#cliente_nome").keypress(function(event){
  if(event.keyCode == 13){
    $("#clienteModal").modal('hide');
    $("#nome").focus();
  }
});

$("#cliente_nome").focusout(function(){
	clienteSession = url+"_modulos/caixa/src/cliente.php?cliente_nome="+$("#cliente_nome").val();
      $.ajax({url: clienteSession});
});