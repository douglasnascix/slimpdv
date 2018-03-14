$(document).keydown(function (e) {
  if(e.which == 113){
    $("#pagamentos").modal('show');
    return false;
   } 
});


$("#btn-pagamento").click(function(event) {
  $("#pagamentos").modal('show');
});

$('#pagamentos').on('shown.bs.modal', function () {
  $('#dinheiro').focus();
  $('#dinheiro').val($("#vTotal").val());
})

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

vTrocoTotal =0;
//calcula troco
function troco(){
    vTrocoTotal = (getMoney($("#dinheiro").val())+getMoney($("#cartaoDebito").val())+getMoney($("#cartaoCredito").val()) - getMoney($("#vTotal").val()))

    
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
};



$("#dinheiro").keypress(function(event) { troco(); });
$("#dinheiro").focusout(function(event) { troco(); });
$("#dinheiro").focusin(function(event) { 
  
  if(vTrocoTotal < 0 && getMoney($("#dinheiro").val()) == 0){ 
    $("#dinheiro").val(formatReal(vTrocoTotal))
    troco();
  }

  $("#dinheiro").select();
});


$("#cartaoDebito").keypress(function(event) { troco(); });
$("#cartaoDebito").focusout(function(event) { troco(); });
$("#cartaoDebito").focusin(function(event) { 
  
  
  if(vTrocoTotal < 0 && getMoney($("#cartaoDebito").val()) == 0){ 
    $("#cartaoDebito").val(formatReal(vTrocoTotal))
    troco();
  }
  $("#cartaoDebito").select();
});

$("#cartaoCredito").keypress(function(event) { troco(); });
$("#cartaoCredito").focusout(function(event) { troco(); });
$("#cartaoCredito").focusin(function(event) { 
  
  if(vTrocoTotal < 0 && getMoney($("#cartaoCredito").val()) == 0){ 
    $("#cartaoCredito").val(formatReal(vTrocoTotal))
    troco();
  }
  $("#cartaoCredito").select();
});

// acrescimo e desconto
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
  $("#vTotal").val(totalGeral);
  $("#valorTotal").text(formatReal(totalGeral));
  troco();
};


$("#acrescimoDesconto").keyup(function(event) {
  calculaTudo();
});

$("input[name='ad']").click(function(event) {
  calculaTudo();
});