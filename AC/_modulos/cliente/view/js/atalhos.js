var url = window.location.href
url = url.split("AC");

//F4
$(document).keydown(function (e) {
  if(e.which == 115){
    e.preventDefault();
     $("#btnCadastrar").click();
  }
});

//F2
$(document).keydown(function (e) {
  if(e.which == 113){
    e.preventDefault();
	location.href = url[0] + "AC/cliente/cadastrar/";
  }
});

//ESC
$(document).keydown(function (e) {
  if(e.which == 27){
    e.preventDefault();
	location.href = url[0] + "AC/cliente/listar/";
  }
});