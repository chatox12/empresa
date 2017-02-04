<?php 
 session_start();
include("../Conexion/conexion.php");
$hoy =date('Y-m-d H:i:s');
        $Codigo_producto = '';
		$Cantidad ='';
		$boton ="Guardar";
		


?> 
<!DOCTYPE html>
<html>
<head>
	<title> REGISTRO DE COMPRAS </title>

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
	

	
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<?php
$fecha = date("Y-m-d");
    
	   if(!empty($_POST['Codigo_producto'])) {
		$guardar = $_POST["enviar_guardar"];
		
		if(!isset($guardar)){
		$accion= $_GET["enviar_guardar"];}
		$Cod = mysqli_real_escape_string($conexion,$_POST['Codigo_producto']);
		$Cant = mysqli_real_escape_string($conexion,$_POST['Cantidad']);
		
		//seleccionar Id producto
		$query_id_producto = mysqli_query($conexion, "SELECT idProducto from Producto where Pro_BarCode = '$Cod'");
		//$resul_id_producto = mysqli_fetch_array($query_id_producto);
		$var_id = 0;
		if($row = mysqli_fetch_array($query_id_producto)){
			$var_id = $row[0];

		}

		$query_almacenar = mysqli_query($conexion,"UPDATE .Producto SET Pro_Stock = Pro_Stock+$Cant WHERE idProducto = '$var_id'");
		$result_nuevo = mysqli_query($conexion,$query_almacenar);

		//insertar en compras
		$sql_insert = "INSERT INTO Compras(com_fecha, Producto_idProducto) values('$fecha',$var_id)";
		$query_insertar_compras = mysqli_query($conexion, $sql_insert);
		//$query_inser_new = mysqli_query($conexion, $query_insertar_compras);

			echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Usuario!</strong> Actualizado con exito </div></div>' ; 
		}

		

?>


<div class="control-group info">

<form  method="post" action="" name="formulario" id="formulario">
<input type="hidden" name="enviar_guardar" id="enviar_guardar" value="ingreso">

<table border="0" class="table" width="80%">
<tr class="info"> 
	<td colspan="3"><center><strong>REGISTRO DE NUEVA COMPRA</strong></center> </td>
</tr>
<tr>
	<td width="25">
		<label for="textfield"> Codigo Producto
		  <br>
		  <input type="text" name="Codigo_producto" id="Codigo_producto"  >
        </label>
		<label for="textfield"> Cantidad</label>
		<input type="text" name="Cantidad" id="Cantidad">
		
		
		<br>
		<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">	</td>
	<td width="25">
		
		
<td width="10">
	<ul id="lista-errores"></ul>
	</td>
	
</tr>
</table>
	<input type="hidden" name="id" id="id" value="">
</form >


</div>


</body>


</html>