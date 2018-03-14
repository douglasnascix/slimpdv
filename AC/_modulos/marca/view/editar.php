<h3 class="page-header">Configuração / Marca / Editar</h3>

<form action="<?php echo $url;?>marca/editar/<?php echo $marca[0];?>/" method="POST" style="text-transform: capitalize;" enctype="multipart/form-data">

	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Novo Marca</b></div>
			<div class="panel-body">
				<div class="form-group col-sm-12">
					<label for="marca_nome">Nome</label>  	
					<input type="hidden" id="marca_id" name="marca_id" value="<?php echo $marca[0];?>">
					<input type="text" class="form-control" autocomplete="off" required id="marca_nome" name="marca_nome" value="<?php echo $marca[1];?>">
				</div>
				
				<?php if($marca["marca_imagem"] != ""){
					$marca_imagem = $url.'marcas/'.$marca["marca_imagem"];
					echo '<img src="'.$marca_imagem.'" alt="'.$marca["marca_nome"].'">';

					echo '<a href="'.$url.'marca/editar/'.$marca[0].'/excluirfoto/'.$marca[0].'" class="btn btn-danger"> <span class="fa fa-trash"></span> </a>';
					echo '<input type="hidden" id="marca_imagem" name="marca_imagem">';
					}else{
				?>
				
				<div class="form-group col-sm-12">
					<label for="marca_imagem">Imagem Principal</label>
					<input type="file" class="form-control" id="marca_imagem" name="marca_imagem[]">
				</div>

				<?php };?>

			</div>

			<div class="panel-footer clearfix">
				<div class="col-sm-6">
					<a href="<?php echo $url.'/marca/listar/';?>" class="form-control btn btn-default"> Cancelar </a>
				</div>
				<div class="col-sm-6">
					<button type="submit" class="form-control btn btn-success"> Salvar </button>
				</div>
			</div>
		</div>
	</div>


</form>
</div>
<?php
$scriptsJS = '<script src="'.$url.'_modulos/marca/view/js/marca.js"></script>';
?>