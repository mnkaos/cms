<?php
function headers(){
	echo"
	<!DOCTYPE HTML>\n
	<html lan=\"en\">\n
	<head>\n
	<meta charset=\"utf-8\">\n
	<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"css/reset.css\">\n
	<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"css/text.css\">\n
	<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"css/960.css\">\n
	<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"css/styles.css\">\n
	<link type=\"text/css\" rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family=Ubuntu\">\n
	<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>\n
	<title>Instalador de sistema</title>\n
	</head>\n	
	<body>\n
	";
}
function mensajes($msj, $str){
	
	switch($msj){
		case 1: $msj = "<div class=\"mensajes error\"><h6><img src=\"images/error.png\">Error al generar las carpetas</h6></div>"; break;
		case 2: $msj = "<div class=\"mensajes error\"><h6><img src=\"images/error.png\">Error al escribir el archivo: config.php</h6></div>"; break;
		case 3: $msj = "<div class=\"mensajes exito\"><h6><img src=\"images/exito.png\">Carpetas creadas con éxito</h6></div>"; break;
		case 4: $msj = "<div class=\"mensajes error\"><h6><img src=\"images/error.png\">Error al abrir el archivo: config.php</h6></div>"; break;
		case 5: $msj = "<div class=\"mensajes alert\"><h6><img src=\"images/alert.png\">Favor de llenar todos los campos</h6></div>"; break;
		case 6: $msj = "<div class=\"mensajes exito\"><h6><img src=\"images/exito.png\">Archivo config.php creado y escrito con éxito.</h6></div>"; break;
		case 7: $msj = "<div class=\"mensajes error\"><h6><img src=\"images/error.png\">Error al ejecutar el query: ".$str."</h6></div>"; break;
	}
	
	return $msj;
}

function create_config($sql_hostname, $sql_username, $sql_passwd, $sql_database, $sql_prefixm, $logo_name){
	return "<?php\n"
		."define('DB_HOST',     '$sql_hostname');\n"
		."define('DB_USER',     '$sql_username');\n"
		."define('DB_PASSWORD',   '$sql_passwd');\n"
		."define('DATABASE', '$sql_database');\n"
		."define('DB_PREFIX',   '$sql_prefix');\n"
		."define('LOGO',   '$logo_name');\n"
		."?".">\n";
}

function copy_directory( $source, $destination ) {
	if ( is_dir( $source ) ) {
		@mkdir( $destination, 0777, true );
		$directory = dir( $source );
		while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
			if ( $readdirectory == '.' || $readdirectory == '..' ) {
				continue;
			}
			$PathDir = $source . '/' . $readdirectory; 
			if ( is_dir( $PathDir ) ) {
				copy_directory( $PathDir, $destination . '/' . $readdirectory );
				continue;
			}
			copy( $PathDir, $destination . '/' . $readdirectory );			
		}
 
		$directory->close();
	}else {
		copy( $source, $destination );
	}
}

function resizeImg($oriWidth, $oriHeight, $oriRatio, $width, $oriImg, $destImg){
	$height = $width/$oriRatio;
	// Resample
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($oriImg);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $oriWidth, $oriHeight);
	// Resultado
	imagejpeg($image_p, $destImg, 90);
}
?>