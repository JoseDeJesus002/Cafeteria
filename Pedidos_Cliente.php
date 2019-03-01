<?php
	session_start();//Si hay una sesión activa mediante inicio de sesión, la activa
	include("php/conexion.php");
	$con = conectar();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="css/Imagenes/Icon.ico">
	<title>Pedidos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/Pedidos_Cliente.css">
	<script type="text/javascript" src="js/Pedidos_Cliente.js"></script>
	<script type="text/javascript">
		function reFresh(){
			location.reload(true)
		}
		window.setInterval("reFresh()",3000);
	</script>
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
		  	<a href="MenuCliente.php" class="Menu" onclick="abrirCabecera('Menu')">Menú</a>
		  	<a href="ContactoCliente.php" class="Contacto" onclick="abrirCabecera('Contacto')">Contacto</a>
		  	<!--Botones condicionales (se habilitan/deshabilitan dependiendo de si hay una sesión activada o no)-->
		  	<?php if(isset($_SESSION['session_username'])): ?>
		  	<a href="Alumnos.php" class="Alumnos" onclick="abrirCabecera('Alumnos')">Registro de Alumnos</a>
		  	<a href="#" class="PedidosC" onclick="abrirCabecera('PedidosC')" id="defaultOpen">Pedidos</a>
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
			<!--Generación de la Tabla de Pedidos correspondiente al Cliente Activo-->
			<div class="tableDiv" style="overflow-x:auto;">
				<h2>Lista de Pedidos</h2>
			  	<hr>
			  	<table>
			  		<thead>
			  			<tr>
								<th>No. </th>
				  			<th>Producto</th>
				  			<th>Total</th>
								<th>Fecha</th>
				  			<th>Estado de Compra</th>
								<th>Estado de factura</th>
				  			<th>Alumno</th>
				  			<th>Grado</th>
				  			<th>Grupo</th>
				  			<th>Salón</th>
				  			<th>Acción</th>
				  		</tr>
			  		</thead>
			  		<tbody>
			  			<?php
								$usuario = $_SESSION['session_username'];
								$query = "SELECT idCliente FROM cliente, usuario WHERE nombreUsuario='".$usuario."' and idUsuario=Usuario_idUsuario"; //Busqueda de cliente al que le pertenece el ID de usuario empleada para iniciar sesion
								$resultado = $con->query($query);
								$fila=$resultado->fetch_assoc();
								$idCliente=$fila['idCliente'];
								include("php/AccionPedido.php");
								$con = new AccionPedido($idCliente,$con);
								$con->mostrarPedidos();
				  		?>
			  		</tbody>
			  	</table>
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
