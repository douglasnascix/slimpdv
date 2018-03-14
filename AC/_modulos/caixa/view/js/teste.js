function getMoney( valor ){
  var money = valor.replace( '.', '' );
  money = money.replace( ',', '.' );

  return parseFloat(money);
}

function formatReal(mixed) {
var int = parseInt(mixed.toFixed(2).toString().replace(/[^\d]+/g, ''));
var tmp = int + '';
tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
if (tmp.length > 6)
tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

return tmp;
}


$("#valorPagamento").maskMoney({thousands:'.', decimal:',', allowZero:true});

//url
  var url = window.location.href
  url = url.replace("caixa/teste/", "");
  urlPagamento = url + "_modulos/caixa/src/pagamento.php";


function limpa_valor(){
  $("#formaPagamento").focus();
  $("#valorPagamento").val("");
}


//add pagamento
function pagamento(){

  if(getMoney($("#valorPagamento").val()) > 0){

    var formaPagamento = $("#formaPagamento").val();
    var valorPagamento = $("#valorPagamento").val();

    urlPag = url+'_modulos/caixa/src/pagamento.php?acao=add&id='+formaPagamento+'&valor='+getMoney(valorPagamento);


    $.ajax({url: urlPag})
    .done(function() {
    	
    	$("#pagou").load(urlPagamento);
      limpa_valor()
    });

  }else{
    removePagamento($("#formaPagamento").val());
    limpa_valor()
  }
};


function removePagamento(id){
  urlRemovePag = url+'_modulos/caixa/src/pagamento.php?acao=del&id='+id;


    $.ajax({url: urlRemovePag})
    .done(function() {
      
      $("#pagou").load(urlPagamento);

    });
}




$("#valorPagamento").keypress(function(event){
	if(event.keyCode == 13){
		pagamento();
	}
});



$("#formaPagamento").on('change', function() {
  if(this.value == 2 || this.value == 3 || this.value == 10 ){

    $("#parcela").removeClass('hide');
    $("#vparcela").removeClass('hide');

  }else{

    $("#parcela").addClass('hide');
    $("#vparcela").addClass('hide');

  }
});


$("#pagou").load(urlPagamento);
limpa_valor()