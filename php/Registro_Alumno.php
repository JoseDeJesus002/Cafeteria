<?php

session_start(); //Si hay una sesión activa mediante inicio de sesión, la activa
include("conexion.php");//Se realiza una conexión a la base de datos para ejecutar funcionalidades con PHP
$con = conectar();

if (isset($_POST['Agregar'])) { //Se revisa que el formulario se haya llenado en su totalidad
	//Se revisa que los valores de los campos no esten vacios
	if (!empty($_POST['nombreAlumno']) && !empty($_POST['apellidoAlumnoP']) && !empty($_POST['apellidoAlumnoM']) && !empty($_POST['fechaAlumno']) && !empty($_POST['generoAlumno']) && !empty($_POST['grado']) && !empty($_POST['comboboxGrupo']) && !empty($_POST['salon'])) {

		//Se toman los valores del formulario
		$nombreAlumno = $_POST['nombreAlumno'];
		$apellidoAlumnoP = $_POST['apellidoAlumnoP'];
		$apellidoAlumnoM = $_POST['apellidoAlumnoM'];
		$fechaAlumno = $_POST['fechaAlumno'];
		$generoAlumno = $_POST['generoAlumno'];
		$grado = $_POST['grado'];
		$comboboxGrupo = $_POST['comboboxGrupo'];
		$salon = $_POST['salon'];

		$usuario = $_SESSION['session_username'];

		$query="SELECT idCliente FROM cliente, usuario WHERE
		nombreUsuario='".$usuario."' and idUsuario=Usuario_idUsuario"; //Busqueda del ID del cliente relacionada al ID del usuario empleada para iniciar sesión
		$result = $con->query($query);
		$numrows=$result->num_rows;

		//Verificación de si el cliente fue encontrado
		if ($numrows>0) {

			$fila=$result->fetch_assoc();
			$idCliente=$fila['idCliente'];

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
							$sql = "INSERT INTO alumno (nombre, apellidoP, apellidoM, salon, grupo, grado, sexo, fechaNacimiento, AlumnoCliente_idCliente) VALUES ('$nombreAlumno', '$apellidoAlumnoP', '$apellidoAlumnoM', '$salon', '$comboboxGrupo', '$grado', '$generoAlumno', '$fechaAlumno','$idCliente')"; //Se realiza el registro del nuevo alumno

							$result = $con->query($sql) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));

							//Verificación de si el alumno fue registrado exitosamente
							if ($result) {

								echo "<script type='text/javascript'>alert('Alumno registrado con éxito');</script>";
								echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";

							}else{
								echo "<script type='text/javascript'>alert('Error al registrar');</script>";
								echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
							}
						}
					}
				}
			}
		} else{
			echo "<script type='text/javascript'>alert('El cliente no fue encontrado.');</script>";
			echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
		}

	} else{
		echo "<script type='text/javascript'>alert('Todos los campos deben estar llenados');</script>";
		echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
	}
	mysqli_close($conn);
}

?>
