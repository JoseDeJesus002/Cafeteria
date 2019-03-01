<?php
  class formProductos {
    public $conexion;
    public $idCliente;

    public function formProductos($idCliente, $conexion){
      $this->idCliente = $idCliente;
      $this->conexion = $conexion;
    }

    public function llenarForm(){
      echo "
              <form style='border: 0;' action='php/RealizarCompra.php' method='POST'>
                <input type='hidden' name='idCliente' value='".$this->idCliente."'>
                <h2>Compra de Productos</h2>
                <table>
                  <thead>
                    <tr>
                      <th>No. </th>
                      <th>Imagen</th>
                      <th>Nombre</th>
                      <th>Categoría</th>
                      <th>Descripción</th>
                      <th>Comprar</th>
                    </tr>
                  </thead>
                  <tbody>
                    ".$this->mostrarProductos()."
                  </tbody>
                </table>
                <label><b>Alumno</b></label><br>
                <select id='comboboxAlumno' REQUIRED name='comboboxAlumno'>
                  ".$this->mostrarAlumnos()."
                </select>
                <br>
				      	<input type='submit' name='Ordenar' id='Ordenar'>
				      	<a class='back' href='MenuCliente.php'>Cancelar</a>
              </form>
           ";
    }

    public function mostrarProductos(){
      $etiqueta = "";
      $cont = 1;
      $query = "SELECT * FROM producto, categoria WHERE estado = TRUE AND Categoria_idCategoria = idCategoria";
      $resultado = $this->conexion->query($query);
      while($fila = $resultado->fetch_assoc()){
        $etiqueta.="<tr>
                      <td>".$cont."</td>
                      <td><img height='50px' src='data:image/jpg;base64,".base64_encode($fila['imagen'])."'></td>
                      <td>".$fila['nombre']."</td>
                      <td>".$fila['categoria']."</td>
                      <td>".$fila['descripcion']."</td>
                      <td><input type='checkbox' name='productos[]' value='".$fila['idProducto']."'></td>
                    </tr>";
        $cont+=1;
      }

      return $etiqueta;
    }

    public function mostrarAlumnos(){
      $etiqueta = "";
      $query="SELECT nombre, idAlumno FROM alumno WHERE AlumnoCliente_idCliente ='".$this->idCliente."'";
      $resultado = $this->conexion->query($query);
      while($fila = $resultado->fetch_assoc()){
        $etiqueta.="<option value='".$fila['idAlumno']."'>".$fila['nombre']."</option>";
      }

      return $etiqueta;
    }
  }
?>
