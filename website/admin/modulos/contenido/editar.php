<?php
	$rid = $_REQUEST['rid'];
	$query = mysql_fetch_array(mysql_query("SELECT * FROM contenido WHERE idContenido = ".$rid." LIMIT 1;"));
?>
<div id="contenidoAdmin" class="grid_16 bg-bco">  
	<?php
  location();
	if($_REQUEST['msj'])
		mensajes($_REQUEST['msj']);
	?>
  <div id="noticias">
  	<form action="sql.php?mod=1&act=3" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="rid" value="<?= $rid; ?>" />
      <div class="prefix_2 grid_12 suffix_2">
        <h3><img src="../images/noticias.png" width="48" /> Editar Contenido</h3>
        <div class="spacer_10"></div>
        <h6>Titulo:</h6>
        <input type="text" name="titulo" class="default" value="<?php echo $query['titulo']; ?>" />
        <div class="spacer_20"></div>
        <h6>Tipo de Contenido</h6>
        <select id="tipocontenido" name="tipocontenido" class="default" style="width:320px;">
          <optgroup label="Seleccione una opción">
          <?php
            $result = mysql_query("SELECT * FROM contenidoTipo;");
            while($row = mysql_fetch_array($result)){
          ?>
          <option value="<?= $row['idContenidoTipo']; ?>" <?php if($query['tipo']==$row['idContenidoTipo']) echo 'selected="selected"'; ?>><?= $row['tipoContenido']; ?></option>
          <?php
            }
          ?>
          </optgroup>
        </select>
        <div class="spacer_20"></div>
        <h6 style="margin-bottom:0;">Imagen</h6>
        <cite style="display:block;">Si no desea cambiar la imgen existente, deje este espacio en blanco</cite>
        <input type="file" name="img" class="default" /> 
        <div class="spacer_20"></div>
        <h6>Texto</h6>
        <textarea name="texto"><?php echo $query['texto']; ?></textarea>
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