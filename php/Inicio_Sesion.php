<?php
session_start();//Si hay una sesión activa mediante inicio de sesión, la activa
include("conexion.php"); //Se realiza una conexión a la base de datos para ejecutar funcionalidades con PHP
$con = conectar();

if (isset($_POST['login'])) { //Se revisa que el formulario se haya llenado en su totalidad
	if(!empty($_POST['uname']) && !empty($_POST['upsw'])){
		$usuario=$_POST['uname'];
		$pass=$_POST['upsw'];

		$query="SELECT * from usuario, cliente where nombreUsuario='".$usuario."' and password='".$pass."' and idUsuario = Usuario_idUsuario"; //Consulta del usuario usando el usuario y contraseña ingresados
		$resultado = $con->query($query);
		$numrows=$resultado->num_rows;

		if($numrows>0){
			while($fila=$resultado->fetch_assoc()){
				$dbusuario=$fila['nombreUsuario'];
	 			$dbpass=$fila['password'];
			}
			if ($usuario == $dbusuario && $pass == $dbpass) {
				$_SESSION['session_username']=$usuario;//Si el usuario fue encontrado se realiza el inicio de sesión
				echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
			}
		}else{
			$query="SELECT * from usuario, empleado where nombreUsuario='".$usuario."' and password='".$pass."' and idUsuario = Usuario_idUsuario"; //Consulta del usuario usando el usuario y contraseña ingresados
			$resultado = $con->query($query);
			$numrows=$resultado->num_rows;

			if($numrows>0){
				while($fila=$resultado->fetch_assoc()){
					$dbusuario=$fila['nombreUsuario'];
		 			$dbpass=$fila['password'];
				}
				if ($usuario == $dbusuario && $pass == $dbpass) {
					$_SESSION['session_username']=$usuario;//Si el usuario fue encontrado se realiza el inicio de sesión
					echo "<script type='text/javascript'>window.location.href = '../Principal.php';</script>";
				}
			}else{
				echo "<script type='text/javascript'>alert('Usuario o contraseña invalido');</script>";
				echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
			}
		}
	}else{
		echo "<script type='text/javascript'>alert('Llena todos los campos');</script>";
		echo "<script type='text/javascript'>window.location.href = '../index.php';</script>";
	}

}

?>
