<?php
  include("conexion.php"); //Incluye la conexión

  eliminarMenu($_GET['no']); //Recibe el id del menú mediante el metodo POST

  function eliminarMenu($idMenu){ //Función para eliminar un menú
    $conexion = conectar();
    $query = "DELETE FROM menu WHERE idMenu = '$idMenu'";
    $conexion->query($query);
  }
?>

<script type="text/javascript"> //Envia un mensaje de confirmación
  alert("El producto ha sido quitado del menu");
  window.location.href = '../Menu.php';
</script>
