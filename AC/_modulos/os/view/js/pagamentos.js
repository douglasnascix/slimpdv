var url = window.location.href
url = url.split("os/");

$("#pagamento_data").datepicker({
    format: "dd/mm/yyyy",
    weekStart: 0,
    language: "pt-BR",
    orientation: "top auto",
    autoclose: true,
    todayHighlight: true,
});


$(document).ready(function () {
    jQuery(function ($) {   
        $("#pagamento_valor").maskMoney({thousands:'.', decimal:',', allowZero:true});
    });
    $(".selecionaTudo").focus(function (e) {
      var that = this;
      setTimeout(function(){$(that).select();},15);
      return false;
    });
});



function apenasNumeros(string) {
  var numsStr = string.replace(/[^0-9]/g,'');
  return parseInt(numsStr);
}

$(".pagamentoExcluir").click(function(){
  pedidoProduto = apenasNumeros(this.id);

  urlExcluirPeca = url[0] + "_modulos/os/src/excluir.php?acao=pagamento&id="+pedidoProduto;

  $.ajax({
    url: urlExcluirPeca,
  })
  .done(function(retorno) {
    if(retorno == 'ok'){
      window.location.reload(0);
    }
  })
  
});