<?php
require("conexion.php");

$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();


$run = mysql_query("SELECT * FROM foro ORDER BY fecha DESC LIMIT ".$postnumbers." OFFSET ".$offset);


while($row = mysql_fetch_array($run)) {
	
	$content = substr(strip_tags($row['mensaje']), 0, 450);
	
	echo '<h1 style="margin-bottom:0; float:left;">'.$row['usuario'].'</h1>'."\n";
	echo '<div style="text-align:right;"><cite>'.$row['fecha'].'</cite></div>'."\n";
	echo '<div class="clear"></div>'."\n";
	echo '<p>'.$content.'...</p>'."\n";
	echo '<hr />'."\n";

}

?>