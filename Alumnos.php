<?php
	session_start();//Si hay una sesión activa mediante inicio de sesión, la activa
	include("php/conexion.php");//Se realiza una conexión a la base de datos para ejecutar funcionalidades con PHP
	$con = conectar();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="css/Imagenes/Icon.ico">
	<title>Registro de Alumnos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/Alumnos.css">
	<script type="text/javascript" src="js/Alumnos.js"></script>
</head>
<body onload="start();">
	<!--Barra de Navegación (Se generan las cabeceras, y los botones de la barra)-->
	<nav>
		<div id="Nosotros" class="cabcontenido">
		  <h3>Nosotros</h3>
		</div>

		<div id="Menu" class="cabcontenido">
		  <h3>Menú</h3>
		</div>

		<div id="Contacto" class="cabcontenido">
		  <h3>Contacto</h3>
		</div>

		<div id="Alumnos" class="cabcontenido">
		  <h3>Registro de Alumnos</h3>
		</div>

		<div id="PedidosC" class="cabcontenido">
			<h3>Pedidos</h3>
		</div>

		<div class="topnav" id="responsiveNav">
			<!--Botones principales de la barra-->
		  	<a href="index.php" class="Nosotros" onclick="abrirCabecera('Nosotros')">Nosotros</a>
		  	<a href="MenuCliente.php" class="Menu" onclick="abrirCabecera('Menu')">Menú</a>
		  	<a href="ContactoCliente.php" class="Contacto" onclick="abrirCabecera('Contacto')">Contacto</a>
		  	<!--Botones condicionales (se habilitan/deshabilitan dependiendo de si hay una sesión activada o no)-->
		  	<?php if(isset($_SESSION['session_username'])): ?>
		  	<a href="#" class="Alumnos" onclick="abrirCabecera('Alumnos')" id="defaultOpen">Registro de Alumnos</a>
		  	<a href="Pedidos_Cliente.php" class="PedidosC" onclick="abrirCabecera('PedidosC')">Pedidos</a>
		  	<?php endif; ?>
		  	<?php if(!isset($_SESSION['session_username'])): ?>
		  	<a class="iniciobtn" id="iniciobtn" onclick="document.getElementById('id01').style.display='block'">Inicio de Sesión</a>
		  	<?php endif; ?>
		  	<?php if(isset($_SESSION['session_username'])): ?>
		  	<a class="iniciobtn" id="iniciobtn" href="php/Cerrar_Sesion.php">Cerrar Sesión</a>
		  	<?php endif; ?>
		  	<?php if(!isset($_SESSION['session_username'])): ?>
		  	<a class="registrobtn" id="registrobtn" onclick="document.getElementById('id02').style.display='block'">Registro</a>
		  	<?php endif; ?>
		  	<a href="javascript:void(0);" class="icon" onclick="responsiveNav()">&#9776;</a>
		</div>
	</nav>

	<section class="bg">
		<div class="content">
		  	<div class="fila">
		  		<!--Formulario de Registro de Alumnos-->
			  	<div class="columna form">
			  		<form style="border:0;" action="php/Registro_Alumno.php" method="POST">
				  		<h2>Registro de Alumno</h2>
				  		<label><b>Nombre(s)</b></label>
				      	<input type="text" placeholder="Juan" name="nombreAlumno" id="nombreAlumno" required>

				      	<label><b>Apellido Paterno</b></label>
				      	<input type="text" placeholder="Castañeda" name="apellidoAlumnoP" id="apellidoAlumnoP" required>

				      	<label><b>Apellido Materno</b></label>
				      	<input type="text" placeholder="Figueroa" name="apellidoAlumnoM" id="apellidoAlumnoM" required>

				      	<label><b>Fecha de Nacimiento</b></label>
				      	<input type="date" name="fechaAlumno" id="fechaAlumno" required>

				      	<label><b>Sexo</b></label><br>
				      	<input type="radio" name="generoAlumno" value="M" required> Masculino <input type="radio" name="generoAlumno" value="F" required> Femenino <br>
				      	<label><b>Grado</b></label>
				      	<input type="number" name="grado" id="grado" min="1" max="6" placeholder="1" required>
				      	<label><b>Grupo</b></label><br>
				      	<select id="comboboxGrupo" name="comboboxGrupo">
				      		<option value="A">A</option>
				      		<option value="B">B</option>
				      		<option value="C">C</option>
				      		<option value="D">D</option>
				      		<option value="E">E</option>
				      		<option value="F">F</option>
				      	</select>
				      	<label><b>Salón</b></label>
				      	<input type="text" placeholder="B201" name="salon" id="salon" required>
				      	<input type="submit" name="Agregar" id="Agregar" style="float: right; width: 100%; border-radius: 5px;">
			      	</form>
			  	</div>
			  	<!--Generación de la Tabla de Alumnos Registrados del Cliente Activo-->
			  	<div class="columna table">
			  		<h2 style="text-align: center;">Alumnos Registrados</h2>
			  		<div class="tableDiv" style="overflow-x:auto;">
			  			<table>
			  				<thead>
				  				<tr>
				  					<th>Nombre</th>
				  					<th>Apellido Paterno</th>
				  					<th>Apellido Materno</th>
				  					<th>Fecha de Nacimiento</th>
				  					<th>Sexo</th>
				  					<th>Grado</th>
				  					<th>Grupo</th>
				  					<th>Salón</th>
				  					<th>Acción</th>
				  				</tr>
			  				</thead>
			  				<tbody>
			  					<?php
			  						$usuario = $_SESSION['session_username'];
										$query="SELECT idCliente FROM cliente, usuario WHERE nombreUsuario='".$usuario."' and idUsuario=Usuario_idUsuario";//Busqueda del cliente al que le pertenece el usuario
										$resultado = $con->query($query);
										$fila=$resultado->fetch_assoc();
										$idCliente=$fila['idCliente'];
			  						$query = "SELECT * FROM alumno WHERE AlumnoCliente_idCliente ='".$idCliente."'";//Consulta de los alumnos que esten registrados bajo el ID del cliente
										$resultado = $con->query($query);
										$numrows=$resultado->num_rows;
			  					if ($numrows==0) {echo "<script type='text/javascript'>alert('No hay alumnos');</script>";}
			  					//Llenado de la tabla con la información consultada
			  					while($fila=$resultado->fetch_assoc()){
			  					?>
			  					<tr>
				  					<td><?php echo $fila['nombre']; ?></td>
				  					<td><?php echo $fila['apellidoP']; ?></td>
				  					<td><?php echo $fila['apellidoM']; ?></td>
				  					<td><?php echo $fila['fechaNacimiento']; ?></td>
				  					<td><?php echo $fila['sexo']; ?></td>
				  					<td><?php echo $fila['grado']; ?></td>
				  					<td><?php echo $fila['grupo']; ?></td>
				  					<td><?php echo $fila['salon']; ?></td>
				  					<td width="250"><?php echo '<a class="modificar" href="Modificar_Alumno.php?id='.$fila['idAlumno'].'"><button style="cursor: pointer;" type="button" class="btnAccion"><img src="./css/Imagenes/btnAgregar.png"></button></a>'; echo '  '; echo '<a class="eliminar" href="#" onclick="eliminarAlumno('.$fila['idAlumno'].')"><button style="cursor: pointer;" type="button" class="btnAccion"><img src="./css/Imagenes/btnEliminar.png"></button></a>'; ?></td>
				  				</tr>
				  				<?php } ?>
			  				</tbody>
			  			</table>
			  		</div>
			  	</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="footer">
		  	<p>Todos los derechos reservados</p>
		</div>
	</footer>
</body>
</html>
