<?php
  include("conexion.php");

  eliminarPedido($_GET['no']); //Se recive el numero de venta mediante el metodo GET

  function eliminarPedido($idVenta){ //Funcion para eliminar un pedido
    $conexion = conectar();
    $query = "DELETE FROM venta WHERE idVenta = '$idVenta'"; //Elimina la venta
    $conexion->query($query) or die("Error en consulta <br>MySQL dice: ".mysqli_error($conexion));
  }
?>

<script type="text/javascript"> //Envia mensaje de confirmación
  alert("La orden ha sido cancelada");
  window.location.href = '../Pedidos.php';
</script>
