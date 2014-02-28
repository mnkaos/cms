<div id="contenidoAdmin" class="grid_16 bg-bco">
  <?php
  if(!isset($_SESSION['user'])){
  ?>
  <div align="center">
    <img src="images/<?= LOGO; ?>" border="0" />
  </div><!-- divlogo -->
  <div class="spacer_30"></div>
  <div align="center">
    <img src="images/alert.png" border="0" />
    <h2 class="login" style="margin-bottom:-5px;">Iniciar Sesi&oacute;n</h2>
    <p>Solo personal autorizado</p>
    <div class="spacer_20"></div>
    <form action="" method="post" id="login_form" class="admin-form" target="_parent">
      <table cellpadding="5" cellspacing="5" border="0">
        <tr>
          <td>Usuario:<br /><input type="text" name="username" id="username" class="default"/></td>
        </tr>
        <tr>
          <td>Contrase&ntilde;a:<br /><input type="password" name="password" id="password" class="default"/></td>
        </tr>
      </table>
      <div class="spacer_10"></div>
      <input type="image" src="images/btn_login.png" value="">
    </form>
    <div class="spacer_20"></div>
    <div id="msgboxadmin" style="display:none;"></div>    
  </div><!-- align center -->
  <div class="spacer_20"></div>
  <?php
  }else{
  ?>
  	<?php location(); ?>
  	<div id="admin-main-icons">
    	<div class="grid_4 alpha">
        <div class="grid_1 alpha">
          <a href="index.php?mod=0"><img src="images/home.png" width="40" /></a>
        </div>
        <div class="grid_3 omega">
          <a href="index.php?mod=0"><h1>Inicio</h1></a>
          <p>Ir al Dashboard.</p>
        </div>        
      </div>
      <div class="grid_4">
      	<div class="grid_1 alpha">
          &nbsp;
        </div>
        <div class="grid_3 omega">
          &nbsp;
        </div> 
      </div>      
      <div class="grid_4">
      	<div class="grid_1 alpha">
	      	&nbsp;
        </div>
        <div class="grid_3 omega">
        	&nbsp;
        </div>
      </div>
      <div class="grid_4 omega">
      	<div class="grid_1 alpha">
        	&nbsp;
				</div>
        <div class="grid_3 omega">
          &nbsp;
      </div>
      </div>
    </div><!-- #admin-main-icons -->
    <div class="clear"></div> 
    <div class="spacer_20"></div>       
  <?php
  }
  ?> 
</div><!-- fin contenido -->