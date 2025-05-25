function init() {
    const containerBotones = document.getElementById("seleccionNumeroContainer");

    for (let i = 0; i <= 10; i++) {
        const botonNum = document.createElement("input");
        botonNum.setAttribute("type", "button");
        botonNum.setAttribute("id", "boton_" + i);
        botonNum.setAttribute("value", i.toString());
        botonNum.addEventListener("click", () => seleccionNumero(i));
        containerBotones.appendChild(botonNum);
    }
}

function seleccionNumero(num) {
    const contenedor = document.getElementById("tablaContenedor");
    contenedor.innerHTML = "";

    const tabla = document.createElement("table");
    tabla.setAttribute("border", "1");
    tabla.style.borderCollapse = "collapse";


    const filaEncabezado = document.createElement("tr");
    const thVacio = document.createElement("th");
    thVacio.textContent = "*";
    filaEncabezado.appendChild(thVacio);

    for (let i = 0; i <= 10; i++) {
        const th = document.createElement("th");
        th.textContent = i;
        filaEncabezado.appendChild(th);
    }

    const filaResultados = document.createElement("tr");
    const encabezadoFila = document.createElement("td");
    encabezadoFila.textContent = `${num}`;
    filaResultados.appendChild(encabezadoFila);

    for (let i = 0; i <= 10; i++) {
        const td = document.createElement("td");
        td.textContent = num * i;
        filaResultados.appendChild(td);
    }

    tabla.appendChild(filaEncabezado);
    tabla.appendChild(filaResultados);
    contenedor.appendChild(tabla);
}

