<?php
session_start();
require("../conexion.php");
$query = mysql_fetch_array(mysql_query("SELECT * FROM usuarios WHERE idUsuario='".$_SESSION['userid']."';"));
if($_REQUEST['mod']==0 && $_SESSION['log'] == $query['session']){
	header("Location: index.php?mod=0");
}else{
	header("Location: index.php?mod=50");
}

?>