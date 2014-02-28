<?php
	session_start();
	require("../conexion.php");
	mysql_query("UPDATE usuarios SET session = 0 WHERE usuario = '".$_SESSION['mail']."' AND idUsuario='".$_SESSION['userid']."'");
	session_destroy();
	header("Location: index.php");
?>