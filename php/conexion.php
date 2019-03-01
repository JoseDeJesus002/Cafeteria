<?php
  function conectar () { //Función para establecer la conexión con la base de datos
    $usuario = "root";
    $contraseña = "Esteban";
    $servidor = "localhost";
    $base = "cafeteria";
    $conexion = new mysqli($servidor,$usuario,$contraseña,$base);

    if($conexion -> connect_errno){
      die("Fallo la conexión:(".$conexion -> mysqli_connect_errno().")".$conexion -> mysqli_connect_error());
    }

    return $conexion;
  }
?>
