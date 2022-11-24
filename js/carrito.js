const cards = document.querySelectorAll('.card');
cards.forEach((card) => {
card.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn')) {
        const producto = {
            id: card.querySelector('a').getAttribute('id'),
            imagen: card.querySelector('img').src,
            nombre: card.querySelector('h4').textContent,
            precio: card.querySelector('.btn').textContent,
            cantidad: 1
        }
        let productos;
        productos = obtenerProductosLocalStorage();
        productos.forEach((productoLS, index) => {
            if (productoLS.nombre === producto.nombre) {
                productos[index].cantidad++;
                productoLS.cantidad = productos[index].cantidad;
            }
        }); 
        productos.push(producto);
        localStorage.setItem('productos', JSON.stringify(productos));
    }
});
});

//obtener los productos del localstorange
function obtenerProductosLocalStorage() {
let productoLS;
//comprobamos si hay algo en localstorange
if (localStorage.getItem('productos') === null) {
    productoLS = [];
} else {
    productoLS = JSON.parse(localStorage.getItem('productos'));
}
return productoLS;
}
//eliminar producto del carrito en el dom
function eliminarProducto(e) {
e.preventDefault();
let producto, productoID;

if (e.target.classList.contains('borrar-producto')) {
    e.target.parentElement.parentElement.remove();
    producto = e.target.parentElement.parentElement;
    productoID = producto.querySelector('a').getAttribute('id');
}
eliminarProductoLocalStorage(productoID);
}
//eliminar el producto por el id en localstorange
function eliminarProductoLocalStorage(producto) {
let productosLS;
//obtenemos el arreglo de productos
productosLS = obtenerProductosLocalStorage();
//iteramos comparando el id del producto borrado con los del localstorange
productosLS.forEach((productoLS, index) => {
    if (productoLS.id === producto) {
        productosLS.splice(index, 1);
    }
});
//añadimos el arreglo actual a storage
localStorage.setItem('productos', JSON.stringify(productosLS));
}