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
	<title>Añadir Empleado</title>
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
			<h2>Datos del empleados &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$apellido	 = mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));//Escanpando caracteres 
				$tipo_documento	 = mysqli_real_escape_string($con,(strip_tags($_POST["tipo_documento"],ENT_QUOTES)));//Escanpando caracteres 
				$nro_documento	     = mysqli_real_escape_string($con,(strip_tags($_POST["nro_documento"],ENT_QUOTES)));//Escanpando caracteres 
				
				$cek = mysqli_query($con, "SELECT e.id as id, e.nombre as nombre, e.apellido as apellido , td.description as tipo_documento, e.tipo_documento as chate_documento, e.nro_documento as nro_documento FROM empleado e INNER JOIN documento_identidad td ON e.tipo_documento = td.id WHERE e.estado='00' and e.id='$ultimo_id'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO empleado(nombre, apellido, tipo_documento, nro_documento)
															VALUES('$nombre','$apellido', '$tipo_documento', '$nro_documento')") or die(mysqli_error());
						if($insert){
							$ultimo_id = $insert->insert_id;
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código existe!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos</label>
					<div class="col-sm-4">
						<input type="text" name="apellido" class="form-control" placeholder="Apellidos" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tipo de Documento</label>
					<div class="col-sm-4">
						<select name="tipo_documento" class="form-control" required>
							<option value="" selected>Elija...</option>
							<option value="1">DNI</option>
							<option value="2">CARNET EXT.</option>
							<option value="3">PASAPORTE</option>
							<option value="4">P. NAC.</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Número de Documento</label>
					<div class="col-sm-4">
					<input type="text" name="nro_documento" class="form-control" placeholder="Número de Documento" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="../../views/crud_empleados.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
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
