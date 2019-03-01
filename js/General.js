/*************************************************
 * UNIVERSIDAD POLITÉCNICA DEL ESTADO DE MORELOS *
 *               PROYECTO ESTANCIA II            *
 *------------------INTEGRANTES------------------*
 *           ESQUIVEL MARTÍNEZ ESTEBAN           *
 *           FLORES GARCÍA LUIS ANTONIO          *
 *************************************************/
function inicioVentana(){
  document.getElementById("defaultOpen").click();
}

 function responsiveNav() {
     var x = document.getElementById("responsiveNav");
     if (x.className === "topnav") {
         x.className += " responsive";
     } else {
         x.className = "topnav";
     }
 }

 function saldarFactura(idVenta){ //Pregunta si se quiere saldar la factura
 	if(confirm('¿Deseas saldar esta factura?'))
 		location.href='./php/CubrirFactura.php?no='+idVenta; //Envia al archivo el cual realizara el proceso con sentencia SQL
 }


 function confirmar(idProducto, idCategoria) { //Pregunta si se quiere eliminar un producto
 	if(confirm('¿Estas seguro que desea eliminar el registro?'))
 		location.href='./php/EliminarProducto.php?no='+idProducto+'&cat='+idCategoria;
 }


 function eliminarMenu(idMenu){ //Pregunta si se quiere eliminar un menu
 	if(confirm('¿Deseas eliminar el producto del menu?'))
 		location.href='./php/EliminarMenu.php?no='+idMenu;
 }


 function eliminarPedido(idVenta){ //Pregunra si se quiere eliminar un pedido
 	if(confirm('¿Deseas cancelar el pedido?'))
 		location.href='./php/cancelarPedido.php?no='+idVenta;
 }

 function abrirCabecera(elementName) {

     var i, tabcontent;
     tabcontent = document.getElementsByClassName("cabcontenido");
     for (i = 0; i < tabcontent.length; i++) {
         tabcontent[i].style.display = "none";
     }

     document.getElementById(elementName).style.display = "block";

 }
