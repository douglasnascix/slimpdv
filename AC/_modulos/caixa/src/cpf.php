<?php
session_start();

if(isset($_GET["cpf"])){
	$_SESSION["cpf"] = $_GET["cpf"];
};
?>