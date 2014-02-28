<?php
function query(){
  
	$url = "";
	
	switch($_REQUEST['act']){
	
		case 1:{ //----------------- AGREGAR ---------------------
			
			$nombre= limpiarCadena($_REQUEST['nombre']);
			$apellido = limpiarCadena($_REQUEST['apellido']);
			$sexo = $_REQUEST['sexo'];
			$usuario = htmlspecialchars($_REQUEST['usuario'],ENT_QUOTES);
			$tipo = $_REQUEST['tipo'];
			
			$pass1 = md5($_REQUEST['pass']);
			$pass2 = md5($_REQUEST['pass2']);
			
			if(strcmp($pass1,$pass2)==0){
				mysql_query('INSERT INTO usuarios (idUsuario, nombre, apellido, sexo, usuario, pass, session, tipo) VALUES(NULL, \''.$nombre.'\', \''.$apellido.'\', \''.$sexo.'\', \''.$usuario.'\', \''.$pass1.'\', \'0\', \''.$tipo.'\');') or die(mysql_error());
				
				$lastId = mysql_insert_id();
				
				mysql_query('INSERT INTO secciones (idSecciones, idUsuarioSec, mainsection, subsection) VALUES(NULL, \''.$lastId.'\', \'0,1,2,3,4,5,6,7,8,9,10\', \'1.2,1.2,1.2,1.2,1.2,1.2,1.2,1.2,1.2,1.2,1.2\' );') or die(mysql_error());
				
				$url = 'index.php?mod=10&act=1&msj=4';
			}else
				$url = 'index.php?mod=10&act=2&msj=5';				
			
						
		}break; //----------------- AGREGAR --------------------- 
		
		case 2:{ //----------------- EDITAR PASS ---------------------
		 
			$timestamp = $_REQUEST['timestamp'];
			$token = md5("minoru".$timestamp);
			
			if($_REQUEST['token'] == $token){
				$current = md5($_REQUEST['current']);
				$pass = $_REQUEST['pass'];
				$pass2 =$_REQUEST['pass2'];
				
				extract(mysql_fetch_array(mysql_query("SELECT pass AS contrasena FROM usuarios WHERE idUsuario = ".$_SESSION['userid'].";")));
				
				if($current == $contrasena){
				
					if($pass == $pass2){
						mysql_query("UPDATE usuarios SET pass = '".md5($pass)."' WHERE idUsuario = ".$_SESSION['userid'].";") or die(mysql_error());
						$url = 'index.php?mod=10&act=1&msj=13';
					}else{
						$url = 'index.php?mod=10&act=1&msj=14';
					}
				
				}else{
					$url = 'index.php?mod=10&act=1&msj=15';
				}
			
			}else{
				$url = 'index.php?mod=10&act=1&msj=16';
			}		
			
		}break;//----------------- EDITAR PASS ---------------------
		
		case 3:{//----------------- EDITAR INFORMACION GENERAL ---------------------
			
			if(isset($_REQUEST['nombre'])
				&& isset($_REQUEST['apellido'])
				&& isset($_REQUEST['usuario'])
				&& isset($_REQUEST['sexo'])
			){
				mysql_query("UPDATE usuarios SET nombre = '".$_REQUEST['nombre']."', apellido = '".$_REQUEST['apellido']."', usuario = '".$_REQUEST['usuario']."', sexo = ".$_REQUEST['sexo']." WHERE idUsuario = ".$_SESSION['userid'].";") or die(mysql_error());				
				$url = 'index.php?mod=10&msj=10';
			}else{
				$url = 'index.php?mod=10&msj=12';
			}		
				
		}break;//----------------- EDITAR INFORMACION GENERAL ---------------------
		
		case 4:{//----------------- ELIMINAR USUARIO ---------------------
			
			$rid = $_REQUEST['rid'];
			mysql_query("DELETE FROM usuarios WHERE idUsuario = $rid;") or die(mysql_error());				
			$url = 'index.php?mod=10&act=3&msj=7';			
				
		}break;//----------------- ELIMINAR USUARIO ---------------------
		
	}// switch
	
	return $url;
	
}// function
	
?>