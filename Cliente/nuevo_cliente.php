<?php 
 session_start();
include("../Conexion/conexion.php");
$hoy =date('Y-m-d H:i:s');
        $Nombre = '';
		$nit ='';
		$Direccion = '';
		$Correo = '';
		$Telefono ='';
		$Categoria = '';
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
    
	   if(!empty($_POST['ACli_Nombre']) and !empty($_POST['ACli_NIT']) and !empty($_POST['ACli_Direccion']) ) {
		$guardar = $_POST["enviar_guardar"];
		if(!isset($guardar)){
		$accion= $_GET["enviar_guardar"];}
		$Nombre 		= mysqli_real_escape_string($conexion,$_POST['ACli_Nombre']);
		$nit 			= mysqli_real_escape_string($conexion,$_POST['ACli_NIT']);
		$Direccion 		= mysqli_real_escape_string($conexion,$_POST['ACli_Direccion']);
		$Correo 		= mysqli_real_escape_string($conexion,$_POST['eCli_Correo']);
		$Telefono 		= mysqli_real_escape_string($conexion,$_POST['ACli_Telefono']);
		$Categoria  	= mysqli_real_escape_string($conexion,$_POST['ACli_Categoria']);
		$Estado  		= mysqli_real_escape_string($conexion,$_POST['ACli_Estado']);	
				
		$sql = "SELECT * FROM cliente WHERE Cli_NIT = '$nit'";
		$result = mysqli_query($conexion,$sql);			
		if($aux  =  mysqli_fetch_array($result) ){
		$nombre =  $aux['Cli_NIT'];		
			if($nombre ==  "C/F"){
				$query_almacenar = mysqli_query($conexion,"INSERT INTO cliente(Cli_Nombre, Cli_NIT, Cli_Direccion, Cli_Correo, Cli_Telefono, Cli_Categoria, Cli_FechaI, Cli_Estado)
																VALUES('$Nombre', '$nit', '$Direccion','$Correo', '$Telefono', '$Categoria', '$hoy', '$Estado')");
		$result_nuevo = mysqli_query($conexion,$query_almacenar);
	
		echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Usuario!</strong> Guardado con Exito <a href="index.php"> ir Principal </a></div>' ;		
			}else{
		if(  mysqli_num_rows($result) > 0){
		 echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">X</button>
		       <strong>Advertencia! </strong>No se puede Almacenar cliente ya existe con ese NIT '. $nit .'</div>';			  
		}else{		
		$query_almacenar = mysqli_query($conexion,"INSERT INTO cliente(Cli_Nombre, Cli_NIT, Cli_Direccion, Cli_Correo, Cli_Telefono, Cli_Categoria, Cli_FechaI, Cli_Estado)
																VALUES('$Nombre', '$nit', '$Direccion','$Correo', '$Telefono', '$Categoria', '$hoy', '$Estado')");
		$result_nuevo = mysqli_query($conexion,$query_almacenar);
	
		echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Usuario!</strong> Guardado con Exito <a href="index.php"> ir Principal </a></div>' ; 		
		}
				
				
			}	
			
		}
		
		
		

	

}

?>


<div class="control-group info">

<form  method="post" action="" name="formulario" id="formulario">
<input type="hidden" name="enviar_guardar" id="enviar_guardar" value="ingreso">

<table border="0" class="table" width="80%">
<tr class="info"> 
	<td colspan="3"><center><strong>REGISTRO DE CLIENTE</strong></center> </td>
</tr>
<tr>
	<td width="399">
		<label for="textfield">Nombre:</label>
		<input type="text" name="ACli_Nombre" id="Cli_Nombre" autofocus>
		
		<label for="textfield">NIT:</label>
		<input type="text" name="ACli_NIT" id="Cli_NIT" value="C/F">
		
		<label for="textfield">Direccion:</label>
		<input type="text" name="ACli_Direccion" id="Cli_Direccion" value="Ciudad" >
		
		<label for="textfield">Correo:</label>		
		<input type="text" name="eCli_Correo" id="Cli_Correo">
						
		<br>
		<!--<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor"> -->
		<button type="button" class="btn btn-primary" onClick="validar(formulario,true)"><i class="icon-fullscreen"></i> <?php echo $boton ?> </li></ul></button>		
		<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-eye-open"></i> Cancelar </li></ul></button>
		
		</td>
	<td width="390">
		<label for="textfield">Telefono:</label>
		<input type="text" name="ACli_Telefono" id="Cli_Telefono" >
		
		<label for="textfield">Categoria:</label>
		<select  name="ACli_Categoria" id="Cli_Categoria" >
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT * FROM categoriacli";
								$result =  mysqli_query($conexion, $sql);
								
								while($aux = mysqli_fetch_array($result)){
					?> 
			<option value="<?php echo $aux['IdCategoriaCli']?>"> <?php echo $aux['CatCli_Nombre']?> </option>	
					<?php		}		?> 
		</select>
		

		<label for="textfield">Estado:</label>
		<select name="ACli_Estado" id="Cli_Estado">
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