<?php
  class AccionPedido {
    public $conexion;
    public $idCliente;

    public function AccionPedido($idCliente, $conexion){
      $this->idCliente = $idCliente;
      $this->conexion = $conexion;
    }

    public function mostrarPedidos(){
      $query = "SELECT idVenta, fecha, Usuario.nombre nombreU, estado, Alumno.nombre nombreA, grado, grupo, salon FROM Usuario, Alumno, Cliente, Venta
                WHERE idUsuario=Usuario_idUsuario AND idCliente = VentaCliente_idCliente AND idCliente=AlumnoCliente_idCliente
                AND idAlumno = Alumno_idAlumno AND idCliente = '$this->idCliente' ORDER BY fecha DESC";

                $resultado = $this->conexion->query($query);

                while($fila = mysqli_fetch_array($resultado)){ // Ciclo para extraer los datos de la base conforme a la consulta
                  echo "
                    <tr>
                      <td>".$fila['idVenta']."</td>
                      <td>".$this->obtenerProductos($fila['idVenta'])."</td>
                      <td>".$this->calcularTotalVenta($fila['idVenta'])."</td>
                      <td>".$fila['fecha']."</td>
                      <td>".$this->revisarEstadoCompra($fila['estado'])."</td>
                      <td>".$this->facturasPendientes($fila['idVenta'])."</td>
                      <td>".$fila['nombreA']."</td>
                      <td>".$fila['grado']."</td>
                      <td>".$fila['grupo']."</td>
                      <td>".$fila['salon']."</td>
                      <td>".$this->opcionCancelarVenta($fila['estado'],$fila['idVenta'])."</td>
                  </tr>
                  ";
                }
    }

    public function obtenerProductos($idVenta){ // Funcion para obtener los productos que se compraron en base a una venta
      $pedidos = "";
      $query = "SELECT Producto.nombre AS nombreP FROM Cliente, Alumno, Venta, DetalleVenta, Producto WHERE idCliente=AlumnoCliente_idCliente AND
                idAlumno=Alumno_idAlumno AND idVenta=Venta_idVenta AND Producto_idProducto=idProducto AND VentaCliente_idCliente=AlumnoCliente_idCliente
                AND idVenta='".$idVenta."'";

      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){
        $pedidos.=$fila['nombreP'].", ";
      }

      return $pedidos;
    }

    function calcularTotalVenta($idVenta){ //Calcula el total de la venta considerando el total de la tabla DetalleVenta
      $query = "SELECT SUM(total) AS total FROM detalleventa WHERE Venta_idVenta = '$idVenta'";

      $resultado = $this->conexion->query($query);
      $fila = $resultado->fetch_row();

      return $fila[0]; //Retorna la suma que se haya generado
    }

    function revisarEstadoCompra($estadoCompra){
      $estado = "En preparación";

      if($estadoCompra == 0)
        return "Preparado";

      return $estado;
    }

    function facturasPendientes($idVenta){ //Funcion para agregar boton de pago en caso de que la factura este pendiente
      $boton = "Pagada";
      $query = "SELECT Producto.nombre AS nombreP FROM Cliente, Alumno, Venta, DetalleVenta, Producto WHERE idCliente=AlumnoCliente_idCliente AND
              idAlumno=Alumno_idAlumno AND idVenta=Venta_idVenta AND Producto_idProducto=idProducto AND VentaCliente_idCliente=AlumnoCliente_idCliente
              AND DetalleVenta.estado=FALSE AND idVenta='".$idVenta."'";

      $resultado = $this->conexion->query($query);

      if($resultado->num_rows > 0){ //Verifica que la consulta haya retornado un valor
        return "Pendiente";
      }

      return $boton; //Retorna el boton (etiqueta)
    }

    function opcionCancelarVenta($estado, $venta){
      $boton = " ";

      if($estado==1)
        return "<a href='#' onclick='confirmarPedido(".$venta.");' class='eliminar'><button style='cursor: pointer;' type='button' class='btnAccion'><img src='./css/Imagenes/btnEliminar.png'></a>";

      return $boton;
    }

  }
?>
