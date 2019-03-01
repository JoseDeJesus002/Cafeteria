<?php
	session_start();//Si hay una sesión activa mediante inicio de sesión, la activa
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="css/Imagenes/Icon.ico">
	<title>Principal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/PrincipalEmpleado.css">
	<script type="text/javascript" src="js/General.js"></script>
</head>
<body onload="inicioVentana();">
	<?php if(isset($_SESSION['session_username'])): ?>
		<div class="cont" id="cont">
			<div class="preloader">
				<p>Cargando</p>
			</div>
		</div>
		<script type="text/javascript" src="js/cerrar.js"></script> <!--Se ejecuta el script-->
	<?php endif; ?>
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

		<div id="Pedidos" class="cabcontenido">
		  <h3>Pedidos</h3>
		</div>

		<div id="Clientes" class="cabcontenido">
		  <h3>Clientes</h3>
		</div>

		<div id="Productos" class="cabcontenido">
			<h3>Productos</h3>
		</div>

		<div id="Categorias" class="cabcontenido">
			<h3>Categorías</h3>
		</div>
		<div class="topnav" id="responsiveNav">
				<a href="#" class="Nosotros" onclick="abrirCabecera('Nosotros')" id="defaultOpen">Nosotros</a>
				<a href="Menu.php" class="Menu" onclick="abrirCabecera('Menu')">Menú</a>
				<a href="Contacto.php" class="Contacto" onclick="abrirCabecera('Contacto')">Contacto</a>
				<a href="Pedidos.php" class="Pedidos" onclick="abrirCabecera('Pedidos')">Pedidos</a>
				<a href="Clientes.php" class="Clientes" onclick="abrirCabecera('Clientes')">Clientes</a>
				<a href="Productos.php" class="Productos" onclick="abrirCabecera('Productos')">Productos</a>
				<a href="Categorias.php" class="Categorias" onclick="abrirCabecera('Categorias')">Categorías</a>

		  	<a class="iniciobtn" style="cursor: pointer;" href="php/Cerrar_Sesion.php">Cerrar sesión</a>
		  	<a href="javascript:void(0);" class="icon" onclick="responsiveNav()">&#9776;</a>
		</div>
	</nav>

	<section class="bg">
		<div class="content">
		  	<div class="" style="background: rgba(255, 255, 255, 0.2); border-radius: 5px; height: 100%;">
					<center>
						<img src="css/Imagenes/Principal.jpg" style="margin-top: 10px; border-radius: 5px;" height="500px">
					<center>
					<p id="nosotros">
						Bienvenido a nuestra cafetería.<br><br>

						Hoy nuestro sistema evoluciona a una manera mas eficiente haciendo las entregas son mucho mas rápidas.

						Como siempre, nuestro objetivo es que todos nuestros clientes se sientan satisfechos al saber que los alimentos que reciben sus hijos son saludables, de variedad y de buena calidad.
					</p>
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
