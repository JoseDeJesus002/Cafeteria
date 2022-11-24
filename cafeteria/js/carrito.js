            const btns = document.querySelectorAll(".btn");
            btns.forEach(btn => {
                btn.addEventListener("click", function(e){
                    e.preventDefault();
                    let producto = e.target.parentElement.parentElement;
                    let nombre = producto.querySelector("h4").textContent;
                    let precio = producto.querySelector("a").textContent;
                    let imagen = producto.querySelector("img").src;
                    let productoAgregado = {
                        nombre,
                        precio,
                        imagen,
                        cantidad: 1
                    }
                    if(localStorage.getItem("productos") === null){
                        let productos = [];
                        productos.push(productoAgregado);
                        localStorage.setItem("productos", JSON.stringify(productos));
                    }else{
                        let productosLS = JSON.parse(localStorage.getItem("productos"));
                        productosLS.forEach(function(productoLS){
                            if(productoLS.nombre === productoAgregado.nombre){
                                productoLS.cantidad += 1;
                                productoAgregado = productoLS;
                            }
                        });
                        productosLS.push(productoAgregado);
                        localStorage.setItem("productos", JSON.stringify(productosLS));
                    }
                });
            });

        let vaciarCarrito = document.querySelector('#vaciarcarrito');
        vaciarCarrito.addEventListener('click', function(e){
        e.preventDefault();
        localStorage.clear();
        location.reload();
    });
    