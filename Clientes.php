<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="css/Imagenes/Icon.ico">
	<title>Clientes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/Clientes.css">
	<script type="text/javascript" src="js/General.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/busquedaClientes.js"></script>
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

		<div id="Categorias" class="cabcontenido">
			<h3>Categorías</h3>
		</div>
		<div class="topnav" id="responsiveNav">
			<a href="Principal.php" class="Nosotros" onclick="abrirCabecera('Nosotros')">Nosotros</a>
			<a href="Menu.php" class="Menu" onclick="abrirCabecera('Menu')">Menú</a>
			<a href="Contacto.php" class="Contacto" onclick="abrirCabecera('Contacto')">Contacto</a>
			<a href="Pedidos.php" class="Pedidos" onclick="abrirCabecera('Pedidos')">Pedidos</a>
			<a href="#" class="Clientes" onclick="abrirCabecera('Clientes')" id="defaultOpen">Clientes</a>
			<a href="Productos.php" class="Productos" onclick="abrirCabecera('Productos')">Productos</a>
			<a href="Categorias.php" class="Categorias" onclick="abrirCabecera('Categorias')">Categorías</a>


		  	<a class="iniciobtn" style="cursor: pointer;" href="php/Cerrar_Sesion.php">Cerrar sesión</a>
		  	<a href="javascript:void(0);" class="icon" onclick="responsiveNav()">&#9776;</a>
		</div>
	</nav>

	<section class="bg">
		<div class="content">
		  	<h2 id="Cabecera1">Lista de clientes</h2>
				<div id="tPrincipal">
					<table id="tClientes">
						<thead>
							<tr>
								<th>Usuario</th>
								<th>Nombre</th>
								<th>Apellido paterno</th>
								<th>Apellido materno</th>
							</tr>
						</thead>
						<tbody id="cont">
							<?php
		            include("php/Cliente.php");
		            $con = new Cliente();
								$con->mostrarClientes();
		          ?>
						</tbody>
					</table>
				</div>
				<h2 id="Cabecera2">Facturas</h2>
				<div id="busqueda" >
					<label for="cajaBusqueda">Buscar: </label>
					<input style="border-radius: 5px; width: 20%;" type="text" id="cajaBusqueda" name="cajaBusqueda" placeholder="Ingresar el nombre del cliente">
				</div>
				<div id="datos" style="overflow-y: scroll; height: 38%; margin-top: 5px;">

				</div>
	</section>

	<footer>
		<div class="footer">
		  	<p>Todos los derechos reservados</p>
		</div>
	</footer>
</body>
</html>
