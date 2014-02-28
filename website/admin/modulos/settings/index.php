<div id="contenidoAdmin" class="grid_16 bg-bco">  
	<?php
  location();
	if($_REQUEST['msj'])
		mensajes($_REQUEST['msj']);
	$uid = $_SESSION['userid'];
	extract(mysql_fetch_array(mysql_query("SELECT * FROM usuarios WHERE idUsuario = $uid;")));
	?>
  <div id="noticias">
  	<form action="sql.php?mod=10&act=3" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="rid" value="<?= $rid; ?>" />
      <div class="prefix_2 grid_12 suffix_2">
        <h3><img src="images/options.png"> Configuración de la cuenta</h3>
        <div class="spacer_10"></div>
        <h6>Nombre</h6>
        <input type="text" name="nombre" class="default" value="<?php echo $nombre; ?>" />
        <div class="spacer_20"></div>
        <h6>Apellido</h6>
        <input type="text" name="apellido" class="default" value="<?php echo $apellido; ?>" />
        <div class="spacer_20"></div>
        <h6>email</h6>
        <input type="text" name="usuario" class="default" value="<?php echo $usuario; ?>" />
        <div class="spacer_20"></div>
        <h6>sexo</h6>
        <select name="sexo" class="default">
          <option value="1" <?php if($sexo == 1) echo 'selected="selected"'; ?>>Hombre</option>
          <option value="2" <?php if($sexo == 2) echo 'selected="selected"'; ?>>Mujer</option>        	
        </select>
        <div class="spacer_20"></div>
        
        <div id="btn-guardar">
          <input type="image" src="images/guardar.png" value="" />
        </div><!-- #btn-guardar -->
      </div><!-- .prefix_2 grid_14 -->
      <div class="clear"></div>
      <div class="spacer_40"></div>
    </form>
  </div><!-- #noticias -->
</div><!-- fin contenido -->