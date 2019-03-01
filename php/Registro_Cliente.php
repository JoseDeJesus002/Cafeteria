<?php

include("conexion.php"); //Se realiza una conexión a la base de datos para ejecutar funcionalidades con PHP
$con = conectar();

if (isset($_POST['registro'])) { //Se revisa que el formulario se haya llenado en su totalidad
	//Se revisa que los valores de los campos no esten vacios
	if (!empty($_POST['user']) && !empty($_POST['psw']) && !empty($_POST['nombre']) && !empty($_POST['apellidoP']) && !empty($_POST['apellidoM']) && !empty($_POST['fecha']) && !empty($_POST['email']) && !empty($_POST['telefono'])) {

		//Se toman los valores del formulario
		$user = $_POST['user'];
		$psw = $_POST['psw'];
		$nombre = $_POST['nombre'];
		$apellidoP = $_POST['apellidoP'];
		$apellidoM = $_POST['apellidoM'];
		$fecha = $_POST['fecha'];
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];

		if (!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚÑñ\s]+$/",$nombre)) { //Validación para asegurar que el nombre solo contenga letras y espacios
			echo "<script type='text/javascript'>alert('El nombre solo puede contener letras');</script>";
		  	echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
		}else{
			if (!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚÑñ\s]*$/",$apellidoP)) { //Validación para asegurar que el apellido paterno solo contenga letras y espacios
				echo "<script type='text/javascript'>alert('El apellido paterno solo puede contener letras');</script>";
			  	echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
			}else{
				if (!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚÑñ\s]*$/",$apellidoM)) { //Validación para asegurar que el apellido materno solo contenga letras y espacios
					echo "<script type='text/javascript'>alert('El apellido materno solo puede contener letras');</script>";
				  	echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
				}else{
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Validación de formato de correo
						echo "<script type='text/javascript'>alert('Formato de correo erroneo');</script>";
					  	echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
					}else{
						if (empty($_POST['genero'])) { //Verificación de que se haya elegido un sexo
							echo "<script type='text/javascript'>alert('Falto el Sexo');</script>";
							echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
						} else{
							if (!preg_match("/^[0-9\s]*$/",$telefono)) {
								echo "<script type='text/javascript'>alert('El número de telefono solo puede contener números');</script>";
					  			echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
							}else{
								$genero = $_POST['genero'];

								$query="SELECT * FROM usuario WHERE nombreUsuario='".$user."'"; //Consulta de si el usuario ingresado ya existe o no
								$result = $con->query($query) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));
								$numrows=$result->num_rows;

								//Verificación de si ya hay un usuario registrado con ese nombre
								if ($numrows==0) {

									$sql = "INSERT INTO usuario (nombreUsuario, password, nombre, apellidoP, apellidoM, email, telefono, sexo, fechaNacimiento) VALUES ('$user', '$psw', '$nombre', '$apellidoP', '$apellidoM', '$email', '$telefono', '$genero', '$fecha')"; //Se realiza el registro de un nuevo usuario

									$result = $con->query($sql);

									//Verificación de si el registro de usuario fue exitoso.
									if ($result) {

										$query="SELECT * from usuario where nombreUsuario='".$user."'"; //Consulta del usuario recien registrado
										$result = $con->query($query);
										$fila=$result->fetch_assoc();
										$dbID=$fila['idUsuario'];

										if (!empty($_POST['cargoE'])) {
											$cargo = $_POST['cargoE'];
											$sql = "INSERT INTO empleado (cargo, Usuario_idUsuario) VALUES ('$cargo','$dbID')"; //Se realiza el registro de un nuevo empleado con la ID del usuario
											$result = $con->query($sql);

											echo "<script type='text/javascript'>alert('Usuario registrado con éxito');</script>";
											echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
										}else{
											$sql = "INSERT INTO cliente (Usuario_idUsuario) VALUES ('$dbID')"; //Se realiza el registro de un nuevo cliente con la ID del usuario

											$result = $con->query($sql);

											echo "<script type='text/javascript'>alert('Usuario registrado con éxito');</script>";
											echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
										}

									}else{
										echo "<script type='text/javascript'>alert('Error al registrar');</script>";
										echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
									}
								} else{
									echo "<script type='text/javascript'>alert('El nombre de usuario ya existe, ingresa otro.');</script>";
									echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
								}
							}
						}
					}
				}
			}
		}

	} else{
		echo "<script type='text/javascript'>alert('Todos los campos deben estar llenados');</script>";
		echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
	}
	$con->close();
}

?>
