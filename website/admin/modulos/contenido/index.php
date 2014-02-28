<div id="contenidoAdmin" class="grid_16 bg-bco">  
	<?php
  location();
	if($_REQUEST['msj'])
		mensajes($_REQUEST['msj']);
	?>
  <div id="noticias">
  	<a href="#" id="btn-show-options" class="button icon"><span class="agregar">Agregar Contenido</span></a>
    <div class="clear"></div>
    <div id="agregar-contenido" style="display:none; border-top:1px dashed #CCCCCC; border-bottom:1px dashed #CCCCCC;">
      <form action="sql.php?mod=1&act=1" method="post" enctype="multipart/form-data">
        <input type="hidden" name="eid" value="<?= $_REQUEST['eid']; ?>" />
        <div class="float-left">          
          <h6>Titulo</h6>
          <input type="text" name="titulo" class="default" />
          <div class="spacer_20"></div>
          <h6>Tipo de Contenido</h6>
          <select id="tipocontenido" name="tipocontenido" class="default">
            <optgroup label="Seleccione una opción">
            <?php
              $query = mysql_query("SELECT * FROM contenidoTipo;");
              while($row = mysql_fetch_array($query)){
            ?>
            <option value="<?= $row['idContenidoTipo']; ?>"><?= $row['tipoContenido']; ?></option>
            <?php
              }
            ?>
            </optgroup>
          </select>          
          <div class="spacer_20"></div>
          <h6>Imagen</h6>
          <input type="file" name="img" class="default" />          
        </div><!-- .float-left -->
        <div class="float-left">
        	<h6>Texto</h6>
          <textarea name="texto" style="width:500px;"></textarea>
          <div class="spacer_20"></div>
          <div  align="right">
            <input type="image" src="images/guardar.png" value="" />
            <?php /*?><div id="file-upload-text"></div>
            <div style="background: url(http://phpfileuploader.com/images/upload.png); width: 48px; height: 48px; overflow: hidden">
            <input type="file" id="file-upload" name="Filedata" style="opacity:0;-moz-opacity:0 ;filter:alpha(opacity: 0); width: 48px; height: 48px;" onchange="document.getElementById('file-upload-text').innerHTML= this.value" >
            </div><?php */?>
          </div><!-- #btn-guardar -->
        </div><!-- .float-left -->
        <div class="clear"></div>        
      </form>
      <div class="spacer_10"></div>
  	</div><!-- #agregar-contenido -->
		<table id="tabla-generica">
    	<thead>
      	<tr>
        	<th>id</th>
          <th>Titulo</th>
          <th>Texto</th>
          <th>Fecha Publicaci&oacute;n</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
      	<?php
					$query = mysql_query("SELECT * FROM contenido;");
					while($row = mysql_fetch_array($query)){
						$fecha = new DateTime($row['fecha']);
				?>
        	<tr>
          	<td><?= $row['idContenido']; ?></td>
            <td><?= $row['titulo']; ?></td>
            <td><div class="comment more"><?php echo $row['texto']; ?></div></td>
            <td><?= $fecha->format('d-m-Y'); ?></td>
            <td class="new-options-btn">
            	<a href="index.php?mod=1&act=1&rid=<?= $row['idContenido']; ?>"><img src="images/btn_edit.png" class="new-options" /></a> 
              <a href="sql.php?mod=1&act=2&rid=<?= $row['idContenido']; ?>" onclick="return confirm('¿Esta seguro de realizar esta acción?')"><img src="images/btn_delete.png" class="new-options" /></a>
            </td>
          </tr>
        <?php
					}
				?>
      </tbody>
    </table>
  </div><!-- #noticias -->
</div><!-- fin contenido -->
<script>
	$(document).ready(function() {
		var showChar = 170;
		var ellipsestext = "...";
		var moretext = "Ver más";
		var lesstext = "<div class=\"clear\"></div>Ver menos";
		$('.more').each(function() {
			var content = $(this).html();
	
			if(content.length > showChar) {
	
				var c = content.substr(0, showChar);
				var h = content.substr(showChar-1, content.length - showChar);
	
				var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';
	
				$(this).html(html);
			}
	
		});
	
		$(".morelink").click(function(){
			if($(this).hasClass("less")) {
				$(this).removeClass("less");
				$(this).html(moretext);
			} else {
				$(this).addClass("less");
				$(this).html(lesstext);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});		
	});
	
</script>