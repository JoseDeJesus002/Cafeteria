<?php
  class Cliente {
    public $conexion;

    public function Cliente() {
      include("conexion.php"); //Incluye la conexión
      $this->conexion = conectar();
    }

    public function mostrarClientes() { //Función para mostrar todos los clientes
      $query = "SELECT * FROM usuario, Cliente WHERE idUsuario = Usuario_idUsuario ORDER BY idCliente DESC";
      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){ //Se repite el ciclo hasta que no haiga datos
        echo "
          <tr>
            <td>".$fila['nombreUsuario']."</td>
            <td>".$fila['nombre']."</td>
            <td>".$fila['apellidoP']."</td>
            <td>".$fila['apellidoM']."</td>
          </tr>
        ";
      }
    }
  }
?>
