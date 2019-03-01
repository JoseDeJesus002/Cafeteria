<?php
include("conexion.php"); //Conexión a la base de datos
$con = conectar();

$id = 0;

if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id']; //Si se recibio una ID, se le es asignada a $id

}

$sql = "DELETE FROM alumno WHERE idAlumno = $id"; //Se elimina el registro del alumno correspondiente al ID
$result = $con->query($sql) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));
if ($result) {
	echo "<script type='text/javascript'>alert('Alumno eliminado con éxito');</script>";
	echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
}else{
	echo "<script type='text/javascript'>alert('Fallo Eliminación');</script>";
	echo "<script type='text/javascript'>window.location.href = '../Alumnos.php';</script>";
}

?>
