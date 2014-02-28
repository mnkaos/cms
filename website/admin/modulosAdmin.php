<?php
function sexo(){
	if($_SESSION['sex']==2){
		$sexo = array("a","user_woman.png");
	}else{
		$sexo = array("o","user_man.png");
	}
	
	return $sexo;
}
function mensajes($msj){
	switch($msj){
		case 1:  echo "<div class=\"warning msg\"> Usted no est&aacute; autorizado para modificar esta secci&oacute;n <button class=\"close-msg\">Close</button></div>";break;
		case 2:  echo "<div class=\"warning msg\"> La soicitud no se pudo realizar debido al siguiente error: <button class=\"close-msg\">Close</button></div>";break;
		case 3:  echo "<div class=\"warning msg\"> Tipo de archivo inválido. Favor de utilizar solo archivos del tipo JPG <button class=\"close-msg\">Close</button></div>";break;
		case 4:  echo "<div class=\"success msg\"> Registro agregado exitosamente. <button class=\"close-msg\">Close</button></div>";break;
		case 5:  echo "<div class=\"warning msg\"> Error al agregar registro, contacte a su administrador. <button class=\"close-msg\">Close</button></div>";break;
		case 6:  echo "<div class=\"warning msg\"> Error al crear la carpeta, contacte a su administrador. <button class=\"close-msg\">Close</button></div>";break;
		case 7:  echo "<div class=\"success msg\"> Registro eliminado exitosamente. <button class=\"close-msg\">Close</button></div>";break;
		case 8:  echo "<div class=\"warning msg\"> Error al eliminar registro, contacte a su administrador. <button class=\"close-msg\">Close</button></div>";break;
		case 9:  echo "<div class=\"warning msg\"> Carpeta vacia, porfavor ingrese imagenes a la gale&iacute;a. <button class=\"close-msg\">Close</button></div>";break;
		case 10: echo "<div class=\"success msg\"> Registro modificado exitosamente. <button class=\"close-msg\">Close</button></div>";break;
		case 11: echo "<div class=\"warning msg\"> Error al modificar el registro, contacte a su administrador. <button class=\"close-msg\">Close</button></div>";break;
		case 12: echo "<div class=\"warning msg\"> Favor de llenar todos los campos correctamente. <button class=\"close-msg\">Close</button></div>";break;
		case 13: echo "<div class=\"success msg\"> Las contraseñas se modificaron exitosamente <button class=\"close-msg\">Close</button></div>";break;
		case 14: echo "<div class=\"warning msg\"> Las contraseñas no coinciden, intentelo de nuevo. <button class=\"close-msg\">Close</button></div>";break;
		case 15: echo "<div class=\"warning msg\"> La contraseña actual es incorrecta, intentelo de nuevo. <button class=\"close-msg\">Close</button></div>";break;
		case 16: echo "<div class=\"warning msg\"> Token inválido.</div>";break;
		case 17:  echo "<div class=\"warning msg\"> Tipo de archivo inválido. Favor de utilizar solo archivos del tipo PDF <button class=\"close-msg\">Close</button></div>";break;
	}
}

function locationInfo(){
	switch($_REQUEST['mod']){
		case 0:{
			$locationData = array("Home", "btn_home.png");
		};break;
		case 1:{
			$locationData = array("Contenido", "noticias.png");
		};break;
		case 10:{
			$locationData = array("Configuración", "options.png");
		};break;
	}
	return $locationData;
}

function modulos(){
	if(isset($_SESSION['user'])){
		
		$row = mysql_fetch_array(mysql_query("SELECT mainsection FROM secciones WHERE idUsuarioSec = ".$_SESSION['userid']." LIMIT 1;"));
		$seccionPrincipal = explode(",", $row['mainsection']);		
	
		if(in_array($_REQUEST['mod'], $seccionPrincipal, true)){		
			switch($_REQUEST['mod']){
				case 0:{
					require("modulos/index/index.php");break;
				};break;
				case 1:{
					switch($_REQUEST['act']){
					case 1: require("modulos/contenido/editar.php");break;
					default: require("modulos/contenido/index.php");break;
					}
				};break;
				case 10:{
					switch($_REQUEST['act']){
					case 1: require("modulos/settings/editarPass.php");break;
					case 2: require("modulos/settings/agregarUsuarios.php");break;
					case 3: require("modulos/settings/usuarios.php");break;
					default: require("modulos/settings/index.php");break;
					}
				};break;
				default: require("modulos/index/index.php");break;
			}
		}else{
			require("modulos/index/index.php");
		}
	}else{
		require("modulos/index/index.php");
	}
}

function location(){
	require("location.php");
}
function passURL($URL){
 $URI = str_replace ( "%26", "&", $URL);
 $URI = str_replace ( "%3F", "?", $URI);
 $URI = str_replace ( "%3D", "=", $URI);
 $URI = str_replace ( "%23", "#", $URI);
 return $URI;
}

function returnURL($URL){
 $URI = str_replace ( "&", "%26", $URL);
 $URI = str_replace ( "?", "%3F", $URI);
 $URI = str_replace ( "=", "%3D", $URI);
 $URI = str_replace ( "#", "%23", $URI);
 return $URI;
}

function secondSection(){
	$row = mysql_fetch_array(mysql_query("SELECT mainsection FROM secciones WHERE idUsuarioSec = ".$_SESSION['userid']." LIMIT 1;"));
	$mod = $_REQUEST['mod'];
	$seccion = explode(",", $row['mainsection']);
	if(in_array($mod, $seccion, false))
		return true;
	else
		return false;
}

function resizeImg($oriWidth, $oriHeight, $oriRatio, $width, $oriImg, $destImg){
	
	$height = $width/$oriRatio;
	// Resample
	
	$file_name = $oriImg;
	$file_type = explode('.', $file_name);
	$file_type = $file_type[count($file_type) -1];
	$file_type=strtolower($file_type);
	
	if($file_type=='jpg'){
	 $image = imagecreatefromjpeg($file_name);
	}
	
	if($file_type=='gif'){ 
	 $image = imagecreatefromgif($file_name);
	}
	
	if($file_type=='png'){
	 $image = imagecreatefrompng($file_name);
	}
	
	$image_p = imagecreatetruecolor($width, $height);
	
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $oriWidth, $oriHeight);
	
	// Resultado
	switch($file_type){
		case '.jpg':  
		case '.jpeg':  
			if (imagetypes() & IMG_JPG) {  
					imagejpeg($image_p, $destImg, 100);  
			}  
		break;  

		case '.gif':  
			if (imagetypes() & IMG_GIF) {  
					imagegif($image_p, $destImg);  
			}
		break;  

		case '.png':  
			if (imagetypes() & IMG_PNG) {  
					imagepng($image_p, $destImg, 0);  
			}  
		break;
  }//SWITCH FILE_TYPE
}

function thumbGenerator($crop_width, $crop_height, $srcFolder, $targetFolder, $archivo, $imgDest){
	//------- NO MOVER -----------
	
	
	$thumb = $srcFolder.$archivo;
	$dest = $targetFolder.$imgDest;
	
	$file_name = $thumb;
	$file_type = explode('.', $file_name);
	$file_type = $file_type[count($file_type) -1];
	$file_type=strtolower($file_type);
	
	$original_image_size = getimagesize($file_name);
	$original_width = $original_image_size[0];
	$original_height = $original_image_size[1];
	
	if($file_type=='jpg'){
		$original_image_gd = imagecreatefromjpeg($file_name);
	}
	
	if($file_type=='gif'){ 
	 	$original_image_gd = imagecreatefromgif($file_name);
	}
	
	if($file_type=='png'){
		$original_image_gd = imagecreatefrompng($file_name);
	}
	
	$cropped_image_gd = imagecreatetruecolor($crop_width, $crop_height);
	$wm = $original_width /$crop_width;
	$hm = $original_height /$crop_height;
	$h_height = $crop_height/2;
	$w_height = $crop_width/2;
	
	if($original_width > $original_height ){
	 $adjusted_width =$original_width / $hm;
	 $half_width = $adjusted_width / 2;
	 $int_width = $half_width - $w_height;
	 imagecopyresampled($cropped_image_gd ,$original_image_gd ,-$int_width,0,0,0, $adjusted_width, $crop_height, $original_width , $original_height );	
	}elseif(($original_width < $original_height ) || ($original_width == $original_height )){
	 $adjusted_height = $original_height / $wm;
	 $half_height = $adjusted_height / 2;
	 $int_height = $half_height - $h_height;
	//echo $cropped_image_gd.",".$original_image_gd.",0,".-$int_height.",0,0,". $crop_width.",".$adjusted_height.",".$original_width.",".$original_height;
	 imagecopyresampled($cropped_image_gd , $original_image_gd ,0,-$int_height,0,0, $crop_width, $adjusted_height, $original_width , $original_height );
	}
	else{
		imagecopyresampled($cropped_image_gd , $original_image_gd ,0,0,0,0, $crop_width, $crop_height, $original_width , $original_height );
	}
	$file_type = '.'.$file_type;
	switch($file_type){
		case '.jpg':
		case '.jpeg':
			if (imagetypes() & IMG_JPG) {
					imagejpeg($cropped_image_gd, $dest, 100);
			}
		break;

		case '.gif':
			if (imagetypes() & IMG_GIF) {
					imagegif($cropped_image_gd, $dest);
			}
		break;  

		case '.png':
			if (imagetypes() & IMG_PNG) {
					//imagepng($cropped_image_gd, $dest, 0);
					imagealphablending( $cropped_image_gd, false );
					imagesavealpha( $cropped_image_gd, true );
					$image = imagecreatefrompng( $file_name );
					imagecopyresampled($cropped_image_gd , $original_image_gd ,0,-$int_height,0,0, $crop_width, $adjusted_height, $original_width , $original_height );
					imagepng($cropped_image_gd, $dest, 0);
			}  
		break;
  }//SWITCH FILE_TYPE	
	//----- NO MOVER HASTA QUI
	
}
function limpiarCadena($cadena){
	$cadena = str_replace("á", "&aacute;", $cadena);
	$cadena = str_replace("é", "&eacute;", $cadena);
	$cadena = str_replace("í", "&iacute;", $cadena);
	$cadena = str_replace("ó", "&oacute;", $cadena);
	$cadena = str_replace("ú", "&uacute;", $cadena);
	$cadena = str_replace("Á", "&Aacute;", $cadena);
	$cadena = str_replace("É", "&Eacute;", $cadena);
	$cadena = str_replace("Í", "&Iacute;", $cadena);
	$cadena = str_replace("Ó", "&Oacute;", $cadena);
	$cadena = str_replace("Ú", "&Uacute;", $cadena);
	$cadena = str_replace("ñ", "&ntilde",  $cadena);
	$cadena = str_replace("Ñ", "&Ntilde",  $cadena);
	$cadena = str_replace("'", "&lsquo;",  $cadena);
	$cadena = str_replace('"', "&quot;",  $cadena);	
	
	$cadena = strip_tags($cadena, '<em><br><strong>');
	
	return $cadena;
}
?>