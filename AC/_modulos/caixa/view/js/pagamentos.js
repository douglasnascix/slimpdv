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
////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////
////////////////////////////////////////////////


$("#btn-pagamento").click(function(event) {
  $("#pagamentos").modal('show');
});

$('#pagamentos').on('shown.bs.modal', function () {
  $('#acrescimoDesconto').focus();
  $('#valorPagamento').val($("#vTotal").val());
})


$("#valorPagamento").maskMoney({thousands:'.', decimal:',', allowZero:true});

//url
  var url = window.location.href
  url = url.replace("caixa/index/", "");
  urlPagamento = url + "_modulos/caixa/src/pagamento.php";


function limpa_valor(){
  $("#formaPagamento").focus();
  $("#valorPagamento").val("");
  $("#parcelas").val('1');
  $("#vParcela").val("0,00");
}


$("#parcela").change(function(){

  if(getMoney($("#valorPagamento").val()) > 0){

    var a = getMoney($("#valorPagamento").val());
    var b = $("#parcelas").val()

    valorParcela = a/b;

    $("#vParcela").val(formatReal(valorParcela));
  }

})



//add pagamento
function pagamento(){

  if(getMoney($("#valorPagamento").val()) > 0){

    var formaPagamento = $("#formaPagamento").val();
    var valorPagamento = $("#valorPagamento").val();
    var parcelas = $("#parcelas").val();

    urlPag = url+'_modulos/caixa/src/pagamento.php?acao=add&id='+formaPagamento+'&valor='+getMoney(valorPagamento)+'&parcela='+parcelas;


    $.ajax({url: urlPag})
    .done(function() {
      
      $("#pagou").load(urlPagamento, function(){
          troco();

          if($("#vTroco").val() == 0){
            $("#finalizaVenda").focus();
          }

      });
      limpa_valor()
    });



  }else{
    removePagamento($("#formaPagamento").val());
    limpa_valor()
    troco();
  }
};


function removePagamento(id){
  urlRemovePag = url+'_modulos/caixa/src/pagamento.php?acao=del&id='+id;


    $.ajax({url: urlRemovePag})
    .done(function() {
      
      $("#pagou").load(urlPagamento, function(){
          troco();
      });

    });
}

$("#valorPagamento").focusin(function(){
  if($("#trocoMSG").text() == "Troco: R$ "){
    this.value = "";
  }else{
    this.value = $("#vTroco").val()
  }
  

});


$("#acrescimoDescontoPorcentagem").focusout(function(event){
  if(this.value > 99){
    this.value = 99;
  }

  
  if(this.value != 0){
    porcentagem = getMoney($("#vSTotal").val()) * this.value / 100;
    $("#acrescimoDesconto").val(formatReal(porcentagem));
  }else{

  };

  calculaTudo();

});





$("#valorPagamento").keypress(function(event){
  if(event.keyCode == 13){
    pagamento();
  }
});

$("#formaPagamento").keypress(function(event){
  if(event.keyCode == 13){
    $("#valorPagamento").focus();
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

$('input[type=radio][name=ad]').change(function() {
  calculaTudo();
})




vTrocoTotal =0;
//calcula troco
function troco(){
    vTrocoTotal = getMoney($("#totalPago").val()) - getMoney($("#vTotal").val())
  
    if(vTrocoTotal > 0){
      $("#divTroco").removeClass("hide");
      $("#trocoMSG").text("Troco: R$ ");
    }else{
      $("#divTroco").removeClass("hide");
      $("#trocoMSG").text("Falta: R$ ");
    }

    $("#troco").text(formatReal(vTrocoTotal));
    $("#vTroco").val(formatReal(vTrocoTotal));

    if(vTrocoTotal == 0){
      $("#divTroco").addClass("hide");
      $("#troco").text("");
      $("#trocoMSG").text("");
      $("#vTroco").val(0);

    }

    if($("#trocoMSG").text() != "Falta: R$ "){
      $("#finalizaVenda").removeClass('hide');
      $("#finalizaVenda").focus();
    }else{
      $("#finalizaVenda").addClass('hide');
    }
};




// acrescimo e desconto'
function calculaTudo(){
  if($("input[name='ad']:checked").val() == "acrescimo"){

    var totalGeral = getMoney($("#vSTotal").val()) + getMoney($("#acrescimoDesconto").val());

  }else{
    if(getMoney($("#acrescimoDesconto").val()) > getMoney($("#vSTotal").val())){
      
      $("#alertasMensagem").text("O Desconto não pode ser maior que o valor total.")
      $("#alertas").modal('show');
      
      $("#acrescimoDesconto").val("");
      totalGeral = getMoney($("#vSTotal").val());
      $("#vTotal").val(totalGeral);
      $("#valorTotal").text(formatReal(totalGeral));
      return false;
    }
    var totalGeral = getMoney($("#vSTotal").val()) - getMoney($("#acrescimoDesconto").val());
  }

  $("#vTotal").val(formatReal(totalGeral));
  $("#valorTotal").text(formatReal(totalGeral));
  troco();
};


$("#acrescimoDesconto").keyup(function(event) {
  calculaTudo();
});


$("#pagou").load(urlPagamento, function(){
    troco();
});