<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="css/Imagenes/Icon.ico">
	<title>Contacto</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/Contacto.css">
	<script type="text/javascript" src="js/General.js"></script>
</head>
<body onload="inicioVentana();">
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

		<div id="Categorías" class="cabcontenido">
			<h3>Categorias</h3>
		</div>
		<div class="topnav" id="responsiveNav">
			<a href="Principal.php" class="Nosotros" onclick="abrirCabecera('Nosotros')">Nosotros</a>
			<a href="Menu.php" class="Menu" onclick="abrirCabecera('Menu')">Menú</a>
			<a href="#" class="Contacto" onclick="abrirCabecera('Contacto')" id="defaultOpen">Contacto</a>
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
		  	<h2 id="cabecera">Personal</h2>
        <div id="contactos">
          <?php
            include("php/Contacto.php");
            $con = new Contacto();
            $con->recuperarDatos();
          ?>
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
