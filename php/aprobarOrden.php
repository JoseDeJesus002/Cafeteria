<?php
  include("conexion.php"); //Incluye la conexón

  if(pagarFactura($_GET['no'])>0){ //Recibe el id de la factura (idVenta) que se desea pagar
    echo "
          <script type='text/javascript'>
            alert('La venta ha sido completada');
            window.location.href = '../Pedidos.php';
          </script>
         ";
  }else{
    echo "
          <script type='text/javascript'>
            alert('Hubo un problema al intentar completar la venta');
            window.location.href = '../Pedidos.php';
          </script>
         ";
  }

  function pagarFactura($idVenta){ //Funcion para pagar una factura
    $conexion = conectar();
    $query = "UPDATE venta SET estado = 0 WHERE idVenta = '$idVenta'";
    return $conexion->query($query);
  }
?>
