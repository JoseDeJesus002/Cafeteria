<?php
  include("conexion.php");  //Incluye la conexión

  if(!empty($_FILES['imagen']['tmp_name']) && file_exists($_FILES['imagen']['tmp_name'])) { //Verifica que el archivo (imagen) exista
    $imagen= addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    modificarProducto($_POST['id'],$_POST['nombre'],$_POST['descripcion'],floatval($_POST['precio']),$imagen,$_POST['cat']);
  }else{ //Asigna NULL a la imagen en caso de que no se desee modificar
    modificarProducto($_POST['id'],$_POST['nombre'],$_POST['descripcion'],floatval($_POST['precio']),NULL,$_POST['cat']);
  }

  function modificarProducto($idProducto, $nombre, $descripcion, $precio, $imagen, $categoria){ //Función para modificar un producto
    $conexion = conectar();
    $query = "";

    if(buscarProducto($nombre)->num_rows==0){
      if($imagen==NULL){ //Verifica en caso de que al modificar se quiera mantener la imagen del producto
        $query = "UPDATE producto SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', Categoria_idCategoria = '$categoria'
                  WHERE idProducto = '$idProducto' and Categoria_idCategoria = (SELECT Categoria_idCategoria
                  WHERE idProducto = '$idProducto')";
      }else{ //Modifica la imagen e inserta nuevamente en la BD
        $query = "UPDATE producto SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', imagen = '$imagen',
                  Categoria_idCategoria = '$categoria' WHERE idProducto = '$idProducto' and Categoria_idCategoria = (SELECT Categoria_idCategoria
                  WHERE idProducto = '$idProducto')";
      }

      $resultado = $conexion->query($query);

      if($resultado>0){
        echo "
              <script type='text/javascript'>
                alert('El producto fue modificado');
                window.location.href = '../Productos.php';
              </script>
             ";
      }else{
        echo "
              <script type='text/javascript'>
                alert('Hubo un problema al modificar el producto');
                window.location.href = '../Productos.php';
              </script>
             ";
      }
    }else{
      echo "
            <script type='text/javascript'>
              alert('El producto ya existe');
              window.location.href = '../Productos.php';
            </script>
           ";
    }
  }

  function buscarProducto($nombreP){
    $conexion = conectar();
    $query = "SELECT * FROM producto WHERE nombre = '$nombreP' AND estado = TRUE";

    return $conexion->query($query);
  }
?>
