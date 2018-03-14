//desativa F1
$(document).keydown(function (e) {
  if(e.which == 112){
    e.preventDefault();
  }
});


//F1
$(document).keydown(function (e) {
  if(e.which == 112){
    e.preventDefault();
     $("#cancelarModal").modal('show');
     $("#cancelarModal").on('shown.bs.modal', function () {

      $("#cancelar_id").focus();
     })
  }
});


//F2
$(document).keydown(function (e) {
  if(e.which == 113){
    if(getMoney($("#vSTotal").val()) > 0){
      $("#pagamentos").modal('show');
      return false;
    }
   } 
});


//F4
$(document).keydown(function (e) {
  if(e.which == 115){
    e.preventDefault();
    $("#clienteModal").modal('show');
    return false;
   } 
});


//F3
$(document).keydown(function (e) {
  if(e.which == 114){
    e.preventDefault();
    $("#cpfModal").modal('show');
    return false;
   } 
});



//F10

$(document).keydown(function (e) {
  if(e.which == 121){
    e.preventDefault();

    cpfSession = url+"_modulos/caixa/src/cpf.php?cpf=";
    $.ajax({url: cpfSession});

    clienteSession = url+"_modulos/caixa/src/cliente.php?cliente_nome=";
    $.ajax({url: clienteSession});

    pagamentoSession = url+"_modulos/caixa/src/pagamento.php?acao=limpa_tudo";
    $.ajax({url: pagamentoSession});

    urlRemove = url+"_modulos/caixa/src/carrinho.php?acao=limpa_tudo";
    $.ajax({url: urlRemove})
    .done(function() {
      location.reload();
    })
  }
});

/// nova venda
////////////////////////////////////////////////////




//F7
$(document).keydown(function (e) {
  if(e.which == 118){
    e.preventDefault();

    if(getMoney($("#vSTotal").val()) > 0){      
      $("#gerarOrcamento").modal('show');
      
      $("#gerarOrcamento").on('shown.bs.modal', function () {
        $("#orcamento_sim").focus();
     })
    }
  }
});

//F8
$(document).keydown(function (e) {
  if(e.which == 119){
    e.preventDefault();
     $("#sangriaSuprimento").modal('show');
     $("#sangriaSuprimento").on('shown.bs.modal', function () {
      $("#caixa_status").focus();
     })
  }
});

//F9
$(document).keydown(function (e) {
  if(e.which == 120){
    e.preventDefault();
     $("#fechaCaixa").modal('show');
     $("#fechaCaixa").on('shown.bs.modal', function () {
      $("#caixa_valor").focus();
     })
  }
});