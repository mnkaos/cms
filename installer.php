<?php
require("functions.php");
if(isset($_REQUEST['submit'])){
		
	if(isset($_REQUEST['hostname'])
		 && isset($_REQUEST['username'])
		 && isset($_REQUEST['prefix'])
		 && isset($_REQUEST['database'])
		 && isset($_REQUEST['ad_username'])
		 && isset($_REQUEST['ad_firstname'])
		 && isset($_REQUEST['ad_lastname'])
		 && isset($_REQUEST['ad_password'])
		)
		{
		$db_hostname = $_REQUEST['hostname'];
		$db_username = $_REQUEST['username'];
		$db_passwd = $_REQUEST['password'];
		$db_prefix = $_REQUEST['prefix'];
		$db_database = $_REQUEST['database'];
		
		/*---------------- COPIA LA CARPETA website AL FOLDER NUEVO --------------------*/
		
		copy_directory('website','../'.$_REQUEST['folder'].'/'); //copiar carpetas. Parametros: ('folder de origen', 'folder destino')
		chmod("../".$_REQUEST['folder']."/admin/images/", 0777);
		chmod("../".$_REQUEST['folder']."/admin/modulos/", 0777);
		
		exec ("find ../".$_REQUEST['folder']."/ -type d -exec chmod 0777 {} +");
		exec ("find ../".$_REQUEST['folder']."/ -type f -exec chmod 0777 {} +");
		
		/*---------------- COPIA LA CARPETA website AL FOLDER NUEVO --------------------*/
		
		/*---------------- GENERA EL LOGO PARA EL ADMINISTRADOR ------------------------*/
		
		if(!empty($_FILES['logo']['name'])){
		
			$logo = $_FILES['logo']['name'];
			
			$ext = pathinfo($logo, PATHINFO_EXTENSION);
			
			$logo = "logo.".$ext;
			
			$logo_path = "../".$_REQUEST['folder']."/admin/images/";
			
			copy($_FILES['logo']['tmp_name'], $logo_path.$logo);
			
			list($width_orig, $height_orig) = getimagesize($logo_path.$logo);
			$orig_ratio = $width_orig/$height_orig;
			$width = $_REQUEST['logo_width'];
						
			resizeImg($width_orig, $height_orig, $orig_ratio, $width, $logo_path.$logo, $logo_path.$logo);
					
		}
		
		/*---------------- GENERA EL LOGO PARA EL ADMINISTRADOR ------------------------*/
		
		/*---------------- EDITAR ARCHIVO config.php EN EL FOLDER NUEVO ----------------*/
		
		$file_path = '../'.$_REQUEST['folder'].'/config.php';
		$file_config = fopen($file_path, 'w');
		if(!$file_config){
			$url = "installer.php?msj=4&folder=".$_REQUEST['folder'];
		}		
		fwrite($file_config, create_config($db_hostname, $db_username, $db_password, $db_database, $db_prefix, $logo));
		
		fclose($file_config);
		
		/*---------------- EDITAR ARCHIVO config.php EN EL FOLDER NUEVO ----------------*/
		
		/*---------------- CREACIÓN DE LA BASE DE DATOS Y TABLAS -----------------------*/
		
		require("conexion.php");
		
		$query = "CREATE DATABASE `$db_database`;";
		$result = $mysqli->query($query) or die(headers().mensajes(7, $mysqli->error));
		
		/*---------------- TABLA DE USUARIOS -----------------------*/
		
		$query = "CREATE TABLE IF NOT EXISTS `$db_database`.`usuarios` (
							`idUsuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
							`nombre` VARCHAR(45) NOT NULL, 
							`apellido` VARCHAR(45) NOT NULL, 
							`sexo` TINYINT(1) NOT NULL, 
							`usuario` VARCHAR(128) NOT NULL, 
							`pass` VARCHAR(255) NOT NULL, 
							`session` VARCHAR(255) NULL,
							`tipo` TINYINT(1) NOT NULL
							) ENGINE = MyISAM;";
							
		$result = $mysqli->query($query) or die(headers().mensajes(7, $mysqli->error));
		
		/*---------------- TABLA DE USUARIOS -----------------------*/
		
		/*---------------- USUARIO MAESTRO -----------------------*/
		
		$ad_username = $_REQUEST['ad_username'];
		$ad_firstname = $_REQUEST['ad_firstname'];
		$ad_lastname = $_REQUEST['ad_lastname'];
		$ad_password = md5($_REQUEST['ad_password']);
		
		$query = "INSERT INTO `$db_database`.`usuarios` (`idUsuario`, `nombre`, `apellido`, `sexo`, `usuario`, `pass`, `session`, `tipo`) VALUES (NULL, '$ad_firstname', '$ad_lastname', '1', '$ad_username', '$ad_password', '0', '1');";
		
		$result = $mysqli->query($query) or die(headers().mensajes(7, $mysqli->error));
		
		$lastId = $mysqli->insert_id;		
		
		/*---------------- USUARIO MAESTRO -----------------------*/
		
		/*---------------- ACCESOS A SECCIONES DE USUARIO MAESTRO -----------------------*/
		
		$query = "\n"
    . " CREATE TABLE IF NOT EXISTS `$db_database`.`secciones` ( `idSecciones` int( 11 ) NOT NULL AUTO_INCREMENT ,\n"
    . " `idUsuarioSec` smallint( 6 ) NOT NULL ,\n"
    . " `mainsection` varchar( 125 ) NOT NULL ,\n"
    . " `subsection` varchar( 125 ) NOT NULL ,\n"
    . " PRIMARY KEY ( `idSecciones` ) ) ENGINE = MyISAM DEFAULT CHARSET = latin1;";
		
		$result = $mysqli->query($query) or die(headers().mensajes(7, $mysqli->error));
		
		$query = "INSERT INTO `$db_database`.`secciones` (`idSecciones`, `idUsuarioSec`, `mainsection`, `subsection`) VALUES (NULL, $lastId, '0,1,2,3,4,5,6,7,8,9,10', '1.2,1.2,1.2,1.2,1.2,1.2,1.2,1.2,1.2,1.2,1.2');";
		
		$result = $mysqli->query($query) or die(headers().mensajes(7, $mysqli->error));
		
		/*---------------- ACCESOS A SECCIONES DE USUARIO MAESTRO -----------------------*/
		
			/*---------------- TABLA DE CONTENIDO -----------------------*/
		
		$query = "\n"
    . " CREATE TABLE IF NOT EXISTS `$db_database`.`contenido` ( `idContenido` int( 11 ) NOT NULL AUTO_INCREMENT ,\n"
    . " `titulo` varchar( 128 ) NOT NULL ,\n"
    . " `texto` text NOT NULL ,\n"
    . " `img` varchar( 128 ) NOT NULL ,\n"
		. " `fecha` date NOT NULL ,\n"
		. " `tipo` smallint( 1 ) NOT NULL ,\n"
    . " PRIMARY KEY ( `idContenido` ) ) ENGINE = MyISAM DEFAULT CHARSET = latin1;";
		
		$result = $mysqli->query($query) or die(headers().mensajes(7, $mysqli->error));
		
		$query = "\n"
		." CREATE TABLE `$db_database`.`contenidoTipo` ( \n"
		." `idContenidoTipo` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , \n"
		." `tipoContenido` VARCHAR( 45 ) NOT NULL \n"
		." ) ENGINE = MYISAM DEFAULT CHARSET = latin1;";
		
		$result = $mysqli->query($query) or die(headers().mensajes(7, $mysqli->error));
			/*---------------- TABLA DE CONTENIDO -----------------------*/
		
		
		/*---------------- CREACIÓN DE LA BASE DE DATOS Y TABLAS -----------------------*/
		
		
		$url = "installer.php?msj=6";
		
	}else
		$url = "installer.php?msj=5&folder=".$_REQUEST['folder'];
	
	if(isset($url)){
		header("Location:".$url);
	}
	
}else{
headers();
?>
<div class="container_16">
	<div class="grid_16">
  	<div style="float:left;">
  		<img src="images/harddrive.png" height="150">
    </div>
    <div style="float:left; margin-left:10px;">
    	<h1 style="margin:60px 0 0 0;">Instalador [Información General]</h1>
    	<p><cite>Por favor llene los siguientes campos, al final presione enter.</cite></p>
    </div>
    <div class="clear"></div>
    <?php
    if($_REQUEST['msj'])
      echo mensajes($_REQUEST['msj'], $str);
		
		if($_REQUEST['msj'] != 6){
    ?>
    <fieldset>
    <form action="installer.php" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="folder" value="<?php echo $_REQUEST['folder']; ?>">
    	<img src="images/server.png" width="48">
      <table>
        <tr>
          <td>Server Hostname:</td>
          <td><input type="text" name="hostname" value="localhost"></td>
        </tr>
        <tr>
          <td>Database Name:</td>
          <td><input type="text" name="database" placeholder="Nombre de la base de datos"></td>
        </tr>
        <tr>
          <td>Table Prefix:</td>
          <td><input type="text" name="prefix" placeholder="Prefijo de las tablas"></td>
        </tr>
        <tr>
          <td>Database User:</td>
          <td><input type="text" name="username" value="root"></td>
        </tr>
        <tr>
          <td>Database Password:</td>
          <td><input type="password" name="password"></td>
        </tr>
      </table>
      <hr>
      <img src="images/user-admin.png">
      <table>
        </tr>
        <tr>
        	<td>Admin Username:</td>
          <td><input type="text" name="ad_username"></td>
        </tr>
        <tr>
        	<td>Admin First Name:</td>
          <td><input type="text" name="ad_firstname"></td>
        </tr>
        <tr>
        	<td>Admin Last Name:</td>
          <td><input type="text" name="ad_lastname"></td>
        </tr>
        <tr>
        	<td>Admin Password:</td>
          <td><input type="password" name="ad_password"></td>
        </tr>
      </table>      
      <hr>
      <img src="images/info.png">
      <table>
        </tr>
        <tr>
        	<td>Logo Image:</td>
          <td><input type="file" name="logo"></td>
        </tr>
        <tr>
        	<td>Logo width:</td>
          <td><input type="text" name="logo_width"></td>
        </tr>        
      </table>
      <div align="right">
	    	<input type="submit" name="submit" value="Siguiente" onClick="javascript: return confirm('Favor de confirmar la acción')">
      </div>
    </form>
    </fieldset>
    <?php
		}
		?>
</body>
</html>
<?php
	$mysqli->close;
}
/*
$query = "CREATE TABLE `aereoexpress`.`usuarios` (`idUsuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `nombre` VARCHAR(45) NOT NULL, `apellido` VARCHAR(45) NOT NULL, `sexo` TINYINT(1) NOT NULL, `usuario` VARCHAR(128) NOT NULL, `pass` VARCHAR(255) NOT NULL, `session` VARCHAR(255) NULL) ENGINE = MyISAM;";

$result = $mysqli->query($query) or die($mysqli->error." Algo aqui");

while($row = $result->fetch_array()) {
  echo $row['nombre'];
}
*/
?>