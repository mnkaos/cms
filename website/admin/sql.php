<?php
session_start();
date_default_timezone_set("America/Tijuana");
require("../conexion.php");
include("modulosAdmin.php");

if(!empty($_REQUEST['mod']) and !empty($_REQUEST['act'])){
	switch($_REQUEST['mod']){
		case 1: require("modulos/contenido/sql.php"); break;
		case 10: require("modulos/settings/sql.php"); break;
  }
	$url = query();
	
	if(empty($url) and $url == "")
		$url = passURL($_REQUEST['url']);
}
elseif($_SERVER['HTTP_REFERER'] == "")
	$url = "index.php";
else
 $url = $_SERVER['HTTP_REFERER'];

//CERRAR CONEXION
mysql_close($conn);
header('Location: ' . $url);
?>