<?php
  include("conexion.php");
  $con = conectar();

  $productos = $_POST['productos'];
  $idAlumno = $_POST['comboboxAlumno'];
  $idCliente = $_POST['idCliente'];

  echo $idCliente;

  $sql = "INSERT INTO venta (idVenta, fecha, precioTotal, estado, VentaCliente_idCliente, Alumno_idAlumno) VALUES (NULL,CURRENT_TIMESTAMP,'0','1','$idCliente','$idAlumno')"; //Se realiza el registro de la nueva venta
  $result = $con->query($sql) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));

  if ($result)
    $query="SELECT idVenta FROM venta WHERE fecha=(SELECT fecha FROM venta ORDER BY idVenta DESC LIMIT 1)";

  $result = $con->query($query);
  $fila=$result->fetch_assoc();
  $idVenta=$fila['idVenta'];

  for ($i=0; $i < count($productos); $i++) {
    echo $productos[$i];
    $query = "INSERT INTO detalleventa (Venta_idVenta, Producto_idProducto, estado, total) VALUES ('".$idVenta."', '".$productos[$i]."'
              ,'0', '".obtenerPrecio($productos[$i],$con)."')";
    $con->query($query) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));
  }

  function obtenerPrecio($idProducto, $con){
    $query = "SELECT precio FROM producto WHERE idProducto = '".$idProducto."'";
    $resultado = $con->query($query);
    if($resultado){
      $fila = $resultado->fetch_assoc();
    }

    return $fila['precio'];
  }
?>
<script type="text/javascript">
  alert("El pedido se ha hecho"); //Envia un mensaje de confirmación
  window.location.href = '../MenuCliente.php';
</script>
