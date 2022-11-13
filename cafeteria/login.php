<?php 
?>
 


<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Login y Register</title>
    
    <link href="css/style_login.css" rel="stylesheet" />

</head>
<body>

        <main>

            <div class='contenedor__todo'>
                <div class='caja__trasera'>
                    <div class='caja__trasera-login'>
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id='btn__iniciar-sesion'>Iniciar Sesión</button>
                    </div>
                    <div class='caja__trasera-register'>
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button id='btn__registrarse'>Regístrarse</button>
                    </div>
                </div>
               <div class='contain_image'>
                    
                </div>
                <!--Formulario de Login y registro-->
                <div class='contenedor__login-register'>
                    <!--Login-->
                    <form id='formulario_login' name='formulario_login' class='formulario__login'>
                        <h2>Iniciar Sesión</h2>
                        <input id='correo' name='correo' type='email' placeholder='Correo institucional'>
                        <input id='contrasena' name='contrasena' type='password' placeholder='Contraseña'>
                        <center><button onclick='llenar_formulario(1)'>Entrar</button></center>
                        <p align='center'><img src="assets/images/teca_logo.png" height="200" width="200" /></p>
                    </form>

                    <!--Register-->
                    <form id='formulario_registro' name='formulario_registro' class='formulario__register'>
                        <h2>Regístrarse</h2>

                        <label for='ocupacion'>Selecciona una opción:</label><br>
                        <select name='ocupacion' id='ocupacion' onchange="cambiarFormulario()">
                            <option value='alumno'>Alumno</option> 
                            <option value='docente'>Docente</option> 
                            <option value='trabajador'>Trabajador</option> 

                        <input id='nombre' name='nombre' type='text' placeholder='Nombre'>
                        <input id='apellido_paterno' name='apellido_paterno' type='text' placeholder='Apellido Paterno'>
                        <input id='apellido_materno' name='apellido_materno' type='text' placeholder='Apellido Materno'>
                        <br>
                        <br>
                        <label for='carrera'>Selecciona una opción:</label><br>
                        <select name='carrera' id='carrera'>
                            <option value='1'>Ingeniería de Software</option> 
                            <option value='2'>Negocios Internacionales</option>
                            <option value='3'>Ingenieria Financiera</option>
                            <option value='4'>Ingenieria Mecanica Automotriz</option> 
                            <option value='5'>Ingenieria en Tecnologias de Manufactura</option>
                        </select>
                        <input id='matricula' name='matricula' type='text' placeholder='Matricula'>
                        <input id='correo' name='correo' type='email' placeholder='Correo institucional'>
                        <input id='contrasena' name='contrasena' type='password' placeholder='Contraseña'>
                        <center><button id='boton_registro' name='boton_registro' onclick='llenar_formulario(2)'>Regístrarse</button></center>
                        
<br/>
                    </form>
                </div>
            </div>

        </main>

        <script src='assets/js/script.js'></script>
        <script type='text/javascript' src='./js/jquery-3.6.1.min.js'></script>
        <script>
            function llenar_formulario(opcion){
                    document.getElementById("formulario_login").addEventListener("click", function(event){
                        event.preventDefault()
                    });
                    var url = "";
                    console.log('Si entré')
                    console.log('opcion:' + opcion)
                    var formulario = ''
                    if(opcion==1){
                        formulario = $('#formulario_login').serialize()
                        url = './procesarDatosLogin.php';
                    }else{
                        formulario = $('#formulario_registro').serialize()
                        url = './procesarDatosRegistro.php';
                    }
                    $.ajax({                        
                    type: 'POST',                 
                    url: url,                     
                    data: formulario, 
                    success: function(data){
                        alert(data)
                        window.location.replace("./carro%20de%20super/carrito.html");              
                    }
                });
            };
        </script>
        <script>
            function cambiarFormulario(){
                alert($('#ocupacion').val());
                switch($('#ocupacion').val()){
                    case 'alumno':
                        $('#formulario_registro').html("<h2>Regístrarse</h2> <label for='ocupacion'>Selecciona una opción:</label><br> <select name='ocupacion' id='ocupacion' onchange='cambiarFormulario()'> <option value='alumno'>Alumno</option> <option value='docente'>Docente</option> <option value='trabajador'>Trabajador</option> <input id='nombre' name='nombre' type='text' placeholder='Nombre'> <input id='apellido_paterno' name='apellido_paterno' type='text' placeholder='Apellido Paterno'> <input id='apellido_materno' name='apellido_materno' type='text' placeholder='Apellido Materno'> <br> <br> <label for='carrera'>Selecciona una opción:</label><br> <select name='carrera' id='carrera'> <option value='ingenieria de Software'>Ingeniería de Software</option> <option value='negocios Internacionales'>Negocios Internacionales</option> <option value='ingenieria Financiera'>Ingenieria Financiera</option> <option value='ingenieria Mecanica Automotriz'>Ingenieria Mecanica Automotriz</option> <option value='ingenieria en Tecnologias de Manufactura'>Ingenieria en Tecnologias de Manufactura</option> </select> <input id='matricula' name='matricula' type='text' placeholder='Matricula'> <input id='correo' name='correo' type='email' placeholder='Correo institucional'> <input id='contrasena' name='contrasena' type='password' placeholder='Contraseña'> <center><button id='boton_registro' name='boton_registro' onclick='llenar_formulario(2)'>Regístrarse</button></center>")
                        break;
                    case 'docente':
                        $('#formulario_registro').html("<h2>Regístrarse</h2> <label for='ocupacion'>Selecciona una opción:</label><br> <select name='ocupacion' id='ocupacion' onchange='cambiarFormulario()'> <option value='docente'>Docente</option> <option value='trabajador'>Trabajador</option> <option value='alumno'>Alumno</option> <input id='nombre' name='nombre' type='text' placeholder='Nombre'> <input id='apellido_paterno' name='apellido_paterno' type='text' placeholder='Apellido Paterno'> <input id='apellido_materno' name='apellido_materno' type='text' placeholder='Apellido Materno'> <input id='issemym' name='issemym' type='text' placeholder='Clave ISSEMYM'> <input id='correo' name='correo' type='email' placeholder='Correo institucional'> <input id='contrasena' name='contrasena' type='password' placeholder='Contraseña'> <center><button id='boton_registro' name='boton_registro' onclick='llenar_formulario(2)'>Regístrarse</button></center>")
                        break;
                    case 'trabajador':
                        $('#formulario_registro').html("<h2>Regístrarse</h2> <label for='ocupacion'>Selecciona una opción:</label><br> <select name='ocupacion' id='ocupacion' onchange='cambiarFormulario()'> <option value='trabajador'>Trabajador</option> <option value='alumno'>Alumno</option> <option value='docente'>Docente</option> <input id='nombre' name='nombre' type='text' placeholder='Nombre'> <input id='apellido_paterno' name='apellido_paterno' type='text' placeholder='Apellido Paterno'> <input id='apellido_materno' name='apellido_materno' type='text' placeholder='Apellido Materno'> <input id='curp' name='curp' type='text' placeholder='Curp'> <input id='correo' name='correo' type='email' placeholder='Correo institucional'> <input id='contrasena' name='contrasena' type='password' placeholder='Contraseña'> <center><button id='boton_registro' name='boton_registro' onclick='llenar_formulario(2)'>Regístrarse</button></center>")
                        break;
                }
            };
        </script>
</body>
</html>

