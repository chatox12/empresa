<?php 
 session_start();
include("../Conexion/conexion.php");
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
				<button type="button" class="btn btn-primary" onClick="window.location='nuevo_cliente.php'"> Nuevo Cliente</button>	
			</div>
		</td>
		
		<td>
			<div align="right">
				<form method="post"  action="" name="formulario" id="formulario" enctype="multipart/form-data">
				
						 <div class="input-append">
							<input  name="buscar" id="buscar" class="span2"  type="text" size="70" list="characters" autocomplete="off">
								<datalist id="characters">
									<?php
										$buscar = $_POST['buscar'];
										$sql =  "SELECT * FROM Cliente ORDER BY Cli_Nombre";
										$result = mysqli_query($conexion,$sql);
														
										while($aux =  mysqli_fetch_array($result)){
											echo '<option value="'.$aux['Cli_Nombre'].'">';
											
										
										}
									?>
								
								 </datalist>
							<button class="btn" type="submit"> <i class="fa fa-search"> </i> </button>
						</div>
					</form>
			</div>
		</td>
	
	</tr>
	<tr class="info">	<td colspan="3">	<center> <strong>LISTADO DE CLIENTES</strong></center>	</td>	</tr>

</table>

<div align="center">
	<table  width="80%" border="0"class="table table-striped table-bordered  table-hover">
		
		<thead>
		<tr>
			<th width="3%"><strong>No.</strong></th>
			<th width="14%"><strong>Nombre </strong></th>
			<th width="9%"><strong>NIT</strong></th>
			<th width="11%"><strong>Direccion </strong></th>
			<th width="11%"><strong>Correo</strong></th>
			<th width="11%"><strong>Telefono</strong></th>
			<th width="11%"><strong>Categoria</strong></th>
			<th width="10%"><strong>Estado</strong></th>
			<th width="10%"><strong></strong></th>
			
			
		</tr>
		</thead>
		<?php 
			if(empty($_POST['buscar'])){
			$sql =  "SELECT * FROM cliente ORDER BY Cli_Nombre LIMIT $reg_Empezar,$Mostar";
			}else{
			$buscar = $_POST['buscar'];			
			$sql =  "SELECT * FROM cliente WHERE Cli_Nombre LIKE '%$buscar%' ORDER BY Cli_Nombre LIMIT $reg_Empezar,$Mostar ";			
			}
			$result = mysqli_query($conexion,$sql);
			if($final = mysqli_num_rows($result) > 0){
			$aux1 = 0;	
			
			while($aux = mysqli_fetch_array($result)){			
									$id = $aux['Cli_Estado']; 									
									$resultado_esta = mysqli_query($conexion,"SELECT Est_Nombre FROM estado where IdEstado = '$id'");
									if($estado = mysqli_fetch_array($resultado_esta))
									$esta= $estado['Est_Nombre'];				
			if($aux['Cli_Estado']==1){		
      			$estado='<span class="label label-success">'.$esta.'</span>';
			}else{
				$estado='<span class="label label-important">'.$esta.'</span>';
			}
				
		?>
		<tr>
			<td width="3%"><?php echo $aux1 + 1 ?></td>			
			<td width="14%"><?php echo $aux['Cli_Nombre'] ?></td>
			<td width="9%"><?php echo $aux['Cli_NIT'] ?></td>
			<td width="11%"><?php echo $aux['Cli_Direccion'] ?></td>
			<td width="11%"><?php  echo $aux['Cli_Correo']   ?></td>
			<td width="10%"><?php  echo $aux['Cli_Telefono']   ?></td>
			<td width="11%"><?php  $id = $aux['Cli_Categoria']; 									
									$resultado_nom = mysqli_query($conexion,"SELECT *  FROM categoriacli where IdCategoriaCli = '$id'");
									if($tipo = mysqli_fetch_array($resultado_nom))
									$nom=$tipo['CatCli_Nombre'];      								
									   echo $nom;
			
			?></td>
			<td width="10%"><a href="estado_cliente.php?estado=<?php echo $aux['IdCliente'] ?>" ><?php echo $estado; ?></a></td>			
			<td width="10%"><a href="modificar_cliente.php?modificar=<?php echo $aux['IdCliente']?>" > <img src="../img/editar.png" width="15" height="15"> Editar</a></td>		
		
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
		<td colspan="7"><center>
			
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