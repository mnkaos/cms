<div id="contenidoAdmin" class="grid_16 bg-bco">  
	<?php location(); ?>
  <div class="spacer_40"></div>
  <div id="noticias">
  	<form action="sql.php?mod=4&act=1" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="eid" value="<?php echo $_REQUEST['eid']; ?>" />
      <div class="prefix_2 grid_12 suffix_2">
        <h3><img src="../images/noticias.png" width="48" /> Agregar Noticia</h3>
        <h6>Estaci&oacute;n:</h6>
        <?php echo logoSecciones($_REQUEST['eid']); ?>
        <h6>¿Repetir en otras estaciones?</h6>
        <?php
				$query = mysql_query("SELECT * FROM estaciones");
				while($row = mysql_fetch_array($query)){				
				?>
        <input name="estaciones[]" type="checkbox" value="<?php echo $row['idEstacion']; ?>" <?php if($_REQUEST['eid']==$row['idEstacion']) echo 'checked="checked"'; ?> /> <?php echo $row['nombreEstacion']."\n"; ?>
        <?php
				}
				?>
        <div class="spacer_10"></div>
        <h6>Titulo:</h6>
        <input type="text" name="titulo" class="default" />
        <div class="spacer_20"></div>
        <h6>Texto</h6>
        <textarea name="texto"></textarea>
        <div class="spacer_20"></div>
        <h6>Soundcloud:</h6>
        <input type="text" name="audio" class="default" />
        <div class="spacer_20"></div>
        <h6>YouTube:</h6>
        <input type="text" name="video" class="default" />
        <div class="spacer_20"></div>
        <h6>Imagen para secci&oacute;n principal</h6>
        <p class="nota-admin">Nota: Imagen sugerida de 400px X 300px</p>
        <input type="file" name="img1" size="35" />
        <div class="spacer_20"></div>
        <h6>Imagen para secci&oacute;n interior</h6>
        <p class="nota-admin">Nota: Imagen sugerida de 650px X 250px</p>
        <input type="file" name="img2" size="35" />
        <div class="spacer_20"></div>
        <div id="btn-guardar">
          <input type="image" src="../images/guardar.png" value="" />
        </div><!-- #btn-guardar -->
      </div><!-- .prefix_2 grid_14 -->
      <div class="clear"></div>
      <div class="spacer_40"></div>
    </form>
  </div><!-- #noticias -->
</div><!-- fin contenido -->