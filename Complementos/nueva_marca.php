<?php 
	 session_start();
include("../Conexion/conexion.php");

?>

<!DOCTYPE html>
<html>
<head> <title> Marca </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../css/docs.css" rel="stylesheet">
    <link href="../js/google-code-prettify/prettify.css" rel="stylesheet">
	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
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
<div align="center">
<table border="0" width="100%">
	<tr>
		<td width="50%">
						<div style="width:80%; height:350px; overflow-y:scroll;">
							<table width="100%" border="0" class="table table-hover">
									<tr>
										<td width="65%"> </td>
										<td width="35%">
											<div align="right">
												<form method="post" action="" name="form1" id="form1" enctype="multipart/form-data">
													<div class="input-append">
														<input name="buscar" id="buscar" class="span2" type="text" size="10" list="listado" autocomplete = "off">
														<datalist id="listado">
															<?php	
																$query_buscar = mysqli_query($conexion,"SELECT * FROM marca ORDER BY Mar_Nombre");
																	while($aux = mysqli_fetch_array($query_buscar)){
																		echo '<option value ="'.$aux['Mar_Nombre'].'">';											
																	}
															?>
														</datalist>
														<button class="btn" type="submit"> <i class="fa fa-search"> </i> </button>
													</div>
												</form>
											</div>
									  </td>
									</tr>
									<tr class="info">
										<td colspan="2"> <center> <strong>LISTADO DE MARCAS</strong></center></td>
									</tr>
							</table>
							<table width="100%" border="0" class="table table-striped table-bordered  table-hover">	
									<thead>
									<tr>
										<th width="14%"><strong> No. </strong></th>
										<th width="68%"><strong> Nombre </strong> </th>
										<th width="18%"> </th>
									</tr>
									</thead>
									<?php
										if(empty($_POST['buscar'])){
											$query_buscar = "SELECT * FROM marca ORDER BY Mar_Nombre";
										}else{
											$buscar = $_POST['buscar'];
											$query_buscar = "SELECT * FROM marca WHERE Mar_Nombre LIKE '%$buscar%' ORDER BY Mar_Nombre ";
										}
											
											$query = mysqli_query($conexion,$query_buscar);
											$contador = 0;
											while($aux = mysqli_fetch_array($query)){
												$id =  $aux['IdMarca'];
												$nombre = $aux['Mar_Nombre'];
										?>
									<tr>
										<td><?php echo $contador + 1; ?></td>
										<td><?php echo $nombre; ?></td>
									    <td><a href="nueva_marca.php?id_modificar=<?php echo $id;?>">  <img src="../img/editar.png" width="15" height="15"> Editar</a></td>						
										<?php $contador++; }?>	
									</tr>
							</table>
						</div>
	  	</td>
			<?php
			if(empty($_GET['id_modificar'])){
				$id='';
				$nombre = "";
				$btn = "Guardar";			
			}else{
				$idMarca =  $_GET['id_modificar'];
				$query_buscar = mysqli_query($conexion,"SELECT * FROM marca WHERE IdMarca = '$idMarca'");
					if($aux = mysqli_fetch_array($query_buscar)){
						$id = $aux['IdMarca'];
						$nombre = $aux['Mar_Nombre'];
					}
				$btn = "Actualizar";	
			}			
			?>
		<td width="50%">
			<div>
				<form  name="formulario" id="formulario" method="post" action="" class="control-group info">
					<input type="hidden" name="mar_id" id="mar_id" value="<?php echo $id ?>">				
															
					<label for="textfield">Nombre:</label>		
					<input type="text" name="AMar_Nombre" id="Mar_Nombre" autocomplete = "off"  value="<?php echo $nombre ?>" autofocus>
					
					<br>
					<button type="button" class="btn btn-info"  onClick="validar(formulario,true)"><?php echo $btn ?></button>
					<button type="button" class="btn btn-info" onClick="window.location='nueva_marca.php'">Cancelar</button>
					<br>
					<div class="alert alert-danger">
						<ul id="lista-errores"></ul>
						
					</div>		
					<input type="hidden" name="id" id="id" value="">
				</form>
			</div>
			<?php 
				if(!empty($_POST['AMar_Nombre'])){
					$id = $_POST['mar_id'];
					$nombre = $_POST['AMar_Nombre'];
						$query_busqueda = mysqli_query($conexion,"SELECT * FROM marca WHERE IdMarca = '$id'");
					if($aux = mysqli_fetch_array($query_busqueda)){
						$query_actualizar = "UPDATE marca SET Mar_Nombre = '$nombre' WHERE IdMarca = '$id'";
						mysqli_query($conexion,$query_actualizar);						
						 echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Usuario!</strong> Actualizado con Exito <a href="nueva_marca.php"> ir Principal </a></div>' ;
								
					}else{
						$query_nombre = mysqli_query($conexion,"SELECT * FROM marca WHERE Mar_Nombre = '$nombre'");
						if(mysqli_num_rows($query_nombre) > 0){
						 echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">X</button>
		       <strong>Advertencia! </strong> Ya Existe esta Marca </div>';
						}else{
						$query_Almacenar = "INSERT INTO marca(Mar_Nombre) VALUES ('$nombre')";
						mysqli_query($conexion,$query_Almacenar);
						 echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  <strong>Usuario!</strong> Guardado con Exito <a href="nueva_marca.php"> ir Principal </a></div>' ; 
						}
					}
				
				}
			
			?>
		
		</td>
	</tr>
</table>
</div>

</body>
</html>