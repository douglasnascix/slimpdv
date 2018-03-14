<?php 
if(!empty($_FILES['produto_imagem'])){
	$nome_input = $_FILES['produto_imagem'];

	include ROOT.DS."_modulos".DS."produto".DS."src".DS."class.upload.php";

	$dir_dest = str_replace(DS."__admin", "", ROOT).DS."img".DS."produto"; //ROOT.DS."_modulos".DS."produto".DS."view".DS."img".DS."produto";
	$dir_pics = str_replace(DS."__admin", "", ROOT).DS."img".DS."produto"; //ROOT.DS."_modulos".DS."produto".DS."view".DS."img".DS."produto";

	$_SESSION['endereco'] = $dir_pics;


	//   produto/cadastrar/
	// 

				// ---------- MULTIPLE UPLOADS ----------

				// as it is multiple uploads, we will parse the $_FILES array to reorganize it into $files
	$files = array();
	foreach ($nome_input as $k => $l) {
		foreach ($l as $i => $v) {
			if (!array_key_exists($i, $files))
				$files[$i] = array();
			$files[$i][$k] = $v;
		}
	}

				// now we can loop through $files, and feed each element to the class
	foreach ($files as $file) {

				    // we instanciate the class for each element of $file
		$handle = new Upload($file);

				    // then we check if the file has been uploaded properly
				    // in its *temporary* location in the server (often, it is /tmp)
		if ($handle->uploaded) {

			$novo_nome = md5(date("d/m/Y H:i:s"));
			
				      //tamanho 200px
			$handle->file_new_name_body = "M".$novo_nome;
			$handle->image_resize = true;
			$handle->image_convert = "jpg";
			$handle->image_y = 200;
			$handle->image_ratio_x = true;
			$handle->Process($dir_pics);


				      //tamanho normal
			$handle->file_new_name_body = $novo_nome;
			$handle->image_convert = "jpg";
			$handle->Process($dir_pics);


				        // we check if everything went OK
			if ($handle->processed) {
				$nome_arquivo = $handle->file_dst_name;
				
			} else {
				            // one error occured
				echo '<p class="result">';
				echo '  <b>File not uploaded to the wanted location</b><br />';
				echo '  Error: ' . $handle->error . '';
				echo '</p>';
			}

		} else {
				        // if we're here, the upload file failed for some reasons
				        // i.e. the server didn't receive the file
			echo '<p class="result">';
			echo '  <b>File not uploaded on the server</b><br />';
			echo '  Error: ' . $handle->error . '';
			echo '</p>';
		}
	}


	$dados['produto_imagem'] = $nome_arquivo;
	
}else{
	$dados['produto_imagem'] = "";
}

?>