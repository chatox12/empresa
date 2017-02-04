<?php 
 session_start();
include("../Conexion/conexion.php");
$hoy =date('Y-m-d');

        $nombre = '';
		$apellido ='';
		$user = '';
		$pass = '';
		$correo ='';
		$estado = '';
		$tipo = '';
		$boton ="Guardar";
		$sim_Moneda  = '';
		$sim_iva = '';
		$query_empresa = "SELECT * from empresaumg";
		$empresa = mysqli_query($conexion,$query_empresa);
		if($aux = mysqli_fetch_array($empresa)){
			$sim_Moneda = $aux['Emp_Moneda'];
			$sim_iva = $aux['Emp_Iva'];
		}
		
		if(!empty($_GET['modificar'])){
			$idmodificar = $_GET['modificar'];
			$query = "SELECT * FROM producto WHERE idProducto = '$idmodificar' ";
			$queryresult = mysqli_query($conexion,$query);
			if($resultado = mysqli_fetch_array($queryresult)){
			
					$BarCode = 		 $resultado['Pro_BarCode'];
					$Nombre = 		 $resultado['Pro_Nombre'];
					$Marca = 		 $resultado['Pro_Marca'];
					$Categoria = 	 $resultado['Pro_Categoria'];
					$SubCategoria =  $resultado['Pro_subcategoria'];
					$UnidadMedida =  $resultado['Pro_UnidadMedida'];
					$Proveedor = 	 $resultado['Pro_Proveedor'];
					$CodProveedor =  $resultado['Pro_CodProveedor'];
					$Costo = 		 $resultado['Pro_Costo'];
					$Stock = 		 $resultado['Pro_Stock'];
					$StockM = 		 $resultado['Pro_StockMinimo'];
					$Venta = 		 $resultado['Pro_venta'];
					$Mayor = 		 $resultado['Pro_Mayor'];
					$Comentario = 	 $resultado['Pro_Comentario'];
					$Fecha = 		 $resultado['Pro_Fecha'];
					$Estado = 		 $resultado['Pro_Estado'];
				 			
			}
		}


?> 
<!DOCTYPE html>
<html>
<head>
	<title> MODIFICAR PRODUCTO </title>

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
				
					function precios(){
						var compra = parseFloat(document.getElementById('Pro_Costo').value);
						var GananciP = parseFloat((document.getElementById('Ganancia').value)/100);
						var GananciM = parseFloat((document.getElementById('GananciaM').value)/100);
						var iva  = parseFloat(document.getElementById('Pro_iva').value);
						
						
						var PrecioVentaP = parseFloat((compra * GananciP) +  compra).toFixed(2);
					if(!isNaN(PrecioVentaP)){
						document.getElementById('Pro_venta').value = PrecioVentaP;
					}
					
						var PrecioVentaM = parseFloat((compra * GananciM) +  compra).toFixed(2);
					if(!isNaN(PrecioVentaM)){
						document.getElementById('Pro_Mayor').value = PrecioVentaM;
					}
					
					var sinIva = parseFloat(compra/((iva/100)+1)).toFixed(2);
					if(!isNaN(sinIva)){
						document.getElementById('Pro_sinIva').value = sinIva;
					}
				
				
				
				}
	
	</script>
	
	
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<?php
    
	   if(!empty($_POST['APro_Nombre'])) {
		$guardar = $_POST["enviar_guardar"];
		
		if(!isset($guardar)){
		$accion= $_GET["enviar_guardar"];}
		$BarCode = 		mysqli_real_escape_string($conexion,$_POST['APro_BarCode']);
		$Nombre = 		mysqli_real_escape_string($conexion,$_POST['APro_Nombre']);
		$Marca = 		mysqli_real_escape_string($conexion,$_POST['APro_Marca']);
		$Categoria = 	mysqli_real_escape_string($conexion,$_POST['APro_Categoria']);
		$SubCategoria = mysqli_real_escape_string($conexion,$_POST['APro_subcategoria']);
		$UnidadMedida = mysqli_real_escape_string($conexion,$_POST['APro_UnidadMedida']);
		$Proveedor = 	mysqli_real_escape_string($conexion,$_POST['APro_Proveedor']);
		$CodProveedor = mysqli_real_escape_string($conexion,$_POST['APro_CodProveedor']);
		$Costo = 		mysqli_real_escape_string($conexion,$_POST['APro_Costo']);
		$Stock = 		mysqli_real_escape_string($conexion,$_POST['APro_Stock']);
		$StockM = 		mysqli_real_escape_string($conexion,$_POST['APro_StockMinimo']);
		$Venta = 		mysqli_real_escape_string($conexion,$_POST['APro_venta']);
		$Mayor = 		mysqli_real_escape_string($conexion,$_POST['APro_Mayor']);
		$Comentario = 	mysqli_real_escape_string($conexion,$_POST['APro_Comentario']);
		$Fecha = 		mysqli_real_escape_string($conexion,$_POST['APro_Fecha']);
		$Estado = 		mysqli_real_escape_string($conexion,$_POST['APro_Estado']);
		
		$query_almacenar = mysqli_query($conexion,"UPDATE producto SET 
																		Pro_BarCode='$BarCode', 
																		Pro_Nombre='$Nombre', 
																		Pro_Marca='$Marca', 
																		Pro_Categoria='$Categoria', 
																		Pro_subcategoria='$SubCategoria', 
																		Pro_UnidadMedida='$UnidadMedida', 
																		Pro_Proveedor='$Proveedor', 
																		Pro_CodProveedor='CodProveedor', 
																		Pro_Costo='$Costo', 
																		Pro_Stock='$Stock', 
																		Pro_StockMinimo='$StockM', 
																		Pro_venta='$Venta', 
																		Pro_Mayor='$Mayor', 
																		Pro_Comentario='$Comentario', 
																		Pro_Fecha='$Fecha', 
																		Pro_Estado='$Estado'
																	
																	WHERE idProducto = $idmodificar");													
	
		
		
		
		$result_nuevo = mysqli_query($conexion,$query_almacenar);
			echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Producto!</strong> Actualizado con exito <a href="index.php"> ir Principal </a></div></div>' ; 
		}

?>


<div class="control-group info">

<form  method="post" action="" name="formulario" id="formulario">
<input type="hidden" name="enviar_guardar" id="enviar_guardar" value="ingreso">



<table border="0" class="table" width="80%">
<tr class="info"> 
	<td colspan="3"><center><strong>MODIFICAR DE PRODUCTO</strong></center> </td>
</tr>
<tr>
	<td width="585">
		<label for="textfield">Codigo de Barras:</label>
		<input type="text" name="APro_BarCode" id="Pro_BarCode" value="<?php echo $BarCode ?>">
			<label for="textfield"></label>
		<?php echo "<img src='../barcode/CodiBar/generador.php?numero=".$BarCode."'>" ?>
	
		<label for="textfield">Nombre:</label>
		<input type="text" name="APro_Nombre" id="Pro_Nombre" value="<?php echo $Nombre ?>">
		
		<label for="textfield">Marca:</label>
		<select name="APro_Marca" class="form-control" id="Pro_Marca">
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT * FROM marca ORDER BY Mar_Nombre";
								$result =  mysqli_query($conexion, $sql);								
								while($aux = mysqli_fetch_array($result)){
									if($Marca==$aux['IdMarca']){
										echo	"<option value=".$aux['IdMarca']." selected='selected'>".$aux['Mar_Nombre']."</option>";									
									}else{
										echo	"<option value=".$aux['IdMarca'].">".$aux['Mar_Nombre']."</option>";
									}
					 					
								}		?> 
		  </select>
		
		<label for="textfield">Categoria:</label>
		<select name="APro_Categoria" class="form-control" id="Pro_Categoria">
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT * FROM categoria ORDER BY Cat_Nombre";
								$result =  mysqli_query($conexion, $sql);								
								while($aux = mysqli_fetch_array($result)){
									if($Categoria==$aux['IdCategoria']){
										echo	"<option value=".$aux['IdCategoria']." selected='selected'>".$aux['Cat_Nombre']."</option>";	
									}else{
										echo	"<option value=".$aux['IdCategoria'].">".$aux['Cat_Nombre']."</option>";	
									}
								}
								?> 
		</select>
		
		<label for="textfield">Sub Categoria:</label>
		<select name="APro_subcategoria" class="form-control" id="Pro_subcategoria">
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT * FROM subcategoria ORDER BY suc_Nombre";
								$result =  mysqli_query($conexion, $sql);								
								while($aux = mysqli_fetch_array($result)){
									if($SubCategoria==$aux['idSubcategoria']){
										echo	"<option value=".$aux['idSubcategoria']." selected='selected'>".$aux['suc_Nombre']."</option>";	
									}else{
										echo	"<option value=".$aux['idSubcategoria'].">".$aux['suc_Nombre']."</option>";	
									}
					 				
								}		?> 
		</select>
		
		<label for="textfield">Unidad de Medida:</label>
		<select name="APro_UnidadMedida" class="form-control" id="Pro_UnidadMedida">
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT * FROM unidadmedida ORDER BY unm_Nombre";
								$result =  mysqli_query($conexion, $sql);								
								while($aux = mysqli_fetch_array($result)){
										if($UnidadMedida==$aux['idunidad']){
											echo	"<option value=".$aux['idunidad']." selected='selected'>".$aux['unm_Nombre']."</option>";	
										}else{
											echo	"<option value=".$aux['idunidad'].">".$aux['unm_Nombre']."</option>";	
										}
					 				
								}		?> 
		</select>
		<label for="textfield">Proveedor:</label>
		<select name="APro_Proveedor" class="form-control" id="Pro_Proveedor">
			<option value="0">[SELECCIONE...] </option>
					<?php
						$sql = "SELECT * FROM proveedor ORDER BY Prov_Nombre";
								$result =  mysqli_query($conexion, $sql);								
								while($aux = mysqli_fetch_array($result)){
									if($Proveedor==$aux['idProveedor']){
										echo	"<option value=".$aux['idProveedor']." selected='selected' >".$aux['Prov_Nombre']."</option>";
									}else{
									echo	"<option value=".$aux['idProveedor'].">".$aux['Prov_Nombre']."</option>";
									}
					 					
								}		?> 
		</select>
		
		<label for="textfield">Codigo Proveedor:</label>
		<input type="text" name="APro_CodProveedor" id="Pro_CodProveedor" value="<?php echo $CodProveedor ?>">
		
			<label for="textfield">Precio Compra con IVA:</label>
			<div class="input-prepend input-append">
				<span class="add-on"><?php echo $sim_Moneda ?></span>
				<input type="number" name="APro_Costo" id="Pro_Costo" onKeyUp="precios()" value="<?php echo $Costo ?>">
			</div>
			
			<label for="textfield">Precio Compra sin IVA:<?php echo $sim_iva."%" ?></label>
			<div class="input-prepend input-append">
				<span class="add-on"><?php echo $sim_Moneda ?></span>
				<input type="hidden" name="APro_iva" id="Pro_iva" value="<?php echo $sim_iva."%" ?>">
				<input type="number" name="APro_sinIva" id="Pro_sinIva"  readonly>
			</div>
		<br>
		<!--<img src="../img/guardar.png" width="20%" height="17%" onClick="validar(formulario,true)" border="1" onMouseOver="style.cursor=cursor">-->
		
		<button type="button" class="btn btn-primary" onClick="validar(formulario,true)"><i class="icon-fullscreen"></i> Editar </li></ul></button>		
		<button type="button" class="btn btn-warning" onClick="window.location='index.php'"><i class="icon-eye-open"></i> Cancelar </li></ul></button>
		</td>
	<td width="406">
			<label for="textfield">Cantidad:</label>
		<input type="number" name="APro_Stock" id="Pro_Stock" value="<?php echo $Stock?>">	
					
		<label for="textfield">Existencia Minima:</label>
		<input type="number" name="APro_StockMinimo" id="Pro_StockMinimo"  value="<?php echo $StockM?>">
		
		<label for="textfield">% Venta Publico:</label>
		<div class="input-prepend input-append">		
		<input type="number" name="AGanancia" id="Ganancia" onKeyUp="precios();" >
		<span class="add-on">%</span>
		</div>
							
		<label for="textfield">Precio Venta Publico:</label>
		<div class="input-prepend input-append">
		<span class="add-on"><?php echo $sim_Moneda ?></span>
		<input type="number" name="APro_venta" id="Pro_venta"  value="<?php echo $Venta?>" readonly>	
		</div>
		
		<label for="textfield">% Venta Mayoreo:</label>
		<div class="input-prepend input-append">		
		<input type="number" name="AGananciaM" id="GananciaM" onKeyUp="precios();">
		<span class="add-on">%</span>
		</div>
		
		<label for="textfield">Precio Venta Mayor:</label>
		<div class="input-prepend input-append">
		<span class="add-on"><?php echo $sim_Moneda ?></span>
			<input type="number" name="APro_Mayor" id="Pro_Mayor"  value="<?php echo $Mayor?>" readonly >	
		</div>
					
		<label for="textfield">Comentario:</label>
		<textarea rows="4"  cols="5" name="APro_Comentario" id="Pro_Comentario"><?php echo $Comentario?></textarea>
		
		<label for="textfield">Fecha:</label>
		<input type="date" name="APro_Fecha" id="Pro_Fecha"  value="<?php echo $Fecha?>">		
			
		<label for="textfield">Estado:</label>
		<select name="APro_Estado" id="Pro_Estado">
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
	<td width="315">
	<ul id="lista-errores"></ul>
	</td>
	
</tr>
</table>
	<input type="hidden" name="id" id="id" value="">
</form >


</div>


</body>


</html>