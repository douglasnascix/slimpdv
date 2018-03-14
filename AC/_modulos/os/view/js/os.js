$(document).ready(function () {
   $('input').keypress(function (e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        return (code == 13) ? false : true;
   });

   $('input[type="text"]').attr('autocomplete', 'off');
});


$("#os_placa").mask('AAA-0000');
$("#os_motorista_fone").mask('(11) 00000-0000');