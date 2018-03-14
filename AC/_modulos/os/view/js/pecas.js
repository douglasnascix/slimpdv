var url = window.location.href
url = url.split("os/");

//busca produto
  function buscarProduto(){   
   produtoID = $("#produto_id").val().split("-")
   urlok = url[0] + "_modulos/caixa/src/produto.php?acao=listaNome&id="+produtoID[0];

   var jqxhr = $.getJSON( urlok, function(resultado) {
    if(resultado.nome != null){
      $("#produto_valor").val(resultado.valor);
    }

    
 })

 }

 $(document).ready(function () {
   $('input').keypress(function (e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        return (code == 13) ? false : true;
   });

   jQuery(function ($) {   
        $("#produto_valor").maskMoney({thousands:'.', decimal:',', allowZero:true});
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

$(".pecasExcluir").click(function(){
  dados = this.id.split('_');
  pedidoProdutoId = dados[0];
  produtoId = dados[1]
  produtoQtd = dados[2];

  urlExcluirPeca = url[0] + "_modulos/os/src/excluir.php?acao=peca&id="+pedidoProdutoId+"&produtoId="+produtoId+"&qtd="+produtoQtd;

  $.ajax({
    url: urlExcluirPeca,
  })
  .done(function(retorno) {
    if(retorno == 'ok'){
      window.location.reload(0);
    }
  })
  
});