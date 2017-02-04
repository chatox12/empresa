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
			$query = "SELECT * FROM usuario WHERE idUsuario = '$idmodificar' ";
			$queryresult = mysqli_query($conexion,$query);
			if($resultado = mysqli_fetch_array($queryresult)){
				$nombre = $resultado['Usu_Nombre'];
				$apellido = $resultado['Usu_Apellido'];
				$user = $resultado['Usu_Usu'];
				$pass = $resultado['Usu_Contra'];
				$correo = $resultado['Usu_Correo'];
				$estado = $resultado['Usu_Estado'];
				$tipo = $resultado['Usu_TipoUsuario']; 			
			
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
    
	   if(!empty($_POST['Ausu_Usuario'])) {
		$guardar = $_POST["enviar_guardar"];
		
		if(!isset($guardar)){
		$accion= $_GET["enviar_guardar"];}
		$nombre = mysqli_real_escape_string($conexion,$_POST['Ausu_nombre']);
		$apellido = mysqli_real_escape_string($conexion,$_POST['Ausu_Apellidos']);
		$user = mysqli_real_escape_string($conexion,$_POST['Ausu_Usuario']);
	
		$correo = mysqli_real_escape_string($conexion,$_POST['eusu_Correo']);
		$estado = mysqli_real_escape_string($conexion,$_POST['Ausu_Estado']);
		$tipo = mysqli_real_escape_string($conexion,$_POST['Ausu_Tipo']);
		
		$query_almacenar = mysqli_query($conexion,"UPDATE usuario SET Usu_Nombre = '$nombre' , Usu_Apellido = '$apellido', Usu_Usu = '$user',  Usu_Correo = '$correo' , usu_fechaI = '$hoy', Usu_Estado='$estado' , Usu_TipoUsuario = '$tipo' WHERE IdUsuario = $idmodificar");
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
	<td colspan="3"><center><strong>REGISTRO DE USUARIO</strong></center> </td>
</tr>
<tr>
	<td width="25">
		<label for="textfield">Nombre:</label>
		<input type="text" name="Ausu_nombre" id="usu_nombre" value="<?php echo $nombre?>" >
		<label for="textfield">Apellidos:</label>
		<input type="text" name="Ausu_Apellidos" id="usu_Apellidos" value="<?php echo $apellido?>">
		<label for="textfield">Usuario:</label>
		<input type="text" name="Ausu_Usuario" id="usu_Usuario" value="<?php echo $user?>" readonly>
		<br>
		<!--<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">-->
		
		<button type="button" class="btn btn-primary" onClick="validar(formulario,true)"><i class="icon-fullscreen"></i> Editar </li></ul></button>		
		<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-eye-open"></i> Cancelar </li></ul></button>
			</td>
	<td width="25">
		<label for="textfield">Correo:</label>		
		<input type="text" name="eusu_Correo" id="usu_Correo" autocomplete "off" requiered class="form-control" value="<?php echo $correo?>">		
		<label for="textfield">Estado:</label>
		
		<select name="Ausu_Estado" class="form-control" id="usu_Estado">
			<option value="0">[SELECCIONE...] </option>
					<?php
									$query = "SELECT * FROM estado ORDER BY Est_Nombre ASC ";
									$queryResult = mysqli_query($conexion,$query);			
								while($aux = mysqli_fetch_array($queryResult)){
									if($estado==$aux['IdEstado']){
					?> 
							<option value="<?php echo $aux['IdEstado']?>" selected="selected"> <?php echo $aux['Est_Nombre']?> </option>	
					<?php		}else{
					?> 
							<option value="<?php echo $aux['IdEstado']?>"> <?php echo $aux['Est_Nombre']?> </option>	
					<?php		
					
					
					}}		?> 

		</select>
		
		<label for="textfield">Tipo de Usuario:</label>
		
		<select name="Ausu_Tipo" class="form-control" id="usu_tipo">
			<option value="0">[SELECCIONE...] </option>
					<?php
					
									$query = "SELECT * FROM tipousuario ORDER BY Tip_Nombre ASC ";
									$queryResult = mysqli_query($conexion,$query);	
								
								while($aux = mysqli_fetch_array($queryResult)){	
								if($tipo==$aux['IdTipoUsuario']){
					?> 
							<option value="<?php echo $aux['IdTipoUsuario']?>" selected="selected"> <?php echo $aux['Tip_Nombre']?> </option>	
					<?php		}else{
					?> 
							<option value="<?php echo $aux['IdTipoUsuario']?>"> <?php echo $aux['Tip_Nombre']?> </option>	
					<?php		
					
					
					}}		?> 

		</select>
	</td>
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