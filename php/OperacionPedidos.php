<?php
  class OperacionPedido {  //Clase para realizar operaciones de algun pediso
    public $conexion;

    public function OperacionPedido() { //Constructor que establece la conexion con la base de datos
      include("conexion.php");
      $this->conexion = conectar();
    }

    public function obtenerPedidos(){ //Funcion para obtener los pedidos en el dia que es
      $query = "SELECT idVenta, Usuario.nombre AS nombreU, estado, Alumno.nombre AS nombreA, grado, grupo, salon FROM Usuario, Alumno, Cliente, Venta
                WHERE idUsuario=Usuario_idUsuario AND idCliente = VentaCliente_idCliente AND idCliente=AlumnoCliente_idCliente
                AND idAlumno = Alumno_idAlumno AND estado = TRUE AND date_format(fecha,'%Y-%m-%d') = CURRENT_DATE() ORDER BY idVenta DESC";
                /*
                  La consulta anterior consulta los pedidos que estan pendientes por entregar, de igual forma compara la fecha en que se realizo el
                  pedido con la fecha del dia actual, los ordena por el idventa para poder mostrar primero el ultimo pedido que se agregue a la base
                */

      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){ // Ciclo para extraer los datos de la base conforme a la consulta
        echo "
          <tr>
            <td>".$fila['idVenta']."</td>
            <td>".$fila['nombreU']."</td>
            <td>".$this->obtenerProductos($fila['idVenta'])."</td>
            <td>".$fila['nombreA']."</td>
            <td>".$fila['grado']."</td>
            <td>".$fila['grupo']."</td>
            <td>".$fila['salon']."</td>
            <td coldspan='2' class='accion'>
              <a href='php/aprobarOrden.php?no=".$fila['idVenta']."' title='Orden lista'><button style='cursor: pointer;' type='button' class='btnAccion'><img src='./css/Imagenes/aceptar.png'></button>
              <a href='#' onclick='eliminarPedido(".$fila['idVenta'].");' title='Cancelar orden'><button style='cursor: pointer;' type='button' class='btnAccion'><img src='./css/Imagenes/cancelar.png'></button>
            </td>
        </tr>
        ";
      }
    }

    public function obtenerProductos($idVenta){ // Funcion para obtener los productos que se compraron en base a una venta
      $pedidos = "";
      $query = "SELECT Producto.nombre AS nombreP FROM Cliente, Alumno, Venta, DetalleVenta, Producto WHERE idCliente=AlumnoCliente_idCliente AND
                idAlumno=Alumno_idAlumno AND idVenta=Venta_idVenta AND Producto_idProducto=idProducto AND VentaCliente_idCliente=AlumnoCliente_idCliente
                AND idVenta='".$idVenta."' AND  date_format(fecha,'%Y-%m-%d') = CURRENT_DATE() AND venta.estado = TRUE";

      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){
        $pedidos.=$fila['nombreP'].", ";
      }

      return $pedidos;
    }
  }


?>
