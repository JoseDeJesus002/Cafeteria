<?php
  session_start(); //Si hay una sesión activa mediante inicio de sesión, la activa
  include("php/conexion.php"); //Se realiza una conexión a la base de datos para ejecutar funcionalidades con PHP
  $con = conectar();
  $id = null;
  if(!empty($_GET['id'])){
    $id = $_REQUEST['id']; //Si se recibio una ID, se le es asignada a $id
  }

  if(null==$id){
    header("Location: MenuCliente.php");
  }

  if(!empty($_POST)){ //Se revisa que el formulario se haya llenado en su totalidad
	   //Se toman los valores del formulario
    $cantidad = $_POST['cantidad'];
  	$total = $_POST['total'];
  	$comboboxAlumno = $_POST['comboboxAlumno'];
    $valid = false;
    //Se revisa que los valores de los campos no esten vacios
    if(!empty($total) && !empty($comboboxAlumno)){
        $valid = true;
    }

    $usuario = $_SESSION['session_username'];

  	$query="SELECT idCliente FROM cliente, usuario WHERE nombreUsuario='".$usuario."' and idUsuario=Usuario_idUsuario"; //Busqueda del ID del cliente relacionada al ID del usuario empleada para iniciar sesión
    $resultado = $con->query($query) or die("Error en consulta <br>MySQL dice: ".mysqli_error($conexion));
    $numrows=$resultado->num_rows;
  	//Verificación de si el cliente fue encontrado
  	if($numrows==0){
  		echo "<script type='text/javascript'>alert('No se encontró el cliente');</script>";
  	}
  	$fila=$resultado->fetch_assoc();
  	$idCliente=$fila['idCliente'];

  	$query="SELECT idAlumno FROM alumno WHERE nombre='".$comboboxAlumno."'";
  	//Busqueda del alumno seleccionado del combobox
    $resultado = $con->query($query) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));
  	if($numrows==0){
  		echo "<script type='text/javascript'>alert('No se encontró el alumno');</script>";
  	}
  	$fila=$resultado->fetch_assoc();
  	$idAlumno=$fila['idAlumno'];

    //Registro de nueva venta
    if ($valid) {
        $sql = "INSERT INTO venta (idVenta, fecha, precioTotal, estado, VentaCliente_idCliente, Alumno_idAlumno) VALUES (NULL,CURRENT_TIMESTAMP,'0','1','$idCliente','$idAlumno')"; //Se realiza el registro de la nueva venta
        $result = $con->query($sql) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));
        //Verificación de que se haya realizado correctamente el registro
        if ($result) {
        	$query="SELECT idVenta FROM venta WHERE fecha=(SELECT fecha FROM venta ORDER BY idVenta DESC LIMIT 1)"; //Consulta de la venta recien realizada
        	//Verificación de que se haya encontrado la venta
    			if($numrows==0){
    				echo "<script type='text/javascript'>alert('No se encontró la venta');</script>";
    			}
          $result = $con->query($query);
    			$fila=$result->fetch_assoc();
    			$idVenta=$fila['idVenta'];
          $sql = "SELECT precio FROM producto WHERE idProducto=$id";
          $result = $con->query($sql) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));
          $fila = $result->fetch_assoc();
          $precio = $fila['precio'];
          $sql = "INSERT INTO detalleVenta (Venta_idVenta, Producto_idProducto, estado, total) VALUES('$idVenta','$id','0', '$precio')"; //Se realiza el registro en la tabla venta_has_producto
          $result = $con->query($sql) or die("Error en consulta <br>MySQL dice: ".mysqli_error($con));
          //Verificación de que se haya realizado correctamente el registro
          if($result){
          	echo "<script type='text/javascript'>alert('La venta se realizo con éxito');</script>";
            echo "<script type='text/javascript'>window.location.href = 'MenuCliente.php';</script>";
          }else{
          	echo "<script type='text/javascript'>alert('Fallo segundo registro de venta');</script>";
          }
        }else{
        	echo "<script type='text/javascript'>alert('Fallo venta');</script>";
        }
    }
}else{
    $query = "SELECT * FROM producto where idProducto = '".$id."'"; //Consulta de la información del producto a comprar
    $result = $con->query($query);
    $numrows=$result->num_rows;
    //Verificación de que se haya encontrado el producto
    if($numrows>0){
    	$fila=$result->fetch_assoc();
	    $nombre = $fila['nombre'];
	    $descripcion = $fila['descripcion'];
  		$precio = $fila['precio'];
  		$imagen = $fila['imagen'];
    }else{
    	echo "<script type='text/javascript'>alert('No se encontró el producto');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="css/Imagenes/Icon.ico">
	<title>Venta</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/Venta.css">
	<script type="text/javascript" src="js/Venta.js"></script>
</head>
<body onload="start();">
	<!--Barra de Navegación (Se generan las cabeceras, y los botones de la barra)-->
	<nav>
		<div id="Nosotros" class="cabcontenido">
		  <h3>Nosotros</h3>
		</div>

		<div id="Menu" class="cabcontenido">
		  <h3>Menú</h3>
		</div>

		<div id="Contacto" class="cabcontenido">
		  <h3>Contacto</h3>
		</div>

		<div id="Alumnos" class="cabcontenido">
		  <h3>Registro de Alumnos</h3>
		</div>

		<div id="PedidosC" class="cabcontenido">
			<h3>Pedidos</h3>
		</div>

		<div class="topnav" id="responsiveNav">
			<!--Botones principales de la barra-->
		  	<a href="index.php" class="Nosotros" onclick="abrirCabecera('Nosotros')">Nosotros</a>
		  	<a href="#" class="Menu" onclick="abrirCabecera('Menu')" id="defaultOpen">Menú</a>
		  	<a href="ContactoCliente.php" class="Contacto" onclick="abrirCabecera('Contacto')">Contacto</a>
		  	<!--Botones condicionales (se habilitan/deshabilitan dependiendo de si hay una sesión activada o no)-->
		  	<?php if(isset($_SESSION['session_username'])): ?>
		  	<a href="Alumnos.php" class="Alumnos" id="alumnostab" onclick="abrirCabecera('Alumnos')">Registro de Alumnos</a>
		  	<a href="Pedidos_Cliente.php" class="PedidosC" id="pedidostab" onclick="abrirCabecera('PedidosC')" >Pedidos</a>
		  	<?php endif; ?>
		  	<?php if(!isset($_SESSION['session_username'])): ?>
		  	<a class="iniciobtn" id="iniciobtn" onclick="document.getElementById('id01').style.display='block'">Inicio de Sesión</a>
		  	<?php endif; ?>
		  	<?php if(isset($_SESSION['session_username'])): ?>
		  	<a class="iniciobtn" id="iniciobtn" href="PHP/Cerrar_Sesion.php">Cerrar Sesión</a>
		  	<?php endif; ?>
		  	<?php if(!isset($_SESSION['session_username'])): ?>
		  	<a class="registrobtn" id="registrobtn" onclick="document.getElementById('id02').style.display='block'">Registro</a>
		  	<?php endif; ?>
		  	<a href="javascript:void(0);" class="icon" onclick="responsiveNav()">&#9776;</a>
		</div>

	</nav>

	<section class="bg">
		<div class="content">
			<div class="row">
				<!--Formulario para la compra de un producto-->
				<div class="column">
					<form style="border:0;" action="Venta.php?id=<?php echo $id?>" method="POST">
				  		<h2>Compra de Producto</h2>
				  		<img height="300px" width="500px" src="data:image/jpg;base64,<?php echo base64_encode($fila['imagen']) ?>">
				  		<h4>Nombre: <?php echo $nombre ?></h4>
				  		<h4>Descripción: <?php echo $descripcion ?></h4>
				  		<label><b>Precio</b></label>
				  		<br>
				      	<input type="number" name="precio" id="precio" value="<?php echo $precio ?>" readonly="true">
				      	<br>
				      	<label><b>Total</b></label>
				      	<br>
				      	<input type="number" name="total" id="total" value="<?php echo $precio ?>" readonly="true">
				      	<br>
				      	<label><b>Alumno</b></label><br>
				      	<select id="comboboxAlumno" name="comboboxAlumno">
				      		<?php
				      		$usuario = $_SESSION['session_username'];
				      		$query="SELECT idCliente FROM cliente, usuario WHERE nombreUsuario='".$usuario."' and idUsuario=Usuario_idUsuario"; //Consulta del ID del cliente perteneciente al usuario activo
                  $result = $con->query($query);
              $fila=$result->fetch_assoc();
							$Cliente=$fila['idCliente'];
				      		$query = "SELECT nombre FROM alumno WHERE AlumnoCliente_idCliente ='".$Cliente."'"; //Consuta de los nombres de los alumnos pertenecientes al cliente
                  $result = $con->query($query);
                $numrows=$result->num_rows;
			  				if ($numrows==0) {echo "<script type='text/javascript'>alert('No hay alumnos');</script>";}
			  				//Llenado del combobox con el resulta de la consulta
			  				while($fila=$result->fetch_assoc()){
				      		?>
				      		<option value="<?php echo $fila['nombre'] ?>"><?php echo $fila['nombre'] ?></option>
				      		<?php } ?>
				      	</select>
				      	<br>
				      	<input type="submit" name="Ordenar" id="Ordenar">
				      	<a class="back" href="MenuCliente.php">Cancelar</a>
			      	</form>
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="footer">
		  	<p>Todos los derechos reservados</p>
		</div>
	</footer>
</body>
</html>
