<?php
if (!isset($_SESSION['usuario_id'])) {
	header("Location: ".$url."login/");
}

?>