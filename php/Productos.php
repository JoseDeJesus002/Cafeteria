<?php
  class Producto {
    public $conexion;

    public function Producto(){
      include("conexion.php");
      $this->conexion = conectar();
    }

    public function recuperarDatos(){ //Función para mostrar todos los producto en forma de tabla(table)
      $query = "SELECT idProducto, imagen, nombre, descripcion, precio, estado, categoria, Categoria_idCategoria FROM producto, categoria
                WHERE Categoria_idCategoria=idCategoria and estado = TRUE";

      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){
        echo "
          <tr>
            <td>".$fila['idProducto']."</td>
            <td><img height='100px' src='data:image/jpg;base64,".base64_encode($fila['imagen'])."'></td>
            <td>".$fila['nombre']."</td>
            <td>".$this->descripcionProducto($fila['descripcion'])."</td>
            <td>".$fila['precio']."</td>
            <td>".$this->estadoProducto($fila['estado'])."</td>
            <td>".$fila['categoria']."</td>
            <td colspan='2' class='accion'>
                <a href='ModificarProducto.php?no=".$fila['idProducto']."'><button style='cursor: pointer;' type='button' class='btnAccion'><img src='./css/Imagenes/btnAgregar.png'></button>
                <a href='#' onclick='confirmar(".$fila['idProducto'].",".$fila['Categoria_idCategoria'].");'><button style='cursor: pointer;' type='button' class='btnAccion'><img src='./css/Imagenes/btnEliminar.png'></button>
            </td>
        </tr>
        ";
      }
    }

    public function estadoProducto($estado){ //Función para mostrar el estado del producto validando la variable recibida como parametro
      $etiqueta = "Agotado";
      if($estado == 1)
        $etiqueta = "Disponible";

      return $etiqueta;
    }

    public function descripcionProducto($descripcion){ //Función para asignar una descripcion del producto en caso de no tenerla
      if($descripcion===null)
        return "Ninguna";
      return $descripcion;
    }
  }
?>
