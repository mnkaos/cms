<div id="contenidoAdmin" class="grid_16 bg-bco">  
	<?php
  location();
	if($_REQUEST['msj'])
		mensajes($_REQUEST['msj']);
	
	$timestamp = time();
	$token = md5("minoru".$timestamp);
	
	?>
  <div id="noticias">
  	<form action="sql.php?mod=10&act=2&token=<?= $token; ?>&timestamp=<?= $timestamp; ?>" method="post" enctype="multipart/form-data">    	
      <div class="prefix_2 grid_12 suffix_2">
        <h3><img src="images/options.png"> Cambiar Contraseña</h3>
        <div class="spacer_10"></div>
        <h6>Contraseña Actual</h6>
        <input type="password" name="current" class="default" id="current" />
        <div class="spacer_20"></div>
        
        <h6>Nueva Contraseña</h6>
        <input type="password" name="pass" class="default" id="pass" />
        <div class="spacer_20"></div>
        
        <h6>Repetir Contraseña</h6>
        <input type="password" name="pass2" class="default" id="pass2" />
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
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script>

$("form").validate({
    rules: {
        pass: {
            required: true,
            minlength: 5
        },
        pass2: {
            required: true,
            minlength: 5,
            equalTo: "#pass"
        }
    },
    messages: {
        pass: {
            required: "Por favor, ingrese su contraseña",
            minlength: "Su contraseña debe tener al menos 5 caracteres"
        },
        pass2: {
            required: "Por favor, ingrese su contraseña",
            minlength: "Su contraseña debe tener al menos 5 caracteres",
            equalTo: "Por favor, introduzca la misma contraseña que el campo anterior"
        }
    }
});
</script>