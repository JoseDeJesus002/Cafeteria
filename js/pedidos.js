 let productos = JSON.parse(localStorage.getItem('productos'));
let listaCompra = document.getElementById('lista-compra');
let total = document.getElementById('total');
let totalCompra = 0;
let tbody = document.querySelector('#lista-compra tbody');
tbody.innerHTML = '';
for (let i = 0; i < productos.length; i++) {
    let fila = tbody.insertRow(i);
    let imagen = fila.insertCell(0);
    let nombre = fila.insertCell(1);
    let precio = fila.insertCell(2);
    let cantidad = fila.insertCell(3);
    let eliminar = fila.insertCell(4);
    imagen.innerHTML = `<img src="${productos[i].imagen}" width="100">`;
    nombre.innerHTML = productos[i].nombre;
    precio.innerHTML = productos[i].precio;
    //modificar cantidad de un solo producto con un input type number
    cantidad.innerHTML = `<input type="number" class="form-control cantidad" min="1" value="${productos[i].cantidad}">`;
    eliminar.innerHTML = `<button class="btn btn-danger eliminar" data-id="${productos[i].id}">Eliminar</button>`;
    totalCompra = totalCompra + (productos[i].precio * productos[i].cantidad);
}
document.getElementById('total').innerHTML = '$' + totalCompra;
//eliminar un producto del carrito
let botonesEliminar = document.getElementsByClassName('eliminar');
for (let i = 0; i < botonesEliminar.length; i++) {
    botonesEliminar[i].addEventListener('click', function () {
        let id = this.getAttribute('data-id');
        let productos = JSON.parse(localStorage.getItem('productos'));
        for (let i = 0; i < productos.length; i++) {
            if (productos[i].id == id) {
                productos.splice(i, 1);
            }
        }
        localStorage.setItem('productos', JSON.stringify(productos));
        location.reload();
    })
}
//vaciar carrito
let vaciarCarrito = document.getElementById('vaciar-carrito');
vaciarCarrito.addEventListener('click', function () {
    localStorage.clear();
    location.reload();
})
//modificar cantidad de un solo producto
let inputCantidad = document.getElementsByClassName('cantidad');
for (let i = 0; i < inputCantidad.length; i++) {
    inputCantidad[i].addEventListener('change', function () {
        let cantidad = parseInt(this.value);
        let id = this.parentElement.parentElement.children[4].children[0].getAttribute('data-id');
        let productos = JSON.parse(localStorage.getItem('productos'));
        for (let i = 0; i < productos.length; i++) {
            if (productos[i].id == id) {
                productos[i].cantidad = cantidad;
                totalCompra = totalCompra + (productos[i].precio * productos[i].cantidad);
            }
        }
        localStorage.setItem('productos', JSON.stringify(productos));
        location.reload();
    })
}
//realizar compra
/* let realizarCompra = document.getElementById('comprar');
realizarCompra.addEventListener('click', function () {
    window.alert('Compra realizada con éxito');
    localStorage.clear();
    location.reload();
}) */

function comprar(){
    alert("Compra realizada con éxito");
    localStorage.clear();
    location.reload();
}


