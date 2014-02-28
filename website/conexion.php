<?php
require("config.php");
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_query("SET NAMES 'utf8'");
if(!$conn){
	die('Error en la conexi&oacute;n a la base de datos, consulte a su administrador...');
}
mysql_select_db(DATABASE, $conn);
?>