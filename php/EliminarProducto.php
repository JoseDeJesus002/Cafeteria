<?php
  include("conexion.php"); //Incluye la conexión

  eliminarProducto($_GET['no'],$_GET['cat']); //Recibe el id del producto y el id de la categoria a la que pertenece el producto

  function eliminarProducto($idProducto,$categoria){ //Función para eliminar un producto
    $conexion = conectar();
    $query = "UPDATE producto SET estado = FALSE WHERE idProducto='".$idProducto."' AND Categoria_idCategoria = '".$categoria."'";
    $conexion->query($query); //El query no elimina el registro de la base de datos sino que modifica la variable estado ya que si se elimina
  }                          //causara conflicto en las tablas que esten relacionadas con el id del mismo
?>

<script type="text/javascript">
  alert("El producto se elimino exitosamente");
  window.location.href = '../Productos.php';
</script>
