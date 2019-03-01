<?php
  include("conexion.php"); //Incluye la conexión

  if(pagarFactura($_GET['no'])>0){ //Recibe el id de la venta la cual se desea cubrir(pagar)
    echo "
          <script type='text/javascript'>
            alert('La factura ha sido pagada');
            window.location.href = '../Clientes.php';
          </script>
         ";
  }else{
    echo "
          <script type='text/javascript'>
            alert('Hubo un problema al intentar pagar la factura');
            window.location.href = '../Clientes.php';
          </script>
         ";
  }

  function pagarFactura($idProducto){ //Función para pagar una factura
    $conexion = conectar();
    $query = "UPDATE detalleventa SET estado = 1 WHERE Venta_idVenta = '$idProducto'";
    return $conexion->query($query);
  }
?>
