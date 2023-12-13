// let loadMoreButtons = document.querySelectorAll(".load-more");
// let currentItem = 8;

// loadMoreButtons.forEach((button) => {
//     button.addEventListener("click", () => {
//         let boxes = document.querySelectorAll(".box-container .box");
//         for (let i = currentItem; i < currentItem + 4; i++) {
//             if (boxes[i]) {
//                 boxes[i].style.display = "inline-block";
//             }
//         }
//         currentItem += 4;
//         if (currentItem >= boxes.length) {
//             button.style.display = "none";
//         }
//     });
// });

document.addEventListener("DOMContentLoaded", () => {
    const lista = document.querySelector(".lista-carrito");
    const vaciarCarritoButton = document.getElementById("vaciar-carrito");
    const numeroProductos = document.getElementById("numero-productos");
    let data = getStorageCarrito() || [];

    if (data.length > 0) {
        renderizarCarrito();
    }

    function renderizarCarrito() {
        // actualizar contador carrito numeros * cantidad
        numeroProductos.textContent = data.reduce(
            (total, elemento) => total + elemento.cantidad,
            0
        );
        lista.innerHTML = "";
        data.forEach((elemento) => {
            const itemCarrito = crearItemCarrito(elemento);
            lista.appendChild(itemCarrito);
        });

        actualizarTotal();
        setHiddenInput("productos");
        enableCheckout();

        const resumenPedido = document.getElementById("lista-pedido");
        if (resumenPedido) {
            if (data.length === 0) {
                resumenPedido.innerHTML = `
                    <tr>
                        <td colspan="5">No hay productos en el carrito</td>
                    </tr>
                `;
                return;
            }
            resumenPedido.innerHTML = "";
            data.forEach((elemento) => {
                const itemPedido = crearItemPedido(elemento);
                resumenPedido.appendChild(itemPedido);
            });
            actualizarResumenPedido();
            setHiddenInput("productos-pedido");
        }
    }

    function crearItemPedido(elemento) {
        const itemPedido = document.createElement("tr");
        itemPedido.dataset.id = elemento.id;

        itemPedido.innerHTML = `
            <td><img src="${elemento.imagen}" alt="" style="width: 100px; height: 100px;"></td>
            <td>${elemento.titulo}</td>
            <td>
                <div class="cantidad-btn" data-id="${elemento.id}">
                    <a href="#" class="minus-button"><i class="fa-solid fa-minus" style="color: #038de9"></i></a>
                    <p class="cantidad">${elemento.cantidad}</p>
                    <a href="#" class="plus-button"><i class="fa-solid fa-plus" style="color: #038de9"></i></a>
                </div>
            </td>
            <td>${elemento.precio}</td>
            <td><a href="#" class="delete-button" data-id="${elemento.id}"><i class="fa-solid fa-trash" style="color: #038de9"></i></a></td>
        `;

        return itemPedido;
    }

    function actualizarResumenPedido() {
        const datosPago = document.querySelector(".resumen-pedido__container");
        let subtotal = calcularTotal();
        let envio = calcularEnvio(subtotal);
        let mensaje =
            subtotal > 50000
                ? "Envío gratuito por compras mayores a $50000"
                : "Te faltan $" +
                  (50000 - subtotal) +
                  " para que el envío sea gratis";
        datosPago.innerHTML = `
            <div class="resumen-pedido__item">
                <p>Subtotal</p>
                <p>$${subtotal}</p>
            </div>
            <div class="resumen-pedido__item">
                <p>Envío</p>
                <p>$${envio}</p>
            </div>
            <div class="resumen-pedido__item">
                <p>Total</p>
                <p>$${subtotal + envio}</p>
            </div>
            <div class="resumen-pedido__tip">
                <p>${mensaje}</p>
            </div>
        `;
    }

    function calcularEnvio(subtotal) {
        return subtotal > 50000 ? 0 : 5000;
    }

    function crearItemCarrito(elemento) {
        const itemCarrito = document.createElement("div");
        itemCarrito.classList.add("lista-carrito__item");
        itemCarrito.dataset.id = elemento.id;

        itemCarrito.innerHTML = `
            <div class="lista-carrito__img">
                <img src="${elemento.imagen}" alt="">
            </div>
            <div class="lista-carrito__detalles">
                <h4>${elemento.titulo}</h4>
                <p>$${elemento.precio}</p>
            </div>
            <div class="lista-carrito__botones">
                <a href="#" class="delete-button"><i class="fa-solid fa-trash" style="color: #038de9"></i></a>
                <div class="quantity">
                    <a href="#" class="minus-button"><i class="fa-solid fa-minus" style="color: #038de9"></i></a>
                    <p class='cantidad'>${elemento.cantidad}</p>
                    <a href="#" class="plus-button"><i class="fa-solid fa-plus" style="color: #038de9"></i></a>
                </div>
            </div>
        `;

        return itemCarrito;
    }

    function actualizarTotal() {
        const total = document.querySelector("#total");
        total.textContent = "Total: $" + calcularTotal().toFixed(2);
    }

    function calcularTotal() {
        return data.reduce(
            (total, elemento) =>
                total + parseFloat(elemento.precio) * elemento.cantidad,
            0
        );
    }

    function cargarEventListeners() {
        document.body.addEventListener("click", (e) => {
            if (e.target.classList.contains("agregar-carrito")) {
                e.preventDefault();
                const elemento = e.target.closest(".box");
                leerDatosElemento(elemento);
            }
            if (e.target.parentElement.classList.contains("delete-button")) {
                console.log("entra");
                e.preventDefault();
                eliminarElemento(e);
            }
            if (e.target.parentElement.classList.contains("minus-button")) {
                e.preventDefault();
                modificarCantidad(e);
            }
            if (e.target.parentElement.classList.contains("plus-button")) {
                e.preventDefault();
                modificarCantidad(e);
            }
        });

        vaciarCarritoButton.addEventListener("click", vaciarCarrito);
    }

    function leerDatosElemento(elemento) {
        const infoElemento = {
            imagen: elemento.querySelector("img").src,
            titulo: elemento.querySelector("h3").textContent,
            precio: elemento.querySelector(".precio").textContent,
            id: elemento.querySelector("a").getAttribute("data-id"),
            cantidad: 1,
        };

        const productoExistente = data.find((x) => x.id === infoElemento.id);

        if (productoExistente) {
            if (productoExistente.cantidad >= 10) {
                alert("No puedes agregar más de 10 unidades de un producto.");
                return;
            } else {
                productoExistente.cantidad++;
                volarAlCarrito(elemento);
            }
        } else {
            data.push(infoElemento);
            volarAlCarrito(elemento);
        }

        renderizarCarrito();
        storageCarrito();
    }

    function modificarCantidad(e) {
        const elemento = e.target.closest(
            ".lista-carrito__item, .cantidad-btn"
        );

        if (elemento) {
            const id = elemento.getAttribute("data-id");
            const productoExistente = data.find((x) => x.id === id);

            if (productoExistente) {
                const nuevaCantidad =
                    productoExistente.cantidad +
                    (e.target.parentElement.classList.contains("plus-button")
                        ? 1
                        : -1);

                if (nuevaCantidad < 1 || nuevaCantidad > 10) {
                    alert("La cantidad debe estar entre 1 y 10.");
                    return;
                }

                productoExistente.cantidad = nuevaCantidad;
                renderizarCarrito();
                storageCarrito();
                let carrito = document.getElementById("numero-productos");
                carrito.style.cssText = `
                    transform: scale(1.2);
                `;
                setTimeout(() => {
                    carrito.style.cssText = `
                        transform: scale(1);
                    `;
                }, 300);
            }
        }
    }

    function eliminarElemento(e) {
        let elemento = e.target.closest(".lista-carrito__item");

        if (!elemento) {
            elemento = e.target.closest(".delete-button");
        }
        console.log(elemento);
        const id = elemento.dataset.id;

        data = data.filter((elemento) => elemento.id !== id);

        renderizarCarrito();
        storageCarrito();
    }

    function vaciarCarrito() {
        data = [];
        renderizarCarrito();
        storageCarrito();
        enableCheckout();
        animateVaciarCarrito();
    }

    function animateVaciarCarrito() {
        const carrito = document.getElementById("numero-productos");
        carrito.style.cssText = `
            transform: scale(1.2);
            transition: all .3s ease;
            background-color: #9bce21;
        `;
        setTimeout(() => {
            carrito.style.cssText = `
                transform: scale(1);
                transition: all .3s ease;
                background-color: #ff9941;
            `;
        }, 300);
    }

    function enableCheckout() {
        if (data.length > 0) {
            document.getElementById("checkout").disabled = false;
        } else {
            document.getElementById("checkout").disabled = true;
        }
    }

    function setHiddenInput(id) {
        let input = document.getElementById(id);
        input.value = JSON.stringify(data);
    }

    function storageCarrito() {
        localStorage.setItem("carrito", JSON.stringify(data));
    }

    function getStorageCarrito() {
        return JSON.parse(localStorage.getItem("carrito")) || [];
    }

    // animacion producto vuela al carrito
    function volarAlCarrito(elemento) {
        const carrito = document.getElementById("numero-productos");
        const producto = elemento.querySelector("a");

        const span = document.createElement("span");
        span.classList.add("volar-carrito");

        const checkIcon = document.createElement("i");
        checkIcon.classList.add("fas", "fa-check");

        span.appendChild(checkIcon);

        const productoRect = producto.getBoundingClientRect();
        const carritoRect = carrito.getBoundingClientRect();

        span.style.cssText = `
            left: ${productoRect.left + window.scrollX}px;
            top: ${productoRect.top + window.scrollY}px;
        `;

        const deltaX =
            carritoRect.left +
            window.scrollX -
            (productoRect.left + window.scrollX);
        const deltaY =
            carritoRect.top +
            window.scrollY -
            (productoRect.top + window.scrollY);

        document.body.appendChild(span);

        TweenMax.to(span, 1, {
            x: deltaX,
            y: deltaY,
            onComplete: () => {
                // voltear span

                span.remove();
                carrito.style.cssText = `
                    transform: rotateY(180deg) scale(1.2);
                    transition: all .3s ease;
                    background-color: #9bce21;
                `;
                setTimeout(() => {
                    carrito.style.cssText = `
                        transform: rotateY(360deg) scale(1);
                        transition: all .3s ease;
                        background-color: #ff9941;
                    `;
                }, 300);
            },
        });
    }

    cargarEventListeners();
});
