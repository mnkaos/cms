<?php 
	list($title, $img) = locationInfo();
	list($sexo, $user_icon) = sexo();
?>
<div id="location" align="right">
	<ul>
  	<?php if($_REQUEST['mod']!=0){ ?>
		<li><a href="index.php"><img src="images/btn_home.png" width="24"> <span>Home</span></a></li>
  	<li><a href="javascript:history.back()"><img src="images/back.png"> <span>Regresar</span></a></li>
  	<li>
    	<img src="images/<?php echo $img; ?>" width="24"> <span><?php echo $title; ?></span> 
    	<div id="act-location">
      	<div id="img-act-location"><img src="images/arrow.png"></div>
        <img src="images/alert.png" width="24"> Usted esta aqu&iacute;
      </div>
    </li>
    <?php } ?>
    <li>Bienvenid<?php echo $sexo; ?>: <strong><img src="images/<?php echo $user_icon; ?>" width="24"><?php echo $_SESSION['user'].' '.$_SESSION['lastname']; ?></strong></li>
    <li><a href="logout.php"><img src="images/logout.png" width="24"> Cerrar sesión</a></li>
    <li class="user-options">
    	<div class="dropdown">
        <a class="account" ><span><img src="images/options.png" width="24"> Opciones</span></a>
        <div class="submenu" style="display: none; ">
          <ul class="root">
            <li><a href="index.php?mod=10">Configuración de la Cuenta <img src="images/options.png" width="16" height="16" style="position:relative; right:0;"></a></li>
            <li><a href="index.php?mod=10&act=1">Cambiar Contraseña <img src="images/pass.png" style="position:relative; right:-31px;"></a></li>
            <?php
						if($_SESSION['usertipo'] == 1){
						?>
            <li><a href="index.php?mod=10&act=3">Usuarios <img src="images/users.png" style="position:relative; right:-83px;"></a></li>
            <li><a href="index.php?mod=10&act=2">Agregar Usuarios <img src="images/add.png" style="position:relative; right:-43px;"></a></li>
            <?php 
						}
						?>
          </ul>
        </div><!-- .submenu -->
      </div><!-- .dropdown -->
    </li>
  </ul>
</div><!-- #location -->
<div class="clear"></div>
<div class="spacer_20"></div>