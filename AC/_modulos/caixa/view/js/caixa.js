$(document).ready(function () {
    jQuery(function ($) {            
        if($("#cpf").val().replace(/[^0-9]/g,'').length == 14){
          $("#cpf").mask("00.000.000/0000-00");
        }else{
          $("#cpf").mask("000.000.000-00");
        }
        $("#produto_valor").maskMoney({thousands:'.', decimal:',', allowZero:true});
        $("#acrescimoDesconto").maskMoney({thousands:'.', decimal:',', allowZero:true});
    });
    $(".selecionaTudo").focus(function (e) {
      var that = this;
      setTimeout(function(){$(that).select();},15);
      return false;
    });
});


//enter = tab
$('.form-control').bind('keypress', function(event) {
  if(event.which === 13) {
    var nextItem = $($('.form-control')[$('.form-control').index(this)+1]);
    if( nextItem.size() === 0 ) {
      nextItem = $('.form-control').eq(0);
    }

    if($(this).attr('type') =='button'){
        event.preventDefault();
    }

    if($(this).attr('id') =='produto_valor'){
        
    }else{
      nextItem.focus();
    }
    
  }
});


//url
  var url = window.location.href
  url = url.replace("caixa/index/", "");
  urlListarTudo = url + "_modulos/caixa/src/produto.php?acao=listaTudo";
  urlCliente = url + "_modulos/caixa/src/cliente.php?acao=listaTudo";

//auto complete
  $.get(urlListarTudo, function(data){
    $("#nome").typeahead({ source:data.nome, minLength: 3, items: "all", });
  },'json')
  .done(function(){$("#nome").focus();});

//auto complete cliente
  $.get(urlCliente, function(data){
    $("#cliente_nome").typeahead({ source:data.nome, minLength: 3, items: "all", });
  },'json')
  .done(function(){$("#cliente_nome").focus();});

  
//busca produto
  function buscarProduto(id){
   var url = window.location.href
   url = url.replace("caixa/index/", "");
   url = url + "_modulos/caixa/src/produto.php?acao=listaNome&id="+$("#nome").val();

   var jqxhr = $.getJSON( url, function(resultado) {
    if(resultado.nome != null){
      $("#produto_id").val(resultado.pid);
      $("#produto_valor").val(resultado.valor);
      $("#produto_qtd").focus();
    }else{
     
     $("#alertasMensagem").text("Produto não encontrado.")
     $("#alertas").modal('show');
     

     $("#nome").val("");
     $("#nome").focus();
   }
 })

 }

 function apenasNumeros(string) {
    var numsStr = string.replace(/[^0-9]/g,'');
    return parseInt(numsStr);
}


 $("#nome").focusout(function(event) {
  if($("#nome").val().length != 0){
    if(apenasNumeros($("#nome").val())>0){
      buscarProduto();
    }    
  }
});

 $("#nome").focusin(function(event) {
  this.setSelectionRange(0, this.value.length)
});

 $("#nome").keypress(function(event) {
   if(event.keyCode == 13){
    if($("#nome").val().length > 0){
     buscarProduto();
   }
   if($("#nome").val().replace(/\D/g, '').length >= 13){
     buscarProduto();
     setTimeout(function(){
      add();
     }, 100);
   }
 }
});

$("#produto_qtd").keypress(function(event) {
   if(event.keyCode == 13){
    $("#produto_valor").focus();
   }
});

$("#produto_valor").keypress(function(event) {
   if(event.keyCode == 13){
    event.preventDefault(0);
    add();
   }
});


//carrinho
function add(){

  if($("#produto_id").val() > 0){

    produto_id = $("#produto_id").val();
    produto_qtd = $("#produto_qtd").val();
    produto_valor = $("#produto_valor").val();

    urlCart = url+'_modulos/caixa/src/carrinho.php?acao=add&id='+produto_id+'&qtd='+produto_qtd+'&valor='+getMoney(produto_valor);


    $.ajax({url: urlCart})
    .done(function() {
      location.reload();
    })
  }
};







////////////////////////////////////////////////////
/// cancela item
function cancela(id){
  urlRemove = url+"_modulos/caixa/src/carrinho.php?acao=cancela_item&id="+id;
  $.ajax({url: urlRemove})
  .done(function() {
    location.reload();
  })
}

$("#cancelar_id").keypress(function(event){
  if(event.keyCode == 13){
    cancela($("#cancelar_id").val());
  }
});

$("#btnCancelar").click(function(event){
  cancela($("#cancelar_id").val());
})
/// cancela item
////////////////////////////////////////////////////////////////////////////////




//finalizando a venda
$("#finalizaVenda").click(function(event) {

  $("#finalizaVenda").prop("disabled", true);

  if($("#cpf").val().length > 0){var cpf = $("#cpf").val();}else{var cpf = "";}
  if($("#vTotal").val().length > 0){var vTotal = $("#vTotal").val();}else{var vTotal = "";}
  if($("input[name='ad']:checked").val().length > 0){var ad = $("input[name='ad']:checked").val()}else{var ad = "";}  
  if($("#acrescimoDesconto").val().length > 0){var acrescimoDesconto = $("#acrescimoDesconto").val();}else{var acrescimoDesconto = "";}
  if($("#vTroco").val().length > 0){var vTroco = $("#vTroco").val();}else{var vTroco = "";}

  
  if($("#cliente_nome").val().length > 0){
    clienteSplit = $("#cliente_nome").val().split(" - ");
    cliente = clienteSplit[0];
  }else{
    cliente = "1";
  }

  if($("#trocoMSG").text() == "Falta: R$ "){
    
    $("#alertasMensagem").text("Você deve inserir as formas de pagamento.")
    $("#alertas").modal('show');
    
    
    $("#dinheiro").focus();
    return false;
  }




  var finalizando = $.ajax({
    url: url+"caixa/index/",
    type: 'POST',   
    data: {cpf:cpf, cliente_id:cliente, vTotal:vTotal, ad:ad, vTroco:vTroco, acrescimoDesconto: acrescimoDesconto},
    success: function(){
      
      $("#pagamentos").modal('hide');
      $("#bg-loader").css('display','block');
      
      setTimeout(function(){ 
        $("#finalizar-Venda").modal('show');
        $("#bg-loader").css('display','none');
      }, 1000);
      
          
  }
  })

})

$('#finalizar-Venda').on('shown.bs.modal', function () {
  $("#emitir_cupom").focus();
})


$("#emitir_cupom").click(function() {
  location.href = url+"_modulos/caixa/src/sat.php?acao=emitir";
});


$("#imprimir_cupom").click(function() {
  location.href = url+"_modulos/caixa/src/print.php";
});


$("#fechar_venda").click(function() {
  location.href = url+"_modulos/caixa/src/limpa.php?fechar=1";
});


function geraOrcamento(){

  $("#gerarOrcamento").modal('hide');
  
  if($("#cpf").val().length > 0){var cpf = $("#cpf").val();}else{var cpf = "";}
  if($("#vTotal").val().length > 0){var vTotal = $("#vTotal").val();}else{var vTotal = "";}
  
  if($("#cliente_nome").val().length > 0){
    clienteSplit = $("#cliente_nome").val().split(" - ");
    cliente = clienteSplit[0];
  }else{
    cliente = "1";
  }

  var finalizando = $.ajax({
    url: url+"caixa/orcamento/",
    type: 'POST',   
    data: {cpf:cpf, cliente_id:cliente, vTotal:vTotal},
    success: function(resultado){
     
      $("#bg-loader").css('display','block');
      $("#emitir_cupom").prop("disabled", true);
      
      setTimeout(function(){ 
        $("#finalizar-Venda").modal('show');
        $("#bg-loader").css('display','none');
      }, 1000);           
    }
  })
}

$("#orcamento_sim").click(function() {
  geraOrcamento()
});

$("#valorFechaCaixa").maskMoney({thousands:'.', decimal:',', allowZero:true});
$("#caixa_valor").maskMoney({thousands:'.', decimal:',', allowZero:true});