<?php 
 session_start();
include("../Conexion/conexion.php");


?>

<!DOCTYPE html>
<html>
<head>

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
	<table width="80%" border="0">
		<tr class="info">
			<td> <center>
			  <strong> ACTUALIZAR TIPO DE USUARIO </strong>	</center></td>
		</tr>
		<tr>
			<td>
			
				<table width="80%" border="0">
					<tr>
						<td width="50%">
							<div style="width: 90%; height:250px; overflow-y: scroll;">
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
																$query_buscar = mysqli_query($conexion,"SELECT * FROM tipousuario ORDER BY Tip_Nombre");
																	while($aux = mysqli_fetch_array($query_buscar)){
																		echo '<option value ="'.$aux['Tip_Nombre'].'">';											
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
										<td colspan="2"> <center> <strong>LISTADO DE TIPOS DE USUARIO </strong>
										</center></td>
									</tr>
							</table>
							
								<table  width="80%" border="0" class="table table-striped table-bordered  table-hover">	
									<thead>									
									<tr>
										<th width="11%">No. </th>
										<th width="67%">Nombre:</th>
										<th width="22%">Editar:</th>
										
									</tr>
									</thead>
										<?php
											if(empty($_POST['buscar'])){
											$query_buscar = "SELECT * FROM tipousuario ORDER BY Tip_Nombre";
										}else{
											$buscar = $_POST['buscar'];
											$query_buscar = "SELECT * FROM tipousuario WHERE Tip_Nombre LIKE '%$buscar%' ORDER BY Tip_Nombre ";
										}
											
											$query = mysqli_query($conexion,$query_buscar);
											$contador = 0;
											while($aux = mysqli_fetch_array($query)){
												$id = $aux['IdTipoUsuario'];
												$nombre = $aux['Tip_Nombre'];				
										?>
									<tr>
										<td> <?php echo $contador + 1 ;?></td>
										<td><?php echo $nombre ;?></td>
   										<td><a href="tipo_Usuario.php?id=<?php echo $id?>"> <img src="../img/editar.png">Editar </a>	</td>
										<?php  $contador++; } ?>
									</tr>
							  </table>
							  
							</div>
					  </td>
						
						<td width="50%">
							<?php
							
							if(empty($_GET['id'])){
									$nombre="";
								$btn = "Actualizar";
								
							}else{
								$id = $_GET['id'];
								$query = mysqli_query($conexion,"SELECT * FROM tipousuario WHERE IdTipoUsuario = '$id' ");
									if($aux =  mysqli_fetch_array($query)){
										$id = $aux['IdTipoUsuario'];
										$nombre = $aux['Tip_Nombre'];
									}
									$btn= "Editar"; 
							}
							?>
							<div class="control-group info">
								<form name="formulario" id="formulario" method="post" action="">
									<input type="hidden" name="IdTipoUsuario" id="IdTipoUsuario" value="<?php echo $id ?>">
									<label for="textfield">Nombre:</label>
									<input type="text" name="ATip_Nombre" id="Tip_Nombre" value="<?php echo $nombre ?>">
									<br>
									<?php 							
										if($btn=='Editar'){	$evento = "" ; }else{$evento = "disabled='disabled'";}									
										?>
										<button type="button" class="btn btn-info" onClick="validar(formulario,true)" <?php echo $evento ?> ><?php echo $btn; ?></button>
									<button type="button" class="btn btn-info" onClick="window.location='tipo_Usuario.php'">Cancelar</button>
									<div class="alert alert-danger">
										<ul id="lista-errores"></ul>
									</div>
									
											
								<input type="hidden" name="id" id="id" value="">
								</form>							
							</div>
							<?php 
								if(!empty($_POST['ATip_Nombre'])){	
								$id = $_POST['IdTipoUsuario'];
								$nombre = $_POST['ATip_Nombre'];
									
									 $query_almacenar = "UPDATE tipousuario SET Tip_Nombre = '$nombre' WHERE IdTipoUsuario = '$id' ";
									 mysqli_query($conexion,$query_almacenar);						 
									
									  echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			 							 <strong>Tipo!</strong> Actualizado con Exito <a href="tipo_Usuario.php"> ir Principal </a></div>' ;							
								}
							
							
							?>
					  </td>
					</tr>
				</table>
				
			</td>
		</tr>	
	
  </table>
</div>
</body>
</html>