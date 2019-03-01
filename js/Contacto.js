var codigo = "primaria"; //Código de seguridad para el registro de empleados


//Función principal
function start(){
    document.getElementById("defaultOpen").click(); //Permite la funcionalidad de las cabeceras

	inicioVentana();
	registroVentana();

}


//Controla la ventana de emergente de inicio de sesión
function inicioVentana(){
    var modal = document.getElementById('id01');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

//Controla la ventana de emergente de registro
function registroVentana(){
    var modal2 = document.getElementById('id02');

    window.onclick = function(event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
}

//Controla el comportamiento de la barra de navegación según el tamaño de la ventana
function responsiveNav() {
    var x = document.getElementById("responsiveNav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

//Muestra la cabecera correspondiente a cada opción de la barra de navegación
function abrirCabecera(elementName) {

    var i, tabcontent;
    tabcontent = document.getElementsByClassName("cabcontenido");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    document.getElementById(elementName).style.display = "block";

}

//Función que controla que inputs serán vistas por el usuario dependiendo del tipo de usuario que seleccionen
function showSecurity(){

    var combo = document.getElementById("combobox").value;
    var label = document.getElementById("codigoS");
    var input = document.getElementById("inputCS");
    var cargo = document.getElementById("cargo");
    var cargoE = document.getElementById("cargoE");

    if(combo == "empleado"){

        label.style.visibility = "visible";
        input.style.visibility = "visible";
        cargo.style.visibility = "visible";
        cargoE.style.visibility = "visible";

        label.required = true;
        input.required = true;
        cargo.required = true;
        cargoE.required = true;

    }else{

        label.style.visibility = "hidden";
        input.style.visibility = "hidden";
        cargo.style.visibility = "hidden";
        cargoE.style.visibility = "hidden";

        label.required = false;
        input.required = false;
        cargo.required = false;
        cargoE.required = false;

        document.getElementById("inputCS").value = "";
        document.getElementById("cargoE").value = "";

        document.getElementById("registro").disabled = false;

    }

}

//Verificación de que ambas contraseñas ingresadas en el registro sean iguales
function passwords(){

    var pass = document.getElementById("psw").value;
    var passR = document.getElementById("pswR").value;

    if (pass != passR) {

        alert("Las contraseñas no son iguales.");
        document.getElementById("pswR").value = "";

    }

}

//Validación de que el código ingresado por el usuario sea igual al código establecido
function codigoSeguridad(){

    var CS = document.getElementById("inputCS").value;

    if (CS != codigo) {
        alert("El código de seguridad no es valido, el botón de registro sera desactivado hasta que ingrese el código correcto o cambie de tipo de usuario.")
        document.getElementById("registro").disabled = true; //Si el código no es igual se desactiva el botón de registro
    }else{
        document.getElementById("registro").disabled = false;
    }

}