<?php
date_default_timezone_set("America/Tijuana");
session_start();
if(!$_REQUEST['mod'])
	$_REQUEST['mod']=0;

if(!isset($_SESSION['user']))
	$_REQUEST['mod'] = 0;
require ("../conexion.php");
require ("modulosAdmin.php");

?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Default Title</title>
<link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css">
<link rel="stylesheet" type="text/css" media="screen" href="../css/text-admin.css">
<link rel="stylesheet" type="text/css" media="screen" href="../css/style-admin.css">
<link rel="stylesheet" type="text/css" media="screen" href="../css/styles.css">
<link rel="stylesheet" type="text/css" media="screen" href="../css/960.css">
<link rel="stylesheet" type="text/css" media="screen" href="../css/dropmenu.css">
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script type="text/javascript" src="../js/dropmenu.js"></script>
<script src="../js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
<?php if($_REQUEST['mod']==0){ ?>
<script type="text/javascript">
$(document).ready(function()
{
	$("#login_form").submit(function()
	{
		$("#msgboxadmin").removeClass().addClass('messageboxadmin push_5 grid_6 push_5').text('Validando...').fadeIn(1000);
		$.post("jquery_login.php",{ username:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data){
		  if(data=='continue')
		  {
		  	$("#msgboxadmin").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Iniciando sesión...').addClass('messageboxokadmin push_5 grid_6 push_5').fadeTo(1000,1,function(){ 
			  	parent.location.href="log.php?mod=0";				 
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgboxadmin").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Sus datos no son correctos, intentelo de nuevo...').addClass('messageboxerroradmin push_5 grid_6 push_5').fadeTo(900,1);
			});		
          }				
        });
 		return false;
	});
	$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});
});
</script>
<?php 
}
?>

<script type="text/javascript">
$(document).ready(function(){
    $("#btn-show-options").click(function(){
      $("#agregar-contenido").toggle("slow");
    });
		
		$(".warning, .success, .info, .error").delay(1000).slideDown('slow');
	
		$('.close-msg').click(function(){
			$(this).closest('.msg').hide('slow');
		});
		
  });
</script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/uploadify.css">
<script type="text/javascript">
	<?php $timestamp = time();?>
	$(function() {
		$('#file_upload').uploadify({
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
				'fid'	: '<?php echo $_REQUEST['fid']; ?>',
			},
			'multi'    : true,
			'buttonText' : 'Subir Imagenes',
			'removeCompleted' : false,
			'swf'      : 'uploadify.swf',
			'uploader' : 'galerias.php',
			'onQueueComplete' : function(queueData) {
				location.reload(true)
			}
		});
	});
</script>

<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			monthNames:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
		});
	});
</script>
 
<!-- TinyMCE -->

<script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		forced_root_block : "",
		force_br_newlines : true,
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,|link,unlink,|undo,redo",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		extended_valid_elements: "img[!src|border:0|alt|title|width|height|style]a[name|href|target|title|onclick]",
		width: "700",
		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",
		entity_encoding : "named",
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		
		// Replace values for the template plugin
		
	});
</script>
<!-- /TinyMCE -->

<?php 


if(!isset($_REQUEST['act'])){
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#act-location").fadeTo(2000, 1,function(){
			$("#act-location").fadeOut(2000);
		});
	});
</script>
<?php 
}
?>
</head>

<body>
<?php
if(isset($_SESSION['user'])){
?>
<header>
  <div class="container_16">
  	<div class="grid_16">
    	<a href="index.php?mod=0"><img src="images/<?= LOGO; ?>" /></a>
    </div><!-- .grid_16 -->
    <div class="clear"></div>
  </div><!-- .container_16 -->
</header>
<?php
}
?>
<div class="container_16">
<?php 
	if(isset($_SESSION['userid'])){
		if(secondSection()==true){
			modulos();
		}else{
			require("modulos/error/index.php");
		}
	}else{
		require("modulos/index/index.php");
	}
?>
</div><!-- .container_16 -->
</body>
</html>
<?php mysql_close($conn);?>