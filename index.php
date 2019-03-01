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
	<link rel="stylesheet" type="text/css" href="css/Principal.css">
	<script type="text/javascript" src="js/Principal.js"></script>
</head>
<body onload="start();">
	<!--Se asigna el contenedor que contendra la animación-->
	<?php if(isset($_SESSION['session_username'])): ?>
		<div class="cont" id="cont">
			<div class="preloader">
				<p>Cargando</p>
			</div>
		</div>
		<script type="text/javascript" src="js/cerrar.js"></script> <!--Se ejecuta el script-->
	<?php endif; ?>
	<!--Barra de Navegación (Se generan las cabeceras, y los botones de la barra)-->
	<nav>
		<div id="Nosotros" class="cabcontenido">
		  <h3>Nosotros</h3>
		</div>

		<div id="Menu" class="cabcontenido">
		  <h3>Menú</h3>
		</div>

		<div id="Nutricion" class="cabcontenido">
		  <h3>Nutrición</h3>
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
		  	<a href="#" class="Nosotros" onclick="abrirCabecera('Nosotros')" id="defaultOpen">Nosotros</a>
		  	<a href="MenuCliente.php" class="Menu" onclick="abrirCabecera('Menu')">Menú</a>
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
		<!--Generación de ventana emergente para el Inicio de Sesión-->
		<div id="id01" class="modal">
		  	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" style="color: red;">&times;</span>
		  	<form class="modal-content animate" action="php/Inicio_Sesion.php" method="POST"><!--Llamado a funcionalidad externa de Inicio de Sesión-->
		    	<div class="imgcontainer">
		      		<img src="css/Imagenes/user.png" alt="Avatar" class="avatar">
		    	</div>

		    	<div class="container">
		      		<label><b>Usuario</b></label>
					<input type="text" placeholder="Ingresar Usuario" name="uname" id="uname" required>

				 	<label><b>Contraseña</b></label>
				  	<input type="password" placeholder="Ingresar Contraseña" name="upsw" id="upsw" required>

				  	<button type="submit" class="enterbtn" id="login" name="login">Acceder</button>
				  	<input type="checkbox" checked="checked" required="false"> Recuerdame
	    		</div>

		    	<div class="container" style="background-color:#f1f1f1">
		      		<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
		    	</div>
		  	</form>
		</div>
		<!--Generación de Venta Emergente de Registro-->
		<div id="id02" class="modal">
		  	<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal" style="color: red;">&times;</span>
		  	<form class="modal-content animate" action="PHP/Registro_Cliente.php" method="POST"> <!--Llamado a funcionalidad externa de Registro-->
			    <div class="container">
		      		<h3>Datos de Cuenta</h3>

		      		<label><b>Nombre de Usuario</b></label>
			      	<input type="text" placeholder="Ingresa nombre de usuario" name="user" id="user" required>

			      	<label><b>Contraseña</b></label>
			      	<input type="password" placeholder="Ingresa contraseña" name="psw" id="psw" required>

			      	<label><b>Volver a Ingresar Contraseña</b></label>
			      	<input type="password" placeholder="Vuelve a ingresar la contraseña" name="pswR" id="pswR" onblur="passwords();" required>

			      	<!--Se define que tipo de usuario sera, en base a ello se habilitan/deshabilitan ciertos inputs-->
			      	<label><b>Tipo de Usuario</b></label><br>
			      	<select id="combobox" onchange="showSecurity();">
			      		<option value="cliente" id="cliente">Cliente</option>
			      		<option value="empleado" id="empleado">Empleado</option>
			      	</select>

			      	<label style="visibility: hidden;" id="cargo"><b>Cargo</b></label>
			      	<input id="cargoE" type="text" placeholder="Cocinero" name="cargoE" style="visibility: hidden;">

			      	<!--Se implementa como método de seguridad para prevenir que cualquier usuario se registre como empleado-->
			      	<label style="visibility: hidden;" id="codigoS"><b>Código de Seguridad</b></label>
			      	<input id="inputCS" type="text" placeholder="Ingresar código de seguridad" name="inputCS" onblur="codigoSeguridad();" style="visibility: hidden;">

			      	<hr>

			      	<h3>Información Personal</h3>

			      	<label><b>Nombre(s)</b></label>
			      	<input type="text" placeholder="Luis Antonio" name="nombre" id="nombre" required>

			      	<label><b>Apellido Paterno</b></label>
			      	<input type="text" placeholder="Flores" name="apellidoP" id="apellidoP" required>

			      	<label><b>Apellido Materno</b></label>
			      	<input type="text" placeholder="García" name="apellidoM" id="apellidoM" required>

			      	<label><b>Fecha de Nacimiento</b></label>
			      	<input type="date" name="fecha" id="fecha" required>

			      	<label><b>Sexo</b></label><br>
			      	<input type="radio" name="genero" value="M" id="sexoM"> Masculino
			      	<input type="radio" name="genero" value="F" id="sexoF"> Femenino <br>

			      	<label><b>Correo Electrónico</b></label>
			      	<input type="email" placeholder="ejemplo@gmail.com" name="email" id="email" required>

			      	<label><b>Telefono</b></label>
			      	<input type="text" placeholder="7773349431" name="telefono" id="telefono" required>
			      	<p>Al crear una cuenta aceptas nuestros <a href="#">Términos & Condiciones</a>.</p>

			      	<div class="clearfix">
			        	<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn2">Cancelar</button>
			        	<button type="submit" class="signupbtn" id="registro" name="registro">Registrarse</button>

			      	</div>
			    </div>
		  	</form>
		</div>
	</nav>

	<!--Información referente a la empresa-->
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
