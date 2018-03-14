<?php
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";

$produto = new Produto(new config());
$produtos = $produto->produtoncm();

$css = '<link rel="stylesheet" href="'.$url.'view/css/dataTables.bootstrap.css">';
$css .= '<link rel="stylesheet" href="'.$url.'view/css/dataTables.responsive.css">';
?>