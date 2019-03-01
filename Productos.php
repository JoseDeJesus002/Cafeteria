<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="css/Imagenes/Icon.ico">
	<title>Productos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/Productos.css">
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

		<div id="Categorias" class="cabcontenido">
			<h3>Categorías</h3>
		</div>
		<div class="topnav" id="responsiveNav">
			<a href="Principal.php" class="Nosotros" onclick="abrirCabecera('Nosotros')">Nosotros</a>
			<a href="Menu.php" class="Menu" onclick="abrirCabecera('Menu')">Menú</a>
			<a href="Contacto.php" class="Contacto" onclick="abrirCabecera('Contacto')">Contacto</a>
			<a href="Pedidos.php" class="Pedidos" onclick="abrirCabecera('Pedidos')">Pedidos</a>
			<a href="Clientes.php" class="Clientes" onclick="abrirCabecera('Clientes')">Clientes</a>
			<a href="#" class="Productos" onclick="abrirCabecera('Productos')" id="defaultOpen">Productos</a>
			<a href="Categorias.php" class="Categorias" onclick="abrirCabecera('Categorias')">Categorías</a>

		  	<a class="iniciobtn" style="cursor: pointer;" href="php/Cerrar_Sesion.php">Cerrar sesión</a>
		  	<a href="javascript:void(0);" class="icon" onclick="responsiveNav()">&#9776;</a>
		</div>
	</nav>

	<section class="bg">
		<div class="content">
		  	<h2 id="Cabecera">Lista de productos</h2>
				<div class="contBoton">
					<button type="button" id="btnAgregar" onclick="location ='AgregarProducto.php'">Agregar</button>
				</div>
        <div id="tablaProductos">
          <table id="tProductos">
            <thead>
              <tr>
								<th>No. </th>
								<th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
								<th>Estado</th>
								<th>Categoría</th>
								<th>Acción</th>
              </tr>
            </thead>
            <tbody>
							<?php
		            include("php/Productos.php");
		            $con = new Producto();
								$con->recuperarDatos();
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
