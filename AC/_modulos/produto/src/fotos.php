<?php
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";
include ROOT.DS."_modulos".DS."produto".DS."src".DS."fotos.class.php";

$foto = new Foto(new config());
$produtos = new Produto(new config());

$fotos = $foto->listar($_GET['id']);
$produto = $produtos->listaNome($_GET['id']);


if(isset($_GET['funcao'])){

	if($_GET['funcao'] == "excluir" and is_numeric($_GET['funcao_id'])){

		$foto_excluir = $foto->listarunico($_GET['funcao_id']);

		$imagem = str_replace(DS."__admin", "", ROOT).DS."img".DS."produto".DS.$foto_excluir[2];
		$imagem_mini = str_replace(DS."__admin", "", ROOT).DS."img".DS."produto".DS."M".$foto_excluir[2];

 
		if(file_exists($imagem) and file_exists($imagem_mini)){
			unlink($imagem);
			unlink($imagem_mini);
			
			$foto->excluir($_GET['funcao_id']);
		}


		header("Location: ".$url."produto/fotos/".$produto[0]."/");
	
	}

}



if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$dados['produto_id'] = $_POST['produto_id'];
	
	include ROOT.DS."_modulos".DS."produto".DS."src".DS."salva_imagem.php";

	$foto->adicionar($dados);
	header("Location: ".$url."produto/fotos/".$dados['produto_id']."/");	
}



?>