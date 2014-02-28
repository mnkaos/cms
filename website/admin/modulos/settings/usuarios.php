<div id="contenidoAdmin" class="grid_16 bg-bco">  
	<?php
  location();
	if($_REQUEST['msj'])
		mensajes($_REQUEST['msj']);
	?>
  <div id="noticias">
  	<table id="tabla-generica">
    	<thead>
      	<tr>
        	<th>id</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Usuario</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
      	<?php
					$query = mysql_query("SELECT * FROM usuarios;");
					while($row = mysql_fetch_array($query)){
						$fecha = new DateTime($row['fecha']);
				?>
        	<tr>
          	<td><?= $row['idUsuario']; ?></td>
            <td><?= $row['nombre']; ?></td>
            <td><?= $row['apellido']; ?></div></td>
            <td><?= $row['usuario']; ?></td>
            <td class="new-options-btn">
            	<a href="sql.php?mod=10&act=4&rid=<?= $row['idUsuario']; ?>" onclick="return confirm('¿Esta seguro de realizar esta acción?')"><img src="images/btn_delete.png" class="new-options" /></a>
            </td>
          </tr>
        <?php
					}
				?>
      </tbody>
    </table>
  </div><!-- #noticias -->
</div><!-- fin contenido -->