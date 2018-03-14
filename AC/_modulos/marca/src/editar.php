<?php
include ROOT.DS."_modulos".DS."marca".DS."src".DS."marcas.class.php";


if(empty($_GET['id'])){
	header("Location: ".$url."404.php");
	exit;
}else{

	$marcas = new Marca(new config());
	$marca = $marcas->listar($_GET['id']);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if(isset($_POST['marca_nome'])){

			$dados['marca_id'] = $_POST['marca_id'];
			$dados['marca_nome'] = $_POST['marca_nome'];

			if(!isset($_POST['marca_imagem'])){
				include ROOT.DS."_modulos".DS."marca".DS."src".DS."salva_imagem.php";
			}else{
				$dados['marca_imagem'] = $marca['marca_imagem'];
			}

			$marcas->editar($dados, $dados['marca_id']);
			

			header("Location: ".$url."marca/listar/");
		}
	}

	
	


	if(isset($_GET['funcao'])){

		if($_GET['funcao'] == "excluirfoto" and is_numeric($_GET['funcao_id'])){

			$imagem = str_replace(DS."__admin", "", ROOT).DS."marcas".DS.$marca['marca_imagem'];

	 
			if(file_exists($imagem)){
				unlink($imagem);
			}

			$marcas->excluir_foto($_GET['funcao_id']);


			header("Location: ".$url."marca/editar/".$marca[0]."/");
		
		}

	}

};

