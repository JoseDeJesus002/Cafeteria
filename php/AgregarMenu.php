<?php
  include("conexion.php"); //Incluye la conexión
  $idProducto = $_POST['cat'];
  $fecha = $_POST['fecha'];
  if(buscarMenu($idProducto,$fecha)->num_rows == 0){
    if(agregarMenu($idProducto,$fecha)){ //Recibe el id del producto y la fecha para poder agregarlo al menú
      echo "
            <script type='text/javascript'>
              alert('El producto se agrego al menu');
              window.location.href = '../Menu.php';
            </script>
           ";
    }else{
      echo "
            <script type='text/javascript'>
              alert('Hubo un problema al intentar agregar el producto');
              window.location.href = '../Menu.php';
            </script>
           ";
    }
  }else{
    echo "
          <script type='text/javascript'>
            alert('El producto ya esta en el menú');
            window.location.href = '../Menu.php';
          </script>
         ";
  }

  function agregarMenu($idProducto, $fecha){ //Funcón para agregar un nuevo menú
    $conexion = conectar();
    $query = "INSERT INTO menu (idMenu, fecha, Producto_idProducto)
              VALUES (NULL, date_format('$fecha','%Y-%m-%d'), '$idProducto')";

    return $conexion->query($query) or die("Error en consulta <br>MySQL dice: ".mysqli_error($conexion));
  }

  function buscarMenu($idProducto, $fecha){
    $conexion = conectar();
    $query = "SELECT * FROM menu WHERE Producto_idProducto = '$idProducto' AND fecha = date_format('$fecha','%Y-%m-%d')";

    return $conexion->query($query);
  }
?>
