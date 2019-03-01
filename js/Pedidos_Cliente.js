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

function mensajeModificar(){
    alert("No se puede modificar un producto ya preparado");
}

function mensajeEliminar(){
    alert("No se puede eliminar un producto ya preparado y no pagado");
}

function confirmarPedido(idVenta){
  if(confirm('¿Estas seguro que deseas cancelar la compra?'))
 		location.href='./php/Eliminar_Venta.php?id='+idVenta;
}
