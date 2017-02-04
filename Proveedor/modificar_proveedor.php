<?php 
 session_start();
include("../Conexion/conexion.php");
$hoy =date('Y-m-d H:i:s');
        $nombre = '';
		$apellido ='';
		$user = '';
		$pass = '';
		$correo ='';
		$estado = '';
		$tipo = '';
		$boton ="Guardar";
		if(!empty($_GET['modificar'])){
			$idmodificar = $_GET['modificar'];
			$query = "SELECT * FROM proveedor WHERE idProveedor = '$idmodificar' ";
			$queryresult = mysqli_query($conexion,$query);
			if($resultado = mysqli_fetch_array($queryresult)){				
				$Nombre = 			$resultado['Prov_Nombre'];
				$nit =				$resultado['Prov_NIT'];
				$Direccion =		$resultado['Prov_Direccion'];
				$Contacto =			$resultado['Prov_Contacto'];
				$Telefono =			$resultado['Prov_Telefono'];
				$Celular = 			$resultado['Prov_Celular'];
				$Departamento = 	$resultado['Prov_Departamento'];
				$Municipio = 		$resultado['Prov_Municipio'];
				$Correo = 			$resultado['Prov_Corre'];
				$Comentario = 		$resultado['Prov_Observacion'];
				$Estado = 			$resultado['Prov_Estado'];	
			
			}
		}


?> 
<!DOCTYPE html>
<html>
<head>
	<title> INGRESE DE NUEVOS USUARIOS </title>

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
				
				function comparar(primero,segundo){
					if(primero==segundo){
					}						
					else{
					msg = alert ("No coninciden las contrasenas");
					document.getElementById("usu_VerPassword").value="";
					}
				}
	
	</script>
	
	
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<?php
    
	   if(!empty($_POST['Aprov_nombre']) and !empty($_POST['Aprov_nit']) and !empty($_POST['Aprov_direccion'])) {
		$guardar = $_POST["enviar_guardar"];
		
		if(!isset($guardar)){
		$accion= $_GET["enviar_guardar"];}
		
		$Nombre = 			mysqli_real_escape_string($conexion,$_POST['Aprov_nombre']);
		$nit =				mysqli_real_escape_string($conexion,$_POST['Aprov_nit']);
		$Direccion =		mysqli_real_escape_string($conexion,$_POST['Aprov_direccion']);
		$Contacto =			mysqli_real_escape_string($conexion,$_POST['Aprov_Contacto']);
		$Telefono =			mysqli_real_escape_string($conexion,$_POST['Aprov_Telefono']);
		$Celular = 			mysqli_real_escape_string($conexion,$_POST['Aprov_Celular']);
		$Departamento = 	mysqli_real_escape_string($conexion,$_POST['Aprov_Departamento']);
		$Municipio = 		mysqli_real_escape_string($conexion,$_POST['Aprov_Municipio']);
		$Correo = 			mysqli_real_escape_string($conexion,$_POST['eProv_Corre']);
		$Comentario = 		mysqli_real_escape_string($conexion,$_POST['Aprov_Observacion']);
		$Estado = 			mysqli_real_escape_string($conexion,$_POST['Aprov_Estado']);
		
		$query_almacenar = mysqli_query($conexion,"UPDATE proveedor SET Prov_Nombre = '$Nombre', 
																	  Prov_NIT  = '$nit', 
																	  Prov_Direccion  = '$Direccion', 
																	  Prov_Contacto  = '$Contacto' , 
																	  Prov_Celular  = '$Celular', 
																	  Prov_Telefono = '$Telefono', 
																	  Prov_Departamento = '$Departamento ', 
																	  Prov_Municipio = '$Municipio', 
																	  Prov_Corre = '$Correo', 
																	  Prov_Observacion = '$Comentario', 
																	  Prov_Estado = '$Estado' 
																	  WHERE idProveedor = $idmodificar");
		
		$result_nuevo = mysqli_query($conexion,$query_almacenar);
			echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Usuario!</strong> Actualizado con exito <a href="index.php"> ir Principal </a></div></div>' ; 
		}

?>


<div class="control-group info">

<form  method="post" action="" name="formulario" id="formulario">
<input type="hidden" name="enviar_guardar" id="enviar_guardar" value="ingreso">



<table border="0" class="table" width="80%">
<tr class="info"> 
	<td colspan="3"><center>
	  <strong>ACTUALIZAR  PROVEEDOR </strong>
	</center> </td>
</tr>
<tr>
	<td width="397">
		<label for="textfield">Nombre:</label>
		<input type="text" name="Aprov_nombre" id="usu_nombre"  value="<?php echo $Nombre ?>" autofocus>
		
		<label for="textfield">NIT:</label>
		<input type="text" name="Aprov_nit" id="prov_nit"  value="<?php echo $nit ?>" readonly>
		
		<label for="textfield">Direccion:</label>
		<input type="text" name="Aprov_direccion" id="prov_direccion" value="<?php echo $Direccion ?>">
		
		<label for="textfield">Nombre Contacto:</label>
		<input type="text" name="Aprov_Contacto" id="prov_Contacto" value="<?php echo $Contacto ?>">
		
		<label for="textfield">Telefono:</label>
		<input type="text" name="Aprov_Telefono" id="prov_Telefono" value="<?php echo $Telefono ?>">	
		
		<label for="textfield">Celular:</label>
		<input type="text" name="Aprov_Celular" id="prov_Celular" value="<?php echo $Celular ?>">
	
					
		<br>
		<!--<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">-->
		
		<button type="button" class="btn btn-primary" onClick="validar(formulario,true)"><i class="icon-fullscreen"></i> Editar </li></ul></button>		
		<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-eye-open"></i> Cancelar </li></ul></button>
		</td>
	<td width="396">
		<label for="textfield">Departamento:</label>
		<select  name="Aprov_Departamento" id="prov_Departamento" >
		<option value="0"></option>
		<option value="1"></option>
		</select>
		
		
		<label for="textfield">Municipio:</label>
		<select  name="Aprov_Municipio" id="prov_Municipio" >
		<option value="0"></option>
		<option value="1"></option>
		</select>
		
		
		<label for="textfield">Correo:</label>		
		<input type="text" name="eProv_Corre" id="Prov_Corre" autocomplete "off"  value="<?php echo $Correo ?>">
		
		<label for="textfield">Comentario:</label>	
		<textarea name="Aprov_Observacion" id="prov_Observacion" cols="10" rows="5"><?php  echo $Comentario ?></textarea>		
			
		<label for="textfield">Estado:</label>		
		<select name="Aprov_Estado" class="form-control" id="prov_Estado">
			<option value="0">[SELECCIONE...] </option>
					<?php
									$query = "SELECT * FROM estado ORDER BY Est_Nombre ASC ";
									$queryResult = mysqli_query($conexion,$query);			
								while($aux = mysqli_fetch_array($queryResult)){
									if($Estado==$aux['IdEstado']){
					?> 
							<option value="<?php echo $aux['IdEstado']?>" selected="selected"> <?php echo $aux['Est_Nombre']?> </option>	
					<?php		}else{
					?> 
							<option value="<?php echo $aux['IdEstado']?>"> <?php echo $aux['Est_Nombre']?> </option>	
					<?php		
					
					
					}}		?> 

		</select>
		
	</td>
	<td width="513">
	<div class="alert alert-danger">
	<ul id="lista-errores"></ul>
	</div>
	</td>
	
</tr>
</table>
	<input type="hidden" name="id" id="id" value="">
</form >


</div>


</body>


</html>