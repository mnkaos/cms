<?php
require("functions.php");

if(isset($_REQUEST['submit'])){

	$estructura = '../'.$_REQUEST['folder'];
	// Para crear una estructura anidada se debe especificar el parámetro $recursive
	// en mkdir().
	if(@mkdir($estructura.'/admin/', 0777, true) && chmod($estructura, 0777) && chmod($estructura.'/admin/', 0777)){
		$url = "installer.php?msj=3&folder=".$_REQUEST['folder'];
	}else
		$url = "index.php?msj=1";
	
	if(isset($url)){
		header("Location:".$url);
	}
}
?>
<?php
headers();
?>
<div class="container_16">
	<div class="grid_16">
    <div style="float:left;">
  		<img src="images/folder.png" height="150">
    </div>
    <div style="float:left; margin-left:10px;">
    	<h1 style="margin:60px 0 0 0;">Instalador [Carpetas]</h1>
    	<p><cite>Escriba un nombre para la carpeta donde se instalará el sistema y presione enter.</cite></p>
    </div>
    <div class="clear"></div>
    <?php
    if($_REQUEST['msj'])
      echo mensajes($_REQUEST['msj']);
    ?>
    <fieldset>
    <form action="index.php" method="post">
      <img src="images/folder.png" width="35" class="mar-right-10"> <input type="text" name="folder" placeholder="Folder">
      <input type="submit" name="submit" value="Siguiente" style="display:none" onClick="javascript: return confirm('Favor de confirmar la acción')">
    </form>
    </fieldset>
  </div><!-- .grid_16 -->
</div><!-- .container_16 -->
</body>
</html>