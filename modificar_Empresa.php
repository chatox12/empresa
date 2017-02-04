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
			$query = "SELECT * FROM empresaumg WHERE IdEmpresa = '$idmodificar' ";
			$queryresult = mysqli_query($conexion,$query);
			if($resultado = mysqli_fetch_array($queryresult)){
			
				$nombre = $resultado['Emp_Nombre'];
				$nit = $resultado['Emp_NIT'];
				$direccion = $resultado['Emp_Direccion'];
				$ciudad = $resultado['Emp_Ciudad'];
				$celular = $resultado['Emp_Celular'];
				$telefono = $resultado['Emp_Telefono'];
				$correo = $resultado['Emp_Correo']; 
				$iva = $resultado['Emp_Iva']; 
				$moneda = $resultado['Emp_Moneda']; 			
			
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


<div class="control-group info">

<form  method="post" action="" name="formulario" id="formulario"  enctype="multipart/form-data">
<input type="hidden" name="enviar_guardar" id="enviar_guardar" value="ingreso">

<table border="0" class="table" width="80%">
<tr class="info"> 
	<td colspan="3"><center><strong>REGISTRO DE USUARIO</strong></center> </td>
</tr>
<tr>
	<td width="25">
		<label for="textfield">Nombre:</label>
		<input type="text" name="AEmp_Nombre" id="Emp_Nombre" value="<?php echo $nombre?>" >
		
		<label for="textfield">NIT:</label>
		<input type="text" name="AEmp_NIT" id="Emp_NIT" value="<?php echo $nit?>">
		
		<label for="textfield">Direccion:</label>
		<input type="text" name="AEmp_Direccion" id="Emp_Direccion" value="<?php echo $direccion?>">
		
		<label for="textfield">Ciudad:</label>
		<input type="text" name="AEmp_Ciudad" id="Emp_Ciudad" value="<?php echo $ciudad?>">
		
		<label for="textfield">Celular:</label>
		<input type="text" name="AEmp_Celular" id="Emp_Celular" value="<?php echo $celular?>">
		
		<label for="textfield">Telefono:</label>		
		<input type="text" name="AEmp_Telefono" id="Emp_Telefono" value="<?php echo $telefono?>">
		
		<label for="textfield">Correo:</label>		
		<input type="text" name="eEmp_Correo" id="Emp_Correo" value="<?php echo $correo?>">
		<br>
		<!--<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">-->
		
		<button type="button" class="btn btn-primary" onClick="validar(formulario,true)"><i class="icon-fullscreen"></i> Editar </li></ul></button>		
		<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-eye-open"></i> Cancelar </li></ul></button>
			</td>
	<td width="25">
		<label for="textfield">IVA:</label>		
		<input type="number" name="AEmp_Iva" id="Emp_Iva" value="<?php echo $iva?>">
		
		<label for="textfield">Moneda:</label>		
		<input type="text" name="AEmp_Moneda" id="Emp_Moneda"   maxlength="1" value="<?php echo $moneda?>">		
		
		<label for="textfield">Logo de Empresa:</label>	
			<?php 
					if(file_exists("../fotos/".$idmodificar.".jpg")){
						echo '<img src="../fotos/'.$idmodificar.'.jpg"  width="200" height="200" class="img-rounded">';
					}else{
						echo '<img src="../fotos/logo.png"  width="200" height="200" class="img-rounded">';
					}
			?>
			 
		<br>
		<input type="file" name="imagen" id="imagen">
	
	</td>
	<td width="10">
	<ul id="lista-errores"></ul>
	</td>
	
</tr>
</table>
	<input type="hidden" name="id" id="id" value="">
</form >
<?php
    
	   if(!empty($_POST['AEmp_NIT'])) {
	   
	  		 $nameimagen = $_FILES['imagen']['name'];
			$tmpimagen = $_FILES['imagen']['tmp_name'];
			$extimagen = pathinfo($nameimagen);
			$ext = array("png","jpg");
			$urlnueva = "../fotos/".$idmodificar.".jpg";			
			if(is_uploaded_file($tmpimagen)){
				if(array_search($extimagen['extension'],$ext)){
					copy($tmpimagen,$urlnueva);	
				}
			}
			
		$guardar = $_POST["enviar_guardar"];
		if(!isset($guardar)){$accion= $_GET["enviar_guardar"];}
		
		$nombre = mysqli_real_escape_string($conexion,$_POST['AEmp_Nombre']);
		$nit = mysqli_real_escape_string($conexion,$_POST['AEmp_NIT']);
		$direccion = mysqli_real_escape_string($conexion,$_POST['AEmp_Direccion']);
		$ciudad = mysqli_real_escape_string($conexion,$_POST['AEmp_Ciudad']);
		$celular = mysqli_real_escape_string($conexion,$_POST['AEmp_Celular']);
		$telefono = mysqli_real_escape_string($conexion,$_POST['AEmp_Telefono']);
		$correo = mysqli_real_escape_string($conexion,$_POST['eEmp_Correo']);
		$iva = mysqli_real_escape_string($conexion,$_POST['AEmp_Iva']);
		$moneda = mysqli_real_escape_string($conexion,$_POST['AEmp_Moneda']);
		
		$query_almacenar = mysqli_query($conexion,"UPDATE empresaumg SET 
																	Emp_Nombre ='$nombre', 
																	Emp_NIT ='$nit', 
																	Emp_Direccion ='$direccion', 
																	Emp_Ciudad ='$ciudad', 
																	Emp_Celular ='$celular', 
																	Emp_Telefono ='$telefono', 
																	Emp_Correo ='$correo', 
																	Emp_Iva ='$iva', 
																	Emp_Moneda ='$moneda' 
																	WHERE IdEmpresa = $idmodificar");
		$result_nuevo = mysqli_query($conexion,$query_almacenar);
			echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Usuario!</strong> Actualizado con exito <a href="index.php"> ir Principal </a></div></div>' ; 
			  
			
 
			
			  
			
		}
		
	
?>


</div>


</body>


</html>