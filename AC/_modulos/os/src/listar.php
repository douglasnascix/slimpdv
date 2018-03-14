<?php

include ROOT.DS."_modulos".DS."os".DS."src".DS."os.class.php";

$osOBJ = new Os(new Config());
$oss = $osOBJ->listar();

$css = '<link rel="stylesheet" href="'.$url.'view/css/dataTables.bootstrap.css">';
$css .= '<link rel="stylesheet" href="'.$url.'view/css/dataTables.responsive.css">';

?>