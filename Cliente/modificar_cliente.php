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
		
		if(!empty($_GET['modificar'])){
			$idmodificar = $_GET['modificar'];
			$query = "SELECT * FROM cliente WHERE IdCliente = '$idmodificar' ";
			$queryresult = mysqli_query($conexion,$query);
			if($resultado = mysqli_fetch_array($queryresult)){				
				$Nombre = 			$resultado['Cli_Nombre'];
				$nit =				$resultado['Cli_NIT'];
				$Direccion = 		$resultado['Cli_Direccion'];
				$Correo = 			$resultado['Cli_Correo'];
				$Telefono =			$resultado['Cli_Telefono'];
				$Categoria = 		$resultado['Cli_Categoria'];
				$Estado = 			$resultado['Cli_Estado'];
			
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
    
	   if(!empty($_POST['ACli_Nombre']) and !empty($_POST['ACli_NIT']) and !empty($_POST['ACli_Direccion'])) {
		$guardar = $_POST["enviar_guardar"];
		
		if(!isset($guardar)){
		$accion= $_GET["enviar_guardar"];}
		
		
		$Nombre =		mysqli_real_escape_string($conexion,$_POST['ACli_Nombre']);
		$nit =			mysqli_real_escape_string($conexion,$_POST['ACli_NIT']);
		$Direccion = 	mysqli_real_escape_string($conexion,$_POST['ACli_Direccion']);
		$Correo =		mysqli_real_escape_string($conexion,$_POST['eCli_Correo']);
		$Telefono =		mysqli_real_escape_string($conexion,$_POST['ACli_Telefono']);
		$Categoria = 	mysqli_real_escape_string($conexion,$_POST['ACli_Categoria']);
		$Estado = 		mysqli_real_escape_string($conexion,$_POST['ACli_Estado']);	
		
		
		
		
		$query_almacenar = mysqli_query($conexion,"UPDATE cliente SET Cli_Nombre = '$Nombre', 
																	  Cli_NIT  = '$nit', 
																	  Cli_Direccion  = '$Direccion', 
																	  Cli_Correo  = '$Correo' , 
																	  Cli_Telefono  = '$Telefono', 
																	  Cli_Categoria = '$Categoria', 
																	  Cli_FechaI = '$hoy ', 
																	  Cli_Estado = '$Estado' 
																	  WHERE IdCliente = $idmodificar");
		
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
	  <strong>ACTUALIZAR  CLIENTE </strong>
	</center> </td>
</tr>
<tr>
	<td width="397">
		<label for="textfield">Nombre:</label>
		<input type="text" name="ACli_Nombre" id="Cli_Nombre"  value="<?php echo $Nombre ?>" autofocus>
		
		<label for="textfield">NIT:</label>
		<input type="text" name="ACli_NIT" id="Cli_NIT"  value="<?php echo $nit ?>">
		
		<label for="textfield">Direccion:</label>
		<input type="text" name="ACli_Direccion" id="Cli_Direccion" value="<?php echo $Direccion ?>">
		
		<label for="textfield">Correo:</label>
		<input type="text" name="eCli_Correo" id="Cli_Correo" value="<?php echo $Correo ?>">
					
		<br>
		<!--<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">-->
		
		<button type="button" class="btn btn-primary" onClick="validar(formulario,true)"><i class="icon-fullscreen"></i> Editar </li></ul></button>		
		<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-eye-open"></i> Cancelar </li></ul></button>
		</td>
	<td width="396">
			
		<label for="textfield">Telefono:</label>		
		<input type="text" name="ACli_Telefono" id="Cli_Telefono" value="<?php echo $Telefono ?>">
		
		<label for="textfield">Estado:</label>		
		<select name="ACli_Estado" id="ACli_Estado">
			<option value="0">[SELECCIONE...] </option>
					<?php
									$query = "SELECT * FROM categoriacli ORDER BY CatCli_Nombre ASC ";
									$queryResult = mysqli_query($conexion,$query);			
								while($aux = mysqli_fetch_array($queryResult)){
									if($Categoria==$aux['IdCategoriaCli']){
					?> 
							<option value="<?php echo $aux['IdCategoriaCli']?>" selected="selected"> <?php echo $aux['CatCli_Nombre']?> </option>	
					<?php		}else{
					?> 
							<option value="<?php echo $aux['IdCategoriaCli']?>"> <?php echo $aux['CatCli_Nombre']?> </option>	
					<?php		
										
					}}		?> 

		</select>
			
			
		<label for="textfield">Estado:</label>		
		<select name="ACli_Categoria" class="form-control" id="Cli_Categoria">
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