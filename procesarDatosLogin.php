<?php 
// $resultadoBDado = $_POST['valorCaja1'] + $_POST['valorCaja2']; 

include("conexion.php");
$conexionBD=conectar();

$sqlLogin = "SELECT * FROM persona WHERE correo='".$_POST['correo']."' AND contrasena='".$_POST['contrasena']."';";

$resultadoBD = $conexionBD->query($sqlLogin);

$existente = false;
while($col = $resultadoBD->fetch_array()) {
    $existente = true;
}

if($existente){
    echo "Ingreso de sesion correcto";
   
}else{
    echo "No estás registrado o la contrasena es incorrecta";
}



?>
