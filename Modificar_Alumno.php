<?php
  session_start(); //Si hay una sesión activa mediante inicio de sesión, la activa
  include("php/conexion.php"); //Se realiza una conexión a la base de datos para ejecutar funcionalidades con PHP
  $con = conectar();
  $id = null;
  if(!empty($_GET['id'])){
    $id = $_REQUEST['id'];//Si se recibio una ID, se le es asignada a $id
  }

  if(null==$id){
    header("Location: Alumnos.php");
  }

  if(!empty($_POST)){ //Se revisa que el formulario se haya llenado en su totalidad
	//Se toman los valores modificados del formulario
    $nombreAlumno = $_POST['nombreAlumno'];
	  $apellidoAlumnoP = $_POST['apellidoAlumnoP'];
	  $apellidoAlumnoM = $_POST['apellidoAlumnoM'];
	  $fechaAlumno = $_POST['fechaAlumno'];
    $generoAlumno = $_POST['generoAlumno'];
    $grado = $_POST['grado'];
    $comboboxGrupo = $_POST['comboboxGrupo'];
    $salon = $_POST['salon'];
    $valid = false;
    //Se revisa que los valores de los campos no esten vacios
    if (!empty($nombreAlumno) && !empty($apellidoAlumnoP) && !empty($apellidoAlumnoM) && !empty($fechaAlumno) && !empty($generoAlumno) && !empty($grado) && !empty($comboboxGrupo) && !empty($salon)) {
        $valid = true;
    }

    // Actualización de Información
    if($valid){
        if (!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚÑñ\s]+$/",$nombreAlumno)) { //Validación para asegurar que el nombre solo contenga letras y espacios
			echo "<script type='text/javascript'>alert('El nombre solo puede contener letras');</script>";
		  	echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
		}else{
			if (!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚÑñ\s]*$/",$apellidoAlumnoP)) { //Validación para asegurar que el apellido paterno solo contenga letras y espacios
				echo "<script type='text/javascript'>alert('El apellido paterno solo puede contener letras');</script>";
			  	echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
			}else{
				if (!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚÑñ\s]*$/",$apellidoAlumnoM)) { //Validación para asegurar que el apellido materno solo contenga letras y espacios
					echo "<script type='text/javascript'>alert('El apellido materno solo puede contener letras');</script>";
				  	echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
				}else{
					if (empty($_POST['generoAlumno'])) { //Verificación de que se haya elegido un sexo
						echo "<script type='text/javascript'>alert('Falto el Sexo');</script>";
						echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
					} else{
						$sql = "UPDATE alumno  set nombre = '$nombreAlumno', apellidoP = '$apellidoAlumnoP', apellidoM = '$apellidoAlumnoM', salon = '$salon', grupo = '$comboboxGrupo', grado = '$grado', sexo = '$generoAlumno', fechaNacimiento = '$fechaAlumno' WHERE idAlumno = $id";
				        $result = $con->query($sql);
				        if ($result) {
				        	echo "<script type='text/javascript'>alert('Alumno modificado con éxito');</script>";
				        	echo "<script type='text/javascript'>window.location.href = 'Alumnos.php';</script>";
				        }else{
				        	echo "<script type='text/javascript'>alert('Fallo actualización');</script>";
				        	echo "<script type='text/javascript'>window.location.href = 'Alumnos.php';</script>";
				        }
					}
				}
			}
		}
    }
  }else{
    $query = "SELECT * FROM alumno where idAlumno = '".$id."'"; //Consulta del alumno al que pertenece el ID
    $result = $con->query($query);
    $numrows=$result->num_rows;
    //Llenado del formulario con la información de la consulta
    if($numrows>0){
    	$fila=$result->fetch_assoc();
	    $nombreAlumno = $fila['nombre'];
	    $apellidoAlumnoP = $fila['apellidoP'];
  		$apellidoAlumnoM = $fila['apellidoM'];
  		$fechaAlumno = $fila['fechaNacimiento'];
  		$generoAlumno = $fila['sexo'];
  		$grado = $fila['grado'];
  		$comboboxGrupo = $fila['grupo'];
  		$salon = $fila['salon'];
    }else{
    	echo "<script type='text/javascript'>alert('Error');</script>";
    	echo "<script type='text/javascript'>window.location.href = 'Alumnos.php';</script>";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="css/Imagenes/Icon.ico">
	<title>Modificar Alumno</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/ModificarAlumno.css">
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
		  	<a class="iniciobtn" id="iniciobtn" href="PHP/Cerrar_Sesion.php">Cerrar Sesión</a>
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
		  		<!--Formulario para la modificación del alumno (es llenado automaticatemente con la información del alumno en la base de datos)-->
			  	<div class="columna form">
			  		<form style="border:0;" action="Modificar_Alumno.php?id=<?php echo $id?>" method="POST">
				  		<h2>Modificar Alumno</h2>
				  		<label><b>Nombre(s)</b></label>
				      	<input type="text" placeholder="Nombre" name="nombreAlumno" id="nombreAlumno" value="<?php echo !empty($nombreAlumno)?$nombreAlumno:'';?>" required>

				      	<label><b>Apellido Paterno</b></label>
				      	<input type="text" placeholder="Apellido Paterno" name="apellidoAlumnoP" id="apellidoAlumnoP" value="<?php echo !empty($apellidoAlumnoP)?$apellidoAlumnoP:'';?>" required>

				      	<label><b>Apellido Materno</b></label>
				      	<input type="text" placeholder="Apellido Materno" name="apellidoAlumnoM" id="apellidoAlumnoM" value="<?php echo !empty($apellidoAlumnoM)?$apellidoAlumnoM:'';?>" required>

				      	<label><b>Fecha de Nacimiento</b></label>
				      	<input type="date" name="fechaAlumno" id="fechaAlumno" value="<?php echo !empty($fechaAlumno)?$fechaAlumno:'';?>" required>

				      	<label><b>Sexo</b></label><br>
				      	<?php if ($generoAlumno == "M") {?>
				      	<input type="radio" name="generoAlumno" value="M" checked="true" required> Masculino
				      	<input type="radio" name="generoAlumno" value="F" required> Femenino <br>
				      	<?php }else{ ?>
				      	<input type="radio" name="generoAlumno" value="M" required> Masculino
				      	<input type="radio" name="generoAlumno" value="F" checked="true" required> Femenino <br>
				      	<?php } ?>
				      	<label><b>Grado</b></label>
				      	<input type="number" name="grado" id="grado" min="1" max="6" placeholder="1" value="<?php echo !empty($grado)?$grado:'';?>" required>
				      	<label><b>Grupo</b></label><br>
				      	<select id="comboboxGrupo" name="comboboxGrupo">
				      		<?php if ($comboboxGrupo == "A") {?>
				      		<option value="A" selected="true">A</option>
				      		<option value="B">B</option>
				      		<option value="C">C</option>
				      		<option value="D">D</option>
				      		<option value="E">E</option>
				      		<option value="F">F</option>
				      		<?php } ?>
				      		<?php if ($comboboxGrupo == "B") {?>
				      		<option value="A">A</option>
				      		<option value="B" selected="true">B</option>
				      		<option value="C">C</option>
				      		<option value="D">D</option>
				      		<option value="E">E</option>
				      		<option value="F">F</option>
				      		<?php } ?>
				      		<?php if ($comboboxGrupo == "C") {?>
				      		<option value="A">A</option>
				      		<option value="B">B</option>
				      		<option value="C" selected="true">C</option>
				      		<option value="D">D</option>
				      		<option value="E">E</option>
				      		<option value="F">F</option>
				      		<?php } ?>
				      		<?php if ($comboboxGrupo == "D") {?>
				      		<option value="A">A</option>
				      		<option value="B">B</option>
				      		<option value="C">C</option>
				      		<option value="D" selected="true">D</option>
				      		<option value="E">E</option>
				      		<option value="F">F</option>
				      		<?php } ?>
				      		<?php if ($comboboxGrupo == "E") {?>
				      		<option value="A">A</option>
				      		<option value="B">B</option>
				      		<option value="C">C</option>
				      		<option value="D">D</option>
				      		<option value="E" selected="true">E</option>
				      		<option value="F">F</option>
				      		<?php } ?>
				      		<?php if ($comboboxGrupo == "F") {?>
				      		<option value="A">A</option>
				      		<option value="B">B</option>
				      		<option value="C">C</option>
				      		<option value="D">D</option>
				      		<option value="E">E</option>
				      		<option value="F" selected="true">F</option>
				      		<?php } ?>
				      	</select>
				      	<label><b>Salón</b></label>
				      	<input type="text" placeholder="B201" name="salon" id="salon" value="<?php echo !empty($salon)?$salon:'';?>" required>
				      	<input type="submit" name="Agregar" id="Agregar" style="float: right;">
				      	<a class="back" href="Alumnos.php" style="float: right;">Cancelar</a>
			      	</form>
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
