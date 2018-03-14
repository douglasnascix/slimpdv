var id = "";

$(".btn-excluir").click(function(){
    id = $(this).attr("id");
    $("#excluir").modal("show");
});

$("#excluir").on('show.bs.modal', function () {	
	$("#pedido_id_aqui").text(id);
});

$("#excluir").on('hidden.bs.modal', function () {	
	$('.modal-body').html('<p>Deseja excluir o pedido <span id="pedido_id_aqui"></span> ?</p>');
	$('.modal-footer').html('<button type="button" id="confirmaExclusao" class="btn btn-danger" >Sim</button><button type="button" class="btn btn-default" data-dismiss="modal">Não</button>');

	$("#confirmaExclusao").click(function(){
	var url = window.location.href
	url = url.replace("pedido/listar/", "");
	urlExcluir = url + "pedido/excluir/"+ id;

	$('.modal-body').load(urlExcluir);

	$('.modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>');	
})
});

$("#confirmaExclusao").click(function(){
	var url = window.location.href
	url = url.replace("pedido/listar/", "");
	urlExcluir = url + "pedido/excluir/"+ id;

	$('.modal-body').load(urlExcluir);

	$('.modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>');	
})