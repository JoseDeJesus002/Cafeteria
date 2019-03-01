<?php
  include("conexion.php"); //Incluye la conexón

  if(!empty($_FILES['imagen']['tmp_name']) && file_exists($_FILES['imagen']['tmp_name'])) { //Verifica que el archivo (imagen) exista
    $imagen= addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    validar($_POST['nombre'],$_POST['descripcion'],$_POST['precio'],$imagen,$_POST['cat']); //Si se cargo una imagen la agrega a la BD
  }else{
    validar($_POST['nombre'],$_POST['descripcion'],$_POST['precio'],NULL,$_POST['cat']); //Si no se cargo imagen agrega NULL en BD
  }

  function validar($nombre, $descripcion, $precio, $imagen, $categoria){ //Funcion para validar campos
    if(buscarProducto($nombre)->num_rows == 0){ //Verifica que no haya productos repetidos
      if($precio>0){ //Verifica que el precio ingresado sea correcto
        if(nuevoProducto($nombre, $descripcion, $precio, $imagen, $categoria)){ //Agrega el producto
          echo "
                <script type='text/javascript'>
                  alert('El producto ha sido agregado');
                  window.location.href = '../Productos.php';
                </script>
               ";
        }else{
          echo "
                <script type='text/javascript'>
                  alert('Hubo un problema al agregar el producto');
                  window.location.href = '../Productos.php';
                </script>
               ";
        }
      }else{
        echo "
              <script type='text/javascript'>
                alert('Debes de asignar un precio mayor a cero');
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

  function nuevoProducto($nombre, $descripcion, $precio, $imagen, $categoria){ //Función para agregar un nuevo producto
    $conexion = conectar();
    $query = "INSERT INTO producto (idProducto, nombre, descripcion, precio, estado, imagen, Categoria_idCategoria)
              VALUES (NULL, '$nombre', '$descripcion', '$precio', 1, '$imagen', '$categoria')";

    return $conexion->query($query) or die("Error en consulta <br>MySQL dice: ".mysqli_error($conexion));
  }

  function buscarProducto($nombreP){
    $conexion = conectar();
    $query = "SELECT * FROM producto WHERE nombre = '$nombreP' AND estado = TRUE";

    return $conexion->query($query);
  }
?>
