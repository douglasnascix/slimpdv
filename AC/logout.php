<?php 
session_start();
unset($_SESSION['usuario_id']);
unset($_SESSION['usuario_nome']);

include "config/config.php";
header("Location: ".$url);
?>