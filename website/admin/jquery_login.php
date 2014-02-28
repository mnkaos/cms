<?php 
session_start();
require("../conexion.php");
$sid = session_id();

$user=htmlspecialchars($_REQUEST['username'],ENT_QUOTES);

$pass=md5($_REQUEST['password']);

$sql=mysql_query("SELECT * FROM usuarios WHERE usuario='".$user."';");

$row=mysql_fetch_array($sql);

if(mysql_num_rows($sql)>0){
	if(strcmp($row['pass'],$pass)==0){
		if(mysql_query("UPDATE usuarios SET session='$sid' WHERE usuario='$user';")){
			
			$_SESSION['sex']     = $row['sexo'];
			$_SESSION['user']     = $row['nombre'];
			$_SESSION['lastname'] = $row['apellido'];
			$_SESSION['log']      = $sid;
			$_SESSION['mail']     = $row['usuario'];
			$_SESSION['userid']   = $row['idUsuario'];
			$_SESSION['usertipo']   = $row['tipo'];
		
		}
		echo "continue";		 
	}
	else
		echo "nop";
}
else
	echo "noup";
?>