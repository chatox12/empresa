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
	<table width="100%" border="0">
		<tr class="info">
			<td> <center><strong> Actualizacion de Categoria Cliente</strong>	</center></td>
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
																$query_buscar = mysqli_query($conexion,"SELECT * FROM categoriacli ORDER BY CatCli_Nombre");
																	while($aux = mysqli_fetch_array($query_buscar)){
																		echo '<option value ="'.$aux['CatCli_Nombre'].'">';											
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
										<td colspan="2"> <center> <strong>LISTADO DE CATEGORIAS</strong></center></td>
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
												$query_buscar = "SELECT * FROM categoriacli ORDER BY CatCli_Nombre";
											}else{
												$buscar = $_POST['buscar'];
												$query_buscar = "SELECT * FROM categoriacli WHERE CatCli_Nombre LIKE '%$buscar%' ORDER BY CatCli_Nombre ";
											}
										
										
											$query = mysqli_query($conexion,$query_buscar);
											$contador = 0;
											while($aux = mysqli_fetch_array($query)){
												$id = $aux['IdCategoriaCli'];
												$nombre = $aux['CatCli_Nombre'];				
										?>
									<tr>
										<td> <?php echo $contador + 1 ;?></td>
										<td><?php echo $nombre ;?></td>
   										<td><a href="categoria_Cliente.php?id=<?php echo $id?>"> <img src="../img/editar.png">Editar </a>	</td>
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
								$query = mysqli_query($conexion,"SELECT * FROM categoriacli WHERE IdCategoriaCli = '$id' ");
									if($aux =  mysqli_fetch_array($query)){
										$id = $aux['IdCategoriaCli'];
										$nombre = $aux['CatCli_Nombre'];
									}
									$btn= "Editar"; 
							}
							?>
							<div>
								<form name="formulario" id="formulario" method="post" action="" class="control-group info">
									<input type="hidden" name="IdCategoriaCli" id="IdCategoriaCli" value="<?php echo $id ?>">
									<label for="textfield">Nombre:</label>
									<input type="text" name="ACatCli_Nombre" id="CatCli_Nombre" value="<?php echo $nombre ?>">
									<br>
										<?php 							
										if($btn=='Editar'){	$evento = "" ; }else{$evento = "disabled='disabled'";}									
										?>
										<button type="button" class="btn btn-info" onClick="validar(formulario,true)" <?php echo $evento ?> ><?php echo $btn; ?></button>
										<button type="button" class="btn btn-info" onClick="window.location='categoria_Cliente.php'"  >Cancelar</button>
									
									<div class="alert alert-danger">
										<ul id="lista-errores"></ul>
									</div>
									
											
								<input type="hidden" name="id" id="id" value="">
									
								</form>							
							</div>
							<?php 
														
								if(!empty($_POST['ACatCli_Nombre'])){	
								$id = $_POST['IdCategoriaCli'];
								$nombre = $_POST['ACatCli_Nombre'];
									 $query_actualizar= "UPDATE categoriacli SET CatCli_Nombre = '$nombre' WHERE IdCategoriaCli = '$id' ";
									 mysqli_query($conexion,$query_actualizar);				 
									
										echo '<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">X</button> 
			  							<strong>Categoria!</strong> Actualizado con Exito <a href="categoria_Cliente.php"> ir Principal </a></div>' ;								
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