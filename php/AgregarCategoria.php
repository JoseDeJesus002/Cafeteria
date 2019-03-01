<?php
  include("conexion.php"); //Incluye la conexión

  $categoria = $_POST['nomCat']; //Recibe el

  if (!preg_match("/^[a-zA-Z ]*$/",$categoria)) { //Validación para asegurar que la categoria solo contenga letras y espacios
      echo "<script type='text/javascript'>alert('La categoria solo puede contener letras');</script>";
      echo "<script type='text/javascript'>window.location.href = '../Categorias.php';</script>";
  }else{
    if(buscarCategoria($categoria)->num_rows == 0){ //Verifica que no haya categorias repetidas
      if(agregarCategoria($categoria)){ //Recibe la categoría por el metodo POST
        echo "
              <script type='text/javascript'>
                alert('La categoría ha sido agregada');
                window.location.href = '../Categorias.php';
              </script>
             ";
      }else {
        echo "
              <script type='text/javascript'>
                alert('Hubo un problema al agregar la categoria');
                window.location.href = '../Categorias.php';
              </script>
             ";
      }
    }else{
      echo "
            <script type='text/javascript'>
              alert('La categoria ya existe');
              window.location.href = '../Categorias.php';
            </script>
           ";
    }
  }

  function agregarCategoria($Categoria){ //Función para agregar la categoría
    $conexion = conectar();
    $query = "INSERT INTO categoria (idCategoria, categoria) VALUES (NULL, '$Categoria')";

    return $conexion->query($query);
  }

  function buscarCategoria($Categoria){
    $conexion = conectar();
    $query = "SELECT * FROM categoria WHERE categoria.categoria = '$Categoria'";

    return $conexion->query($query);
  }
?>
