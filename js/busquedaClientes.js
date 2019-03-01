/*************************************************
 * UNIVERSIDAD POLITÉCNICA DEL ESTADO DE MORELOS *
 *               PROYECTO ESTANCIA II            *
 *------------------INTEGRANTES------------------*
 *           ESQUIVEL MARTÍNEZ ESTEBAN           *
 *           FLORES GARCÍA LUIS ANTONIO          *
 *************************************************/
$(buscarDatos());

function buscarDatos(consulta){
  $.ajax({
    url: './php/buscarFacturas.php', //Funcion que contiene las querys para la busqueda
    type: 'POST', //Envia datos mediante metodo POST
    dataType: 'html', //Asigna el tipo de dato
    data: {consulta: consulta},
  })
  .done(function(respuesta) { //Si se ingreso algun dato lo asigna al contenedor en forma de tabla (table)
    $("#datos").html(respuesta);
  })
  .fail(function() {
    console.log("error");
  })
}

$(document).on('keyup','#cajaBusqueda', function(){ //Ejecuta la funcion de buscar cada que se ingrese algun texto en el input
  var valor = $(this).val();
  if(valor != ""){
    buscarDatos(valor); //Envia el valor ingresado
  }else{
    buscarDatos(); //Envia el valor como nulo ya que no se ingreso nada
  }
});
