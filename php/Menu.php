<?php
  class Menu {
    public $conexion;

    public function Menu(){
      include("conexion.php");
      $this->conexion = conectar();
    }

    public function recuperarDatos(){ //Función para mostrar los productos del menú
      $query = "SELECT idProducto, imagen, nombre, descripcion, precio, estado, categoria, Categoria_idCategoria, idMenu FROM producto, categoria, menu
                WHERE Categoria_idCategoria=idCategoria and estado = TRUE and Producto_idProducto = idProducto and menu.fecha = date_format(now(),'%Y-%m-%d')";

      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){ //El ciclo se repetira hasta que ya no haiga datos que extraer
        echo "
          <tr>
            <td>".$fila['idProducto']."</td>
            <td><img height='100px' src='data:image/jpg;base64,".base64_encode($fila['imagen'])."'></td>
            <td>".$fila['nombre']."</td>
            <td>".$this->descripcionProducto($fila['descripcion'])."</td>
            <td>".$fila['precio']."</td>
            <td>".$this->estadoProducto($fila['estado'])."</td>
            <td>".$fila['categoria']."</td>
            <td class='accion'>
                <a href='#' onclick='eliminarMenu(".$fila['idMenu'].");'><button style='cursor: pointer;' type='button' class='btnAccion'><img src='./css/Imagenes/btnEliminar.png'></button>
            </td>
        </tr>
        ";
      }
    }

    public function estadoProducto($estado){ //Función para asignar el estado del producto como un texto
      $etiqueta = "Agotado";
      if($estado == 1)
        $etiqueta = "Disponible";

      return $etiqueta;
    }

    public function descripcionProducto($descripcion){ //Función para asignar la descripción del producto
      if($descripcion===null)
        return "Ninguna";
      return $descripcion;
    }
  }
?>
