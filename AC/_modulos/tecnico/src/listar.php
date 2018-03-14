<?php
include ROOT.DS."_modulos".DS."tecnico".DS."src".DS."tecnicos.class.php";

	$tecnico = new Tecnico(new config());
	$tecnicos = $tecnico->listar();
?>