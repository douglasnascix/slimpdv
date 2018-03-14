$("#data_ini").datepicker({
    format: "dd/mm/yyyy",
    weekStart: 0,
    language: "pt-BR",
    orientation: "top auto",
    autoclose: true,
    todayHighlight: true,
});

$("#data_fim").datepicker({
    format: "dd/mm/yyyy",
    weekStart: 0,
    language: "pt-BR",
    orientation: "top auto",
    autoclose: true,
    todayHighlight: true,
});

  var url = window.location.href
  urlCompleta = url.split("relatorio");
  url = urlCompleta[0] + "_modulos/relatorio/src/email.php";


$("#contabilidade").click(function(){
if($("#contabilidade").hasClass( "disabled" )) {

}else{
  $("#bg-loader").css('display','block');
  $.post( url, { mes: $("#mes").val(), ano: $("#ano").val() })
  .done(function( data ) {
    $("#bg-loader").css('display','none');
    alert( data );
  });

    
}
})