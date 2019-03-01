<?php
  class Contacto {
    public $conexion;

    public function Contacto(){ //Establece la conexion cuando se hace la llamada a la clase
      include("conexion.php");
      $this->conexion = conectar();
    }

    public function recuperarDatos(){ //Función para mostrar todos los usuarios que son empleados
      $query = "SELECT nombre, telefono, cargo FROM Usuario, Empleado WHERE idUsuario = Usuario_idUsuario";
      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){
        echo "
          <div>
            <label>Nombre: ".$fila['nombre']."</label>
            <label>Telefono: ".$fila['telefono']." </label>
            <label>Cargo: ".$fila['cargo']."</label>
          </div>
        ";
      }
    }
  }
?>
