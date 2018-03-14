<?php
include ROOT.DS."_modulos".DS."categoria".DS."src".DS."categorias.class.php";
include ROOT.DS."_modulos".DS."produto".DS."src".DS."produtos.class.php";

$categoriaOBJ = new Categoria(new config());
$categorias = $categoriaOBJ->listar();

$produtoOBJ = new Produto(new config());


$css = '<link rel="stylesheet" href="'.$url.'view/css/dataTables.bootstrap.css">';
$css .= '<link rel="stylesheet" href="'.$url.'view/css/dataTables.responsive.css">';
?>