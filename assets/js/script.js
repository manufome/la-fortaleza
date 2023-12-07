let loadMoreButtons = document.querySelectorAll(".load-more");
let currentItem = 8;

loadMoreButtons.forEach((button) => {
    button.addEventListener("click", () => {
        let boxes = document.querySelectorAll(".box-container .box");
        for (let i = currentItem; i < currentItem + 4; i++) {
            if (boxes[i]) {
                boxes[i].style.display = "inline-block";
            }
        }
        currentItem += 4;
        if (currentItem >= boxes.length) {
            button.style.display = "none";
        }
    });
});

const carrito = document.getElementById("carrito");
const lista = document.querySelector("#lista-carrito tbody");
const vaciarCarritoButton = document.getElementById("vaciar-carrito");
let data = [];

//add listener to add product list valu of hidden input #

cargarEventListeners();

function cargarEventListeners() {
    document.body.addEventListener("click", function (e) {
        if (e.target.classList.contains("agregar-carrito")) {
            e.preventDefault();
            const elemento = e.target.closest(".box");
            leerDatosElemento(elemento);
        }
        if (e.target.classList.contains("borrar")) {
            e.preventDefault();
            eliminarElemento(e);
        }
    });

    vaciarCarritoButton.addEventListener("click", vaciarCarrito);
}

function comprarElemento(e) {
    e.preventDefault();
    if (e.target.classList.contains("agregar-carrito")) {
        const elemento = e.target.parentElement.parentElement;
        leerDatosElemento(elemento);
    }
}

function leerDatosElemento(elemento) {
    const infoElemento = {
        imagen: elemento.querySelector("img").src,
        titulo: elemento.querySelector("h3").textContent,
        precio: elemento.querySelector(".precio").textContent,
        id: elemento.querySelector("a").getAttribute("data-id"),
    };
    // Agregar el producto al carrito
    insertarCarrito(infoElemento);
}

function insertarCarrito(elemento) {
    // Verificar si el producto ya está en el carrito
    const productoExistente = Array.from(lista.children).find(
        (row) => row.dataset.id === elemento.id
    );

    if (productoExistente) {
        // Incrementar la cantidad si el producto ya está en la lista
        const cantidadElemento = productoExistente.querySelector(".cantidad");
        if (cantidadElemento.textContent === "10") {
            alert("No puedes agregar más de 10 elementos");
            return;
        }
        cantidadElemento.textContent =
            parseInt(cantidadElemento.textContent) + 1;
        const precioElemento = productoExistente.querySelector(".subtotal");
        precioElemento.textContent = (
            parseFloat(precioElemento.textContent) + parseFloat(elemento.precio)
        ).toFixed(2);
        //add to data
        let index = data.findIndex((x) => x.id == elemento.id);
        data[index].cantidad = parseInt(cantidadElemento.textContent);
    } else {
        // Agregar el producto como nuevo registro en el carrito
        const row = document.createElement("tr");
        row.dataset.id = elemento.id;
        row.innerHTML = `
            <td>
                <img src="${elemento.imagen}" width="100" height="150">
            </td>
            <td>
                ${elemento.titulo}
            </td>
            <td class="cantidad">
                 1
            </td>
            <td class="subtotal">
                ${elemento.precio}
            </td>

            <td>
                <a href="#" class="borrar" data-id="${elemento.id}">x</a>
            </td>
        `;
        lista.appendChild(row);
        //add to data
        elemento.cantidad = 1;
        data.push(elemento);
        //si el boton de comprar esta deshabilitado, habilitarlo
        let botonComprar = document.getElementById("checkout");
        if (botonComprar.disabled) {
            botonComprar.disabled = false;
        }
    }
    // Actualizar el total : 'Total: $'
    const total = document.querySelector("#total");
    total.textContent =
        "Total: $" +
        (
            parseFloat(total.textContent.substring(8)) +
            parseFloat(elemento.precio)
        ).toFixed(2);
    alert("Producto agregado al carrito");
    console.log(data);
    setHiddenInput();
}

function eliminarElemento(e) {
    e.preventDefault();
    let elementoId;
    if (e.target.classList.contains("borrar")) {
        const elemento = e.target.parentElement.parentElement;
        elementoId = elemento.querySelector("a").getAttribute("data-id");
        elemento.remove();
        const total = document.querySelector("#total");
        total.textContent =
            "Total: $" +
            (
                parseFloat(total.textContent.substring(8)) -
                parseFloat(elemento.querySelector(".subtotal").textContent)
            ).toFixed(2);
    }
    //si el carrito esta vacio, deshabilitar el boton de comprar
    let botonComprar = document.getElementById("checkout");
    if (lista.childElementCount == 0) {
        botonComprar.disabled = true;
    }
    //remove from data
    let index = data.findIndex((x) => x.id == elementoId);
    data.splice(index, 1);
}

function vaciarCarrito() {
    while (lista.firstChild) {
        lista.removeChild(lista.lastChild);
    }
    const total = document.querySelector("#total");
    total.textContent = "Total: $0.00";
    data = [];
    let botonComprar = document.getElementById("checkout");
    botonComprar.disabled = true;
    return false;
}

function setHiddenInput() {
    let input = document.getElementById("productos");
    input.value = JSON.stringify(data);
}
