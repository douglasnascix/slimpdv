$('#cpfModal').on('shown.bs.modal', function () {
  $('#cpf').focus();
})

$('#btn-cpf').click(function(event) {
  $("#cpfModal").modal('show');
});


$("#cpf").keypress(function(event){
  if(event.keyCode == 13){
    $("#cpfModal").modal('hide');
    $("#nome").focus();
  }
});


function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}

function validaCPF(cpf)
{
  var numeros, digitos, soma, i, resultado, digitos_iguais;
  digitos_iguais = 1;
  if (cpf.length < 11)
    return false;
  for (i = 0; i < cpf.length - 1; i++)
    if (cpf.charAt(i) != cpf.charAt(i + 1))
    {
      digitos_iguais = 0;
      break;
    }
    if (!digitos_iguais)
    {
      numeros = cpf.substring(0,9);
      digitos = cpf.substring(9);
      soma = 0;
      for (i = 10; i > 1; i--)
        soma += numeros.charAt(10 - i) * i;
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(0))
        return false;
      numeros = cpf.substring(0,10);
      soma = 0;
      for (i = 11; i > 1; i--)
        soma += numeros.charAt(11 - i) * i;
      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
      if (resultado != digitos.charAt(1))
        return false;
      return true;
    }
    else
      return false;
  }

  $("#cpf").focusout(function(event) {

  	cpfLimpo = $("#cpf").val().replace(/[^0-9]/g,'');

  	if(cpfLimpo.length == 11){
      if(!validaCPF(cpfLimpo)){
       $("#alertasMensagem").text("CPF Inválido")
       $("#alertas").modal('show');
       $("#cpf").val("");
       $("#cpf").focus();
     }else{
      //cpf na session
      cpfSession = url+"_modulos/caixa/src/cpf.php?cpf="+$("#cpf").val();
      $.ajax({url: cpfSession});
     };   
   }

   if(cpfLimpo.length == 14){
    if(validarCNPJ(cpfLimpo)){
      // cnpj na session
      cpfSession = url+"_modulos/caixa/src/cpf.php?cpf="+$("#cpf").val();
      $.ajax({url: cpfSession});
    }else{
      $("#alertasMensagem").text("CNPJ Inválido")
       $("#alertas").modal('show');
       $("#cpf").val("");
       $("#cpf").focus();
    }
  }
 });


$("#cpfCnpj").change(function(){

  if(this.value == "cnpj"){
    $("#cpf").mask("00.000.000/0000-00");
  }else{
    $("#cpf").mask("000.000.000-00");
  }
  $("#cpf").focus();
})