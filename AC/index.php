<?php
ini_set('max_execution_time', 0);
session_start();
include 'config/config.php';

include "verifica_login.php";

header('Content-Type: text/html; charset=utf-8');


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

$scriptsJS = "";
$titulo_pagina = "";

$modulo = (empty($_GET['modulo'])) ? 'home' : $_GET['modulo'];
$pagina = (empty($_GET['pagina'])) ? 'index' : $_GET['pagina'];

include '_modulos/'.$modulo.'/src/'.$pagina.".php";
include 'view/index.php';