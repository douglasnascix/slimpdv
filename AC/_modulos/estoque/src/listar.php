<?php
include ROOT.DS."_modulos".DS."estoque".DS."src".DS."estoque.class.php";

$estoqueOBJ = new Estoque(new Config());
$estoqueMinimo = $estoqueOBJ->listar();

?>