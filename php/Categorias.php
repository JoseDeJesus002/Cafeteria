<?php
  class Categoria {
    public $conexion;

    public function Categoria() {
      include("conexion.php"); //Incluye la conexión
      $this->conexion = conectar();
    }

    public function mostrarCategorias() { //Funcion para mostrar todas las categorías
      $query = "SELECT * FROM categoria";
      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){ //Se repite el ciclo hasta que no haiga datos
        echo "
          <tr>
            <td>".$fila['idCategoria']."</td>
            <td>".$fila['categoria']."</td>
          </tr>
        ";
      }
    }
  }
?>
