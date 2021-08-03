<?php

session_start();

$_SESSION['result']= "";

include("conexion.php");

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: /libreria/index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: /libreria/index.php');
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de empleados</title>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/libreria/assets/css/bulma-0.8.0/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="/libreria/assets/css/footer.css">
    <link rel="shortcut icon" type="image/png" href="/libreria/assets/img/short-book.png" />
    
	<!-- Bootstrap -->
	<link href="../css/bootstrap.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 50px;
		}
	</style>
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
		<nav class="navbar" role="navigation" aria-label="main navigation">
        	<?php require '../../header.php'; ?>
    	</nav>
		<div class="container">
		<div class="content">
			<h2>Datos del empleado &raquo; Perfil</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			
			$sql = mysqli_query($con, "SELECT e.id as id, concat(e.nombre,' ',e.apellido) as nombres, td.description as tipo_documento, e.nro_documento as nro_documento FROM empleado e INNER JOIN documento_identidad td ON e.tipo_documento = td.id WHERE e.estado='00' and e.id='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: ../../views/crud_empleados.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($con, "UPDATE empleado e SET e.estado='01' WHERE e.id='$nik'");
				if($delete){
					echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido eliminados correctamente.</div>';
				}else{
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error al tratar de eliminar los datos.</div>';
				}
			}
			?>
			
			<table class="table table-striped table-condensed">
				<tr>
					<th width="20%">Código</th>
					<td><?php echo $row['id']; ?></td>
				</tr>
				<tr>
					<th>Nombre del empleado</th>
					<td><?php echo $row['nombres']; ?></td>
				</tr>
				<tr>
					<th>Tipo de Documento</th>
					<td><?php echo $row['tipo_documento']; ?></td>
				</tr>
				<tr>
					<th>Número de Documento</th>
					<td><?php echo $row['nro_documento']; ?></td>
				</tr>
				
			</table>
			
			<a href="../../views/crud_empleados.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Regresar</a>
			<a href="edit.php?nik=<?php echo $row['id']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos</a>
			<a href="profile.php?aksi=delete&nik=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Esta seguro de borrar los datos <?php echo $row['nombres']; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
		</div>
	</div>

	<?php require '../../footer.php'; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script async type="text/javascript" src="/libreria/assets/js/bulma.js"></script>
    <script type="text/javascript" src="/libreria/assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="/libreria/assets/js/navbar_item.js"></script>
</body>
</html>