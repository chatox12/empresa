<?php 
session_start();
include("../Conexion/conexion.php");
$hoy =date('Y-m-d');
  
?> 
<!DOCTYPE html>
<html>
<head>
	<title> Seleccionar_cliente</title>

	<link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../css/docs.css" rel="stylesheet">
    <link href="../js/google-code-prettify/prettify.css" rel="stylesheet">
	<script type="text/javascript" src="../funciones/validar.js"></script>
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	<script src="../js/jquery.js"></script>
    <script src="../js/bootstrap-transition.js"></script>
    <script src="../js/bootstrap-alert.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-dropdown.js"></script>
    <script src="../js/bootstrap-scrollspy.js"></script>
    <script src="../js/bootstrap-tab.js"></script>
    <script src="../js/bootstrap-tooltip.js"></script>
    <script src="../js/bootstrap-popover.js"></script>
    <script src="../js/bootstrap-button.js"></script>
    <script src="../js/bootstrap-collapse.js"></script>
    <script src="../js/bootstrap-carousel.js"></script>
    <script src="../js/bootstrap-typeahead.js"></script>
    <script src="../js/bootstrap-affix.js"></script>
    <script src="../js/holder/holder.js"></script>
    <script src="../js/google-code-prettify/prettify.js"></script>
    <script src="../js/application.js"></script>
	
	<script language="javascript">
		var cursor;
			if (document.all){
				cursor = 'hand';
			}else{
			    cursor = 'pointer';
			}
			
				function limpiar(){
				  document.getElementById("usu_nombre").value="A";
				  document.getElementById("usu_Apellidos").value="";
				 			
				}
					
	</script>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<div class="control-group info">
<form  method="post" action="" name="formulario" id="formulario">
<input type="hidden" name="enviar_guardar" id="enviar_guardar" value="ingreso">
<table border="0" class="table" width="97%">
<tr class="info"> 
	<td colspan="6"><center></center> </td>
</tr>
<tr>
	<td width="202">
				<h1> <strong>			    MANUAL DE USUARIO</strong></h1></td>
	
</tr>
</table>
<iframe src="manual.pdf" colws="" rows=""width=1200 height=500 align="center"><iframe>
	<input type="hidden" name="id" id="id" value="">
</form >
</div>	
</div>
</div>
</body>
</html>