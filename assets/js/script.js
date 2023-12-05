let loadMoreBtn = document.querySelectorAll(".load-more");
let currentItem = 8;

loadMoreBtn.onclick = () => {
    console.log("hola");
    let boxes = [document.querySelectorAll(".box-container .box")];
    for (var i = currentItem; i < currentItem + 4; i++) {
        boxes[i].style.display = "inline-block";
    }
    currentItem += 4;
    if (currentItem >= boxes.length) {
        loadMoreBtn.style.display = "none";
    }
};
const carrito = document.getElementById("carrito");
const lista = document.querySelector("#lista-carrito tbody");
const vaciarcarritoBtn = document.getElementById("vaciar-carrito");

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

    vaciarcarritoBtn.addEventListener("click", vaciarCarrito);
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
    insertarcarrito(infoElemento);
}
function insertarcarrito(elemento) {
    const row = document.createElement("tr");
    row.innerHTML = `
    <td>
    <img src="${elemento.imagen}" width=100 height=150px >
    </td>
    
    <td>
    ${elemento.titulo}
    </td>
    <td>
    ${elemento.precio}
    </td>
    <a href="#" class="borrar" data-id="${elemento.id}">x</a>
    <td>
    `;
    lista.appendChild(row);
}

function eliminarElemento(e) {
    e.preventDefault();
    elementoId;
    if (e.target.classList.contains("borrar")) {
        e.target.parentElement.parentElement.remove();
        elemento = e.target.parentElement.parentElement;
        elementoId = elemento.querySelector("a").getAttribute("data-id");
    }
}
function vaciarCarrito() {
    while (lista.firstChild) {
        lista.removeChild(lista.lastChild);
    }
    return false;
}
