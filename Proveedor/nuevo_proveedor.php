<?php 
 session_start();
include("../Conexion/conexion.php");
$hoy =date('Y-m-d H:i:s');
        $Nombre = '';
		$nit ='';
		$Direccion = '';
		$Contacto = '';
		$Telefono ='';
		$Celular = '';
		$Departamento = '';
		$Municipio = '';
		$Correo = '';
		$Comentario = '';
		$Estado = '';	
		$boton ="Guardar"; 
		


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
			
 			

				
	
	</script>
	
	
	
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<?php
    
	   if(!empty($_POST['Aprov_nombre']) and !empty($_POST['Aprov_nit']) and !empty($_POST['Aprov_direccion']) ) {
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
		
		$sql = "SELECT * FROM Proveedor WHERE Prov_NIT = '$nit'";
		$result = mysqli_query($conexion,$sql);
		
		if(  mysqli_num_rows($result) > 0){
		 echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">X</button>
		       <strong>Advertencia! </strong>No se puede Almacenar Proveedor ya existe con ese NIT '. $nit .'</div>';
			  
		}else{
		
		$query_almacenar = mysqli_query($conexion,"INSERT INTO Proveedor(Prov_Nombre, Prov_NIT, Prov_Direccion, Prov_Contacto, Prov_Celular, Prov_Telefono, Prov_Departamento, Prov_Municipio, Prov_Corre, Prov_Observacion, Prov_Estado)VALUES('$Nombre','$nit','$Direccion','$Contacto','$Telefono','$Celular','$Departamento', '$Municipio','$Correo','$Comentario','$Estado')");

		$result_nuevo = mysqli_query($conexion,$query_almacenar);
	
		echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Usuario!</strong> Guardado con Exito <a href="index.php"> ir Principal </a></div>' ; 
		
		
		}
		
		 
	

}

?>


<div class="control-group info">

<form  method="post" action="" name="formulario" id="formulario">
<input type="hidden" name="enviar_guardar" id="enviar_guardar" value="ingreso">

<table border="0" class="table" width="80%">
<tr class="info"> 
	<td colspan="3"><center><strong>REGISTRO DE PROVEEDOR</strong></center> </td>
</tr>
<tr>
	<td width="399">
		<label for="textfield">Nombre:</label>
		<input type="text" name="Aprov_nombre" id="usu_nombre" autofocus>
		
		<label for="textfield">NIT:</label>
		<input type="text" name="Aprov_nit" id="prov_nit" value="">
		
		<label for="textfield">Direccion:</label>
		<input type="text" name="Aprov_direccion" id="prov_direccion" >
		
		<label for="textfield">Nombre Contacto:</label>
		<input type="text" name="Aprov_Contacto" id="prov_Contacto" >
		
		<label for="textfield">Telefono:</label>
		<input type="text" name="Aprov_Telefono" id="prov_Telefono">	
		
		<label for="textfield">Celular:</label>
		<input type="text" name="Aprov_Celular" id="prov_Celular">
		
	
				
		<br>
		<!--<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor"> -->
		<button type="button" class="btn btn-primary" onClick="validar(formulario,true)"><i class="icon-fullscreen"></i> <?php echo $boton ?> </li></ul></button>		
		<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-eye-open"></i> Cancelar </li></ul></button>
		
		</td>
	<td width="390">
		<label for="textfield">Departamento:</label>
		<select  name="Aprov_Departamento" id="prov_Departamento">
		<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT * FROM departamento";
								$result =  mysqli_query($conexion, $sql);
								
								while($aux = mysqli_fetch_array($result)){
					?> 
		<option value="<?php echo $aux['IdDepartamento']?>"> <?php echo $aux['Dep_Nombre']?> </option>	
					<?php		}		?> 
		</select>
		
		
		<label for="textfield">Municipio:</label>
		<select  name="Aprov_Municipio" id="prov_Municipio" >
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT * FROM municipio";
								$result =  mysqli_query($conexion, $sql);
								
								while($aux = mysqli_fetch_array($result)){
					?> 
		<option value="<?php echo $aux['IdMunicipio']?>"> <?php echo $aux['Mun_Nombre']?> </option>	
					<?php		}		?> 
		</select>
		
		
		<label for="textfield">Correo:</label>		
		<input type="text" name="eProv_Corre" id="Prov_Corre" autocomplete "off" requiered class="form-control">
		
		<label for="textfield">Comentario:</label>	
		<textarea name="Aprov_Observacion" id="prov_Observacion" cols="10" rows="5"></textarea>	
		
		
		
		<label for="textfield">Estado:</label>
		<select name="Aprov_Estado" class="form-control" id="prov_Estado">
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT idEstado, est_Nombre FROM estado";
								$result =  mysqli_query($conexion, $sql);
								
								while($aux = mysqli_fetch_array($result)){
					?> 
							<option value="<?php echo $aux['idEstado']?>"> <?php echo $aux['est_Nombre']?> </option>	
					<?php		}		?> 

		</select>
		
	</td>
	<td width="517">
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