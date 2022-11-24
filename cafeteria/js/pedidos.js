    let tbody = document.querySelector('#lista-compra tbody');
    let productosLS = obtenerProductosLocalStorage();
    let subtotal = document.querySelector('#subtotal');
    let iva = document.querySelector('#iva');
    let total = document.querySelector('#total');
    let totalCompra = 0;
    let totalIva = 0;
    let totalSubtotal = 0;

    productosLS.forEach(function(producto){
        let fila = document.createElement('tr');
        fila.innerHTML = `
            <td>
                <img src="${producto.imagen}" width="100">
            </td>
            <td>${producto.nombre}</td>
            <td>${producto.precio}</td>
            <td>${producto.cantidad}</td>
            <td>${producto.precio * producto.cantidad}</td>
            <td>
                <a href="#" class="borrar-producto" data-id="${producto.id}">X</a>
            </td>
        `;
        tbody.appendChild(fila);
        totalSubtotal = totalSubtotal + (producto.precio * producto.cantidad);
        totalIva = totalSubtotal * 0.16;
        totalCompra = totalSubtotal + totalIva;
    });
    subtotal.innerHTML = totalSubtotal;
    iva.innerHTML = totalIva;
    total.innerHTML = totalCompra;

    //obtener productos del local storage
    function obtenerProductosLocalStorage(){
        let productoLS;
        if(localStorage.getItem('productos') === null){
            productoLS = [];
        }else{
            productoLS = JSON.parse(localStorage.getItem('productos'));
        }
        return productoLS;
    }
    //vaciar carrito
    let vaciarCarrito = document.querySelector('#vaciarcarrito');
    vaciarCarrito.addEventListener('click', function(e){
        e.preventDefault();
        localStorage.clear();
        location.reload();
    });
    