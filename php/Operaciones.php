<?php
  class Operacion{
    public $conexion;
    public function Operacion(){
      include("conexion.php");
      $this->conexion = conectar();
    }

    public function llenarForm($idProducto){ //Funcion para extraer los datos de un producto y mostrarlo como form en cado de modificar
      $query = "SELECT * FROM producto WHERE idProducto='".$idProducto."'";
      $resultado = $this->conexion->query($query);

      while($fila = mysqli_fetch_array($resultado)){
        echo "
          <form action='php/ModificarProducto.php' method='POST' enctype='multipart/form-data' class='formulario'>
            <input type='hidden' name='id' value='".$fila['idProducto']."'>
            <label>Nombre: </label>
            <input type='text' REQUIRED name='nombre' value='".$fila['nombre']."'>
            <label>Descripción: </label>
            <input type='text' REQUIRED name='descripcion' value='".$fila['descripcion']."'>
            <label>Precio: </label>
            <input type='number' REQUIRED name='precio' value='".$fila['precio']."' step='0.1'>
            <select name='cat' REQUIRED>
              ".$this->seleccionarCategoria($fila['Categoria_idCategoria'])."
            </select>
            <img height='100px' src='data:image/jpg;base64,".base64_encode($fila['imagen'])."'>
            <br><input type='file' name='imagen'>
            <input type='submit' value='Modificar' style='width: 100%;'>
          </form>
        ";
      }
    }

    public function agregarProducto(){ //Funcion para mostrar el formulario para agregar productos
      echo "
        <form action='php/AgregarProducto.php' method='POST' enctype='multipart/form-data' class='formulario'>
          <input type='text' REQUIRED name='nombre' placeholder='Nombre'>
          <input type='text' REQUIRED name='descripcion' placeholder='Descripción'>
          <input type='number' REQUIRED name='precio' step='0.1' placeholder='Precio'>
          <select name='cat' REQUIRED>
            <option SELECTED>Selecciona una categoría</option>
            ".$this->agregarCategorias()."
          </select>
          <input type='file' name='imagen'>
          <input type='submit' value='Agregar'>
        </form>
      ";
    }

    public function agregarCategorias(){ //Funcion para agregar las categorías a un select para poder seleccionarlas
      $categorias = "";
      $query = "SELECT * FROM categoria";
      $resultado = $this->conexion->query($query);
      while($fila = mysqli_fetch_array($resultado))
        $categorias .= "<option value='".$fila['idCategoria']."'>".$fila['categoria']."</option>";


      return $categorias;
    }

    public function seleccionarCategoria($categoria){ //Función para dejar seleccionada una categoría por defecto en caso de que ya la tenga
      $categorias = "";
      $query = "SELECT * FROM categoria";
      $resultado = $this->conexion->query($query);
      while($fila = mysqli_fetch_array($resultado)){
        if($fila['idCategoria']==$categoria){
          $categorias .= "<option selected value='".$fila['idCategoria']."'>".$fila['categoria']."</option>";
        }else{
            $categorias .= "<option value='".$fila['idCategoria']."'>".$fila['categoria']."</option>";
        }
      }
      return $categorias;
    }

    public function agregarMenu(){ //Función para mostrar agregar los datos a un formulario en caso de agregar un nuevo menú
      echo "
            <form action='php/AgregarMenu.php' method='POST' class='formulario'>
              <select name='cat' REQUIRED>
                <option SELECTED>Selecciona un producto</option>
                ".$this->mostrarProductos()."
              </select>
              <input type='date' name='fecha' value='' placeholder='Fecha' REQUIRED/>
              <input type='submit' value='Agregar'>
            </form>
           ";
    }

    public function mostrarProductos(){ //Función para asignar los productos en un select para poder seleccionarlos
      $productos = "";
      $query = "SELECT * FROM producto WHERE estado = TRUE";
      $resultado = $this->conexion->query($query);
      while($fila = mysqli_fetch_array($resultado))
        $categorias .= "<option value='".$fila['idProducto']."'>".$fila['nombre']."</option>";


      return $categorias;
    }

    public function agregarCategoria(){ //Función para agregar un formulario en caso de agregar una nueva categoría
      echo "
            <form action='php/AgregarCategoria.php' method='POST' class='formulario'>
              <input type='text' name='nomCat' value='' placeholder='Categoría' REQUIRED/>
              <input type='submit' value='Agregar'>
            </form>
           ";
    }

  }
?>
