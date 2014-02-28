<?php
function query(){
  
	$url = "";
	
	switch($_REQUEST['act']){
	
		case 1:{ //----------------- AGREGAR NOTICIA ---------------------
			
			$fecha = date("Y-m-d");
			$img = $_FILES['img']['name'];
			$tipo = $_REQUEST['tipocontenido'];
			
			$texto = limpiarCadena($_REQUEST['texto']);
			$titulo = limpiarCadena($_REQUEST['titulo']);
			
			mysql_query('INSERT INTO contenido (idContenido, titulo, texto, img, fecha, tipo) VALUES(NULL, \''.$titulo.'\', \''.$texto.'\', \''.$img.'\', \''.$fecha.'\', '.$tipo.');') or die(mysql_error());
				$rid = mysql_insert_id();
				$targetFolder = '../images/contenido/post-'.$rid.'/';
				
				if(is_dir($targetFolder)===false){
					mkdir($targetFolder, 0755);
					chmod($targetFolder, 0777);
				}
				copy($_FILES['img']['tmp_name'], $targetFolder.$img);
				
				list($width_orig, $height_orig) = getimagesize($targetFolder.$img);
				$orig_ratio = $width_orig/$height_orig;
				$width = 677;
						
				resizeImg($width_orig, $height_orig, $orig_ratio, $width, $targetFolder.$img, $targetFolder.$img);
				
				$imgDest = 'thumb_'.$img;
				
				thumbGenerator(104, 104, $targetFolder, $targetFolder, $img, $imgDest);
				
				$url = 'index.php?mod=1&msj=4';
						
		}break; //----------------- AGREGAR NOTICIA --------------------- 
		
		case 2:{ //----------------- BORRAR NOTICIA --------------------- 
			
			mysql_query('DELETE FROM contenido WHERE idContenido = \''.$_REQUEST['rid'].'\';');
			
			$folder = '../images/contenido/post-'.$_REQUEST['rid'];
			
			if (is_dir($folder)) {
				$objects = scandir($folder);
				foreach ($objects as $object) {
					if ($object != "." && $object != "..") {
						unlink($folder."/".$object);
					}
				}
				if(rmdir($folder))
					$url = 'index.php?mod=1&msj=7';
				else
					$url = 'index.php?mod=1&msj=8';
			}
			else{
				$url = 'index.php?mod=1&msj=8';
			}
		}break;//----------------- BORRAR NOTICIA ---------------------
		
		case 3:{//----------------- EDITAR NOTICIA ---------------------
			
			$rid = $_REQUEST['rid'];
			$texto = limpiarCadena($_REQUEST['texto']);
			$titulo = limpiarCadena($_REQUEST['titulo']);
			$tipo = $_REQUEST['tipocontenido'];
			
			mysql_query('UPDATE contenido SET titulo = \''.$titulo.'\', texto = \''.$texto.'\', tipo = \''.$tipo.'\' WHERE idContenido = '.$rid.';') or die(mysql_error().' texto');
			
			
			if($_FILES['img']['name']!=""){
				
				$img = $_FILES['img']['name'];
				
				$targetFolder = '../images/contenido/post-'.$rid.'/';
				
				extract(mysql_fetch_array(mysql_query("SELECT img AS imagen FROM contenido WHERE idContenido = '".$rid."';")));
				
				unlink($targetFolder.$imagen);
				unlink($targetFolder.'thumb_'.$imagen);
				
				copy($_FILES['img']['tmp_name'], $targetFolder.$img);
				
				mysql_query('UPDATE contenido SET img = \''.$img.'\' WHERE idContenido = '.$rid.';') or die(mysql_error());
					
				list($width_orig, $height_orig) = getimagesize($targetFolder.$img);
				$orig_ratio = $width_orig/$height_orig;
				$width = 677;
					
				resizeImg($width_orig, $height_orig, $orig_ratio, $width, $targetFolder.$img, $targetFolder.$img);
				
				$imgDest = 'thumb_'.$img;
				
				thumbGenerator(104, 104, $targetFolder, $targetFolder, $img, $imgDest);
			
			}
				
			$url = 'index.php?mod=1&msj=10';
				
		}break;//----------------- EDITAR NOTICIA ---------------------
		
	}// switch
	
	return $url;
	
}// function
	
?>