<?php 
 session_start();
include("../Conexion/conexion.php");
$sim_Moneda = '';
$query_empresa = "SELECT * from empresaumg";
		$empresa = mysqli_query($conexion,$query_empresa);
		if($aux = mysqli_fetch_array($empresa)){
			
			$sim_Moneda = $aux['Emp_Moneda'];
			
		}



$Mostar = 10;
if(isset($_GET['pag'])){
$reg_Empezar = ($_GET['pag'] - 1) * $Mostar;
$PagAct = $_GET['pag'];

}else{
$reg_Empezar =  0;
$PagAct = 1;
}
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
<table width="100%" border="0" class="table table-hover" >
	<tr>
		<td>
			<div class="btn-group" data-toggle="buttons-checkbox">
				<button type="button" class="btn btn-primary" onClick="window.location='nuevo_producto.php'"><i class="icon-plus-sign"> </i> Nuevo Producto</button>	
			</div>
		</td>
		
		<td>
			<div align="right">
				<form method="post"  action="" name="formulario" id="formulario" enctype="multipart/form-data">
				
						 <div class="input-append">
							<input  name="buscar" id="buscar" class="span2"  type="text" size="70" list="characters" autocomplete="off" >
							
								<datalist id="characters">
									<?php
										$buscar = $_POST['buscar'];
										$sql =  "SELECT * FROM producto ORDER BY Pro_Nombre";
										$result = mysqli_query($conexion,$sql);														
										while($aux =  mysqli_fetch_array($result)){
											echo '<option value="'.$aux['Pro_Nombre'].'">';
																			
										}
									?>
								
								 </datalist>
							<button class="btn" type="submit"> <i class="fa fa-search"> </i> </button>
						</div>
					</form>
			</div>
		</td>
	
	</tr>
	<tr class="info">	<td colspan="3">	<center> <strong>LISTADO DE PRODUCTO</strong></center>	</td>	</tr>

</table>

<div align="center">
	<table  width="80%" border="0"class="table table-striped table-bordered  table-hover">
		
		<thead>
		<tr>
			<th width="3%" align="center"><div align="center"><strong>No.</strong></div></th>
			<th width="12%"><div align="center"><strong>Codigo de Barras</strong></div></th>
			<th width="24%"><div align="center"><strong>Nombre</strong></div></th>
			<th width="12%"><div align="center"><strong>Marca</strong></div></th>
			<th width="10%"><div align="center"><strong>Pre. Publico</strong></div></th>
			<th width="13%"><div align="center"><strong>Pre. Distribuidor</strong></div></th>			
			<th width="10%"><div align="center"><strong>Existencia</strong></div></th>
			<th width="8%"><div align="center"><strong>Estado</strong></div></th>
			<th width="8%"><div align="center"><strong></strong></div></th>
		</tr>
		</thead>
		<?php 
			if(empty($_POST['buscar'])){
			$sql =  "SELECT * FROM producto ORDER BY Pro_Stock ASC LIMIT $reg_Empezar,$Mostar";
			}else{
			$buscar = $_POST['buscar'];			
			$sql =  "SELECT * FROM producto WHERE Pro_Nombre LIKE '%$buscar%' ORDER BY Pro_Nombre, Pro_Stock  LIMIT $reg_Empezar,$Mostar ";			
			}
			$result = mysqli_query($conexion,$sql);
			
			if($final = mysqli_num_rows($result) > 0){
			$aux1 = 0;	
			
			while($aux = mysqli_fetch_array($result)){			
									$id = $aux['Pro_Estado'];
									$Existencia = $aux['Pro_Stock'];
									$minima =  	$aux['Pro_StockMinimo'];	
									if($Existencia <= $minima){
									$cantidad='<span class="badge badge-important">'.$Existencia.'</span>';
									}else{
									$cantidad='<span class="badge badge-success">'.$Existencia.'</span>';
									
									}						
									$resultado_esta = mysqli_query($conexion,"SELECT Est_Nombre FROM estado where IdEstado = '$id'");
									if($estado = mysqli_fetch_array($resultado_esta))
									$esta= $estado['Est_Nombre'];				
			if($aux['Pro_Estado']==1){		
      			$estado='<span class="label label-success">'.$esta.'</span>';
			}else{
				$estado='<span class="label label-important">'.$esta.'</span>';
			}
				
		?>
		<tr>
			<td width="3%"><div align="center"><?php echo $aux1 + 1 ?></div></td>
			
			<td width="12%"><?php echo $aux['Pro_BarCode']?></td>
			<td width="24%"><?php echo $aux['Pro_Nombre'] ?></td>
			
			<td width="12%"><div align="center">
			  <?php 
									 $id = $aux['Pro_Marca']; 									
									$resultado_nom = mysqli_query($conexion,"SELECT * FROM marca where IdMarca = '$id'");
									if($tipo = mysqli_fetch_array($resultado_nom))
									$nom=$tipo['Mar_Nombre'];      								
									   echo $nom;									
									?>
		    </div></td>
			<td width="10%"><div align="right"><?php echo $sim_Moneda.". ".number_format($aux['Pro_venta'],2,".",",") ?></div></td>
			<td width="13%"><div align="right"><?php echo $sim_Moneda.". ".number_format($aux['Pro_Mayor'],2,".",",") ?></div></td>
			<td width="10%"><div align="center"><?php echo $cantidad ?></div></td>
			<td width="8%"><div align="center"><a href="estado_producto.php?estado=<?php echo $aux['idProducto'] ?>" ><?php echo $estado; ?></a></div></td>
			
			<td width="8%"><div align="center"><a href="modificar_producto.php?modificar=<?php echo $aux['idProducto']?>" > <img src="../img/editar.png" width="15" height="15"> Editar</a></div></td>
		</tr>
			<?php
			$aux1++;
				}  }else{
				 echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">X</button>
		       <strong>No hay datos! </strong></div>';
				}
			
			?>
		</table>
		<table  width="80%" border="0"class="table">
		<tr>
		<td colspan="7"></center>
			
		<?php
			
				$totalDatos = mysqli_num_rows( mysqli_query($conexion,"SELECT * FROM usuario") );
					$PagAnt = $PagAct - 1;
					$PagSig = $PagAct + 1;
					$PagUlt = $totalDatos / $Mostar; 					
					$Res = $totalDatos / $Mostar; 					
					if($Res > 0) $PagUlt  = floor( $PagUlt ) + 1;
					 echo " <ul class='pager'>  
					 		<li>	<a onclick=\"Pagina('1')\">Primero </a>  </li> ";
					 if($PagAct>1) 
					 		echo " <li> <a onclick=\"Pagina('$PagAnt')\"> Anterior </a> </li>";
					 echo "<strong>Pagina ".$PagAct." - ".$PagUlt."</strong>";
					 if($PagAct<$PagUlt)  
					 		echo " <li> <a onclick=\"Pagina('$PagSig')\"> Siguiente </a> </li>";
					 echo "<li> <a onclick=\"Pagina('$PagUlt')\"> Ultimo</a> </li>  </ul> ";									
				
		?>
		
	</td>
	
	</tr>
		</table>

</div>

</body>

</html>