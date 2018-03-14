<?php
// Conecta com o banco de dados
mysql_connect("localhost", "root", "");

// Importa a classe
require "src/class.leitor_sql.php";

// Cria a classe e executa o arquivo SQL
$tp = new leitor_sql("limpo.sql");


?>