<?php
  include ("conexion.php"); //Incluye la conexión
  $conexion = conectar();

  $salida = "";
  $query = "SELECT idVenta, total, DetalleVenta.estado, Usuario.nombre AS NombreU, Alumno.nombre AS NombreA, fecha FROM Usuario, Cliente,
            Alumno, Venta, DetalleVenta WHERE idUsuario = Usuario_idUsuario AND idCliente = AlumnoCliente_idCliente AND idCliente = VentaCliente_idCliente
            AND idAlumno = Alumno_idAlumno AND idVenta = Venta_idVenta GROUP BY idVenta ORDER BY fecha DESC"; //Realiza una consulta para verificar que exista conexión

  if(isset($_POST['consulta'])){ //Recibe cualquier texto que el usuario haya ingresado
    $q = $conexion->real_escape_string($_POST['consulta']);
    $query = "SELECT idVenta, total, DetalleVenta.estado EstadoD, Usuario.nombre AS NombreU, Alumno.nombre AS NombreA, fecha
              FROM Usuario, Cliente, Alumno, Venta, DetalleVenta WHERE idUsuario = Usuario_idUsuario AND
              idCliente = AlumnoCliente_idCliente AND idCliente = VentaCliente_idCliente AND idAlumno = Alumno_idAlumno
              AND idVenta = Venta_idVenta AND Usuario.nombre LIKE '".$q."%' GROUP BY idVenta ORDER BY fecha DESC"; //Busca las facturas de ese usuario
  }

  $resultado = $conexion->query($query);

  if($resultado->num_rows > 0){ //Verifica que la consulta haya retornado alguna fila
    $salida.=
            "
              <table>
                <thead>
                  <th>Num. venta</th>
                  <th>Productos</th>
                  <th>Total</th>
                  <th>Cliente</th>
                  <th>Alumno</th>
                  <th>Fecha</th>
                  <th>Acción</th>
                </thead>
                <tbody>
            ";
    while($fila = $resultado->fetch_assoc()){ //Se repite el ciclo hasta que ya no haiga facturas por encontrar
      $salida.=
            "
              <tr>
                <td>".$fila['idVenta']."</td>
                <td>".obtenerProductos($fila['idVenta'], $conexion)."</td>
                <td>".calcularTotalVenta($fila['idVenta'], $conexion)."</td>
                <td>".$fila['NombreU']."</td>
                <td>".$fila['NombreA']."</td>
                <td>".$fila['fecha']."</td>
                <td>".facturasPendientes($fila['idVenta'], $conexion)."</td>
              </tr>
            ";
    }
    $salida.="</tbody></table>";
  }else{
    $salida.="No hay datos :(";
  }

  echo $salida;

  $conexion->close();

  function obtenerProductos($idVenta, $conexion){ // Funcion para obtener los productos que se compraron en base a una venta
    $pedidos = "";
    $query = "SELECT Producto.nombre AS nombreP FROM Cliente, Alumno, Venta, DetalleVenta, Producto WHERE idCliente=AlumnoCliente_idCliente AND
              idAlumno=Alumno_idAlumno AND idVenta=Venta_idVenta AND Producto_idProducto=idProducto AND VentaCliente_idCliente=AlumnoCliente_idCliente
              AND idVenta='".$idVenta."'";

    $resultado = $conexion->query($query);

    while($fila = $resultado->fetch_assoc()){
      $pedidos.=$fila['nombreP'].", ";
    }

    return $pedidos;
  }

  function facturasPendientes($idVenta, $conexion){ //Funcion para agregar boton de pago en caso de que la factura este pendiente
    $boton = " ";
    $query = "SELECT Producto.nombre AS nombreP FROM Cliente, Alumno, Venta, DetalleVenta, Producto WHERE idCliente=AlumnoCliente_idCliente AND
              idAlumno=Alumno_idAlumno AND idVenta=Venta_idVenta AND Producto_idProducto=idProducto AND VentaCliente_idCliente=AlumnoCliente_idCliente
              AND DetalleVenta.estado=FALSE AND idVenta='".$idVenta."'";

    $resultado = $conexion->query($query);

    if($resultado->num_rows > 0){ //Verifica que la consulta haya retornado un valor
      return "<a href='#' onclick='saldarFactura(".$idVenta.")'><button style='cursor: pointer;' type='button' class='btnAccion'><img src='./css/Imagenes/pago.png'></button>";
    }

    return $boton; //Retorna el boton (etiqueta)
  }

  function calcularTotalVenta($idVenta, $conexion){ //Calcula el total de la venta considerando el total de la tabla DetalleVenta
    $query = "SELECT SUM(total) AS total FROM detalleventa WHERE Venta_idVenta = '$idVenta'";

    $resultado = $conexion->query($query);
    $fila = $resultado->fetch_row();

    return $fila[0]; //Retorna la suma que se haya generado
  }
?>
