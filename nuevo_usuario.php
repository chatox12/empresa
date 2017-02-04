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
    
	   if(!empty($_POST['Ausu_Usuario']) and !empty($_POST['usu_password'])) {
		$guardar = $_POST["enviar_guardar"];
		if(!isset($guardar)){
		$accion= $_GET["enviar_guardar"];}
		
		$nombre = mysqli_real_escape_string($conexion,$_POST['Ausu_nombre']);
		$apellido = mysqli_real_escape_string($conexion,$_POST['Ausu_Apellidos']);
		$user = mysqli_real_escape_string($conexion,$_POST['Ausu_Usuario']);
		$pass = mysqli_real_escape_string($conexion,$_POST['usu_password']);
		$correo = mysqli_real_escape_string($conexion,$_POST['eusu_Correo']);
		$estado = mysqli_real_escape_string($conexion,$_POST['Ausu_Estado']);
		$tipo = mysqli_real_escape_string($conexion,$_POST['Ausu_Tipo']);
		
		$sql = "SELECT * FROM usuario WHERE Usu_Usu = '$user'";
		$result = mysqli_query($conexion,$sql);
		
		if(  mysqli_num_rows($result) > 0){
		 echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">X</button>
		       <strong>Advertencia! </strong>No se puede Almacenar usuario ya existe  </div>';
		}else{
		
		$query_almacenar = mysqli_query($conexion,"INSERT INTO usuario(Usu_Nombre, Usu_Apellido, Usu_Usu,Usu_contra, Usu_Correo, usu_fechaI, Usu_Estado, Usu_TipoUsuario,usu_Ingreso)           VALUES('$nombre','$apellido','$user','$pass','$correo','$hoy','$estado', '$tipo','new')");
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
	<td colspan="3"><center><strong>REGISTRO DE USUARIO</strong></center> </td>
</tr>
<tr>
	<td width="25">
		<label for="textfield">Nombre:</label>
		<input type="text" name="Ausu_nombre" id="usu_nombre" >
		
		<label for="textfield">Apellidos:</label>
		<input type="text" name="Ausu_Apellidos" id="usu_Apellidos" value="">
		<label for="textfield">Usuario:</label>
		<input type="text" name="Ausu_Usuario" id="usu_Usuario" >
		<label for="textfield">Contraseña:</label>
		<input type="password" name="usu_password" id="usu_password" >
		<label for="textfield">Verificar Contraseña:</label>
		<input type="password" name="usu_VerPassword" id="usu_VerPassword" onChange="comparar(usu_password.value,this.value);">	
		<br>
		<!--<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor"> -->
		<button type="button" class="btn btn-primary" onClick="validar(formulario,true)"><i class="icon-fullscreen"></i> Guardar </li></ul></button>		
		<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-eye-open"></i> Cancelar </li></ul></button>
		
			</td>
	<td width="25">
		
		
		<label for="textfield">Correo:</label>
		
		<input type="text" name="eusu_Correo" id="usu_Correo" autocomplete "off" requiered class="form-control">
		
		<label for="textfield">Estado:</label>
		<select name="Ausu_Estado" class="form-control" id="usu_Estado">
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT idEstado, est_Nombre FROM estado";
								$result =  mysqli_query($conexion, $sql);
								
								while($aux = mysqli_fetch_array($result)){
					?> 
							<option value="<?php echo $aux['idEstado']?>"> <?php echo $aux['est_Nombre']?> </option>	
					<?php		}		?> 

		</select>
		<label for="textfield">Tipo de Usuario:</label>
		<select name="Ausu_Tipo" class="form-control" id="usu_tipo">
			<option value="0">[SELECCIONE...] </option>
					<?php
						
								$querytipo =  mysqli_query($conexion,"SELECT idTipoUsuario, tip_Nombre FROM tipousuario");								
								while($tipo = mysqli_fetch_array($querytipo)){
					?> 
							<option value="<?php echo $tipo['idTipoUsuario']?>"> <?php echo $tipo['tip_Nombre']?> </option>	
					<?php	}		?> 

		</select>
	</td>
	<td width="10">
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