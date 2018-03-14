function relogio(){ 
   	momentoAtual = new Date() 
   	hora = momentoAtual.getHours() 
   	minuto = momentoAtual.getMinutes() 
   	segundo = momentoAtual.getSeconds() 

   	horaImprimivel = hora + ":" + minuto

   	$("#mostrarHora").text(horaImprimivel);

   	setTimeout("relogio()",1000);
} 