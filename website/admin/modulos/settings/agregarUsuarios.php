<div id="contenidoAdmin" class="grid_16 bg-bco">  
	<?php
  location();
	if($_REQUEST['msj'])
		mensajes($_REQUEST['msj']);
	?>
  <div id="noticias">
  	<form action="sql.php?mod=10&act=1" method="post">
    	<input type="hidden" name="rid" value="<?= $rid; ?>" />
      <div class="prefix_2 grid_12 suffix_2">
        <h3><img src="images/add_user.png"> Agregar Usuario</h3>
        <div class="spacer_10"></div>
        <h6>Nombre</h6>
        <input type="text" name="nombre" class="default" />
        <div class="spacer_20"></div>
        <h6>Apellido</h6>
        <input type="text" name="apellido" class="default" />
        <div class="spacer_20"></div>
        <h6>email</h6>
        <input type="text" name="usuario" class="default" />
        <div class="spacer_20"></div>
        
        <h6>Contraseña</h6>
        <input type="password" name="pass" class="default" id="pass" />
        <div class="spacer_20"></div>
        
        <h6>Repetir Contraseña</h6>
        <input type="password" name="pass2" class="default" id="pass2" />
        <div class="spacer_20"></div>
        
        <h6>Sexo</h6>
        <select name="sexo" class="default">
          <option value="1">Hombre</option>
          <option value="2">Mujer</option>        	
        </select>
        <div class="spacer_20"></div>
        
        <h6>Tipo de Usuario</h6>
        <select name="tipo" class="default">
          <option value="1">Administrador</option>
          <option value="2">Normal</option>        	
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