<?php
include("conexion.php"); //Conexión a la base de datos
$con = conectar();

$id = 0;

if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id']; //Si se recibio una ID, se le es asignada a $id

}
	$sql = "DELETE FROM venta WHERE idVenta = $id"; //Se elimina el registro de la venta correspondiente al ID
	$result = $con->query($sql);
	if ($result) {
    echo "
          <script type='text/javascript'>
            alert('El pedido ha sido cancelado');
            window.location.href = '../Pedidos_Cliente.php';
          </script>
         ";
	}else{
		echo "<script type='text/javascript'>alert('Fallo Eliminación');</script>";
		echo "<script type='text/javascript'>window.location.href = '../Pedidos_Cliente.php';</script>";
	}

?>
