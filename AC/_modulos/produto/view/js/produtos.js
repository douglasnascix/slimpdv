$("#produto_custo").maskMoney({thousands:'.', decimal:',', allowZero:true});
$("#produto_preco").maskMoney({thousands:'.', decimal:',', allowZero:true});
$("#produto_preco2").maskMoney({thousands:'.', decimal:',', allowZero:true});

$("#form").submit(function() {
	$(".btn-success").prop('disabled', 'disabled')

	if($("#produto_preco").val() == "0,00"){
		$(".btn-success").removeAttr('disabled');
		alert("Digite o valor de venda");
		$("#produto_preco").focus();
		return false;
	}

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
    nextItem.focus();
  }
});

$(document).ready(function () {
   $('input').keypress(function (e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        return (code == 13) ? false : true;
   });
});


$("btn-excluir").click(function() {
	$("#form").submit(function(){
		
	});
});

  var urlCompleta = window.location.href
  urlCompleta = urlCompleta.split("produto/");


$("#produto_codBarras").focusout(function(){

  if(!$("#produto_id").val() > 0){
    var url_codBarras = urlCompleta[0] + "produto/codBarras/";

    $.ajax({
      method: "POST",
      url: url_codBarras,
      data:{busca: $("#produto_codBarras").val()}
    })
    .done(function(retorno) {
      if(retorno > 0){
        //codigo de barras ja cadastrado
        alert("Código de barras ja cadastrado para outro produto.");
        $("#produto_codBarras").focus();
        $("#produto_codBarras").val("");
      };
    })

  }

})


$("#btnCadastrarNovo").click(function(){

  acaoEditar = $("form").attr('action');
  acaoNovo = acaoEditar.split("editar");
  acaoCadastrar = acaoNovo[0] + "cadastrar/";

  $("form").attr('action', acaoCadastrar);
  $("form").submit();

})