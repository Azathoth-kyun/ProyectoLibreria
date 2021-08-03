<?php
include("conexion.php");
?>
	<link href="../dataset/css/bootstrap.css" rel="stylesheet">
	<div class="container">
		<div class="content">
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM usuario WHERE estado='00' and id='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "UPDATE usuario u SET u.estado='01' WHERE u.id='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>
			<!-- <form class="form-inline" method="get">
				<div class="form-group" style="margin-bottom: 10px;">
					<input id="scriptBox" name="filter" placeholder="Filtros de datos de empleados" class="input form-control" style="width: 350px;" type="text" onkeypress="return runScript(event)">
					<(?)php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
				</div>
			<form> -->
			<!-- <form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filtros de datos de empleados</option>
						<(?)php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <(?)php if($filter == 'Tetap'){ echo 'selected'; } ?>>Fijo</option>
						<option value="2" <(?)php if($filter == 'Kontrak'){ echo 'selected'; } ?>>Contratado</option>
                        <option value="3" <(?)php if($filter == 'Outsourcing'){ echo 'selected'; } ?>>Outsourcing</option>
					</select>
				</div>
			</form> -->
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>Nombre de Usuario</th>
					<th>Empleado</th>
					<th>Rol</th>
                    <th>Acciones</th>
				</tr>
				<?php
				$sql = mysqli_query($con, "SELECT e.id as id, concat(e.nombre,' ',e.apellido) as nombres, td.description as tipo_documento, e.nro_documento as nro_documento FROM empleado e INNER JOIN documento_identidad td ON e.tipo_documento = td.id WHERE e.estado='00' ORDER BY id ASC");
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['id'].'</td>
							<td><a><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nombres'].'</a></td>
                            <td>'.$row['tipo_documento'].'</td>
							<td>
								<a href="../dataset/usuarios/edit.php?nik='.$row['id'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="crud_usuarios.php?aksi=delete&nik='.$row['id'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nombres'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../dataset/js/bootstrap.min.js"></script>
	<!-- <script>
		function runScript(e) {
    	if (e.keyCode == 13) {
        	var tb = document.getElementById("scriptBox");
        	eval(tb.value);
        	return false;
    		}
		}
	</script> -->