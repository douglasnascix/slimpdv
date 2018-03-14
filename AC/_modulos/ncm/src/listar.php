<?php
include ROOT.DS."_modulos".DS."ncm".DS."src".DS."ibpt.class.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$ncm = new Ibpt(new config());
		$ncms = $ncm->listar($_POST['buscar']);
	}
?>