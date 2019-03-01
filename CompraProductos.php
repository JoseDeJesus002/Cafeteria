<?php
  session_start(); //Si hay una sesión activa mediante inicio de sesión, la activa
  include("php/conexion.php");
  $con = conectar();
  $usuario = $_SESSION['session_username'];
  $query="SELECT idCliente FROM cliente, usuario WHERE nombreUsuario='".$usuario."' and idUsuario=Usuario_idUsuario"; //Consulta del ID del cliente perteneciente al usuario activo
  $result = $con->query($query);
  $fila=$result->fetch_assoc();
  $Cliente=$fila['idCliente'];
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
					<?php
            include("php/formProductos.php");
            $form = new formProductos($Cliente,$con);
            $form->llenarForm();
          ?>
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
