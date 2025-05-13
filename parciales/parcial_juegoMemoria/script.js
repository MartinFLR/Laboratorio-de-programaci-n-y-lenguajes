let numeros = [1,1,2,2,3,3,4,4,5,5,6,6]
let letras = ["a","a","b","b","c","c","d","d","e","e","f","f"]
let intentos = 0;
let intentosTurno = 0;
let celdasMarcadas = 0;
let celdaAnterior;
let aciertos = 0;
let realArray = []
document.addEventListener("DOMContentLoaded", function (){
    let botonIniciar = document.getElementById("botonIniciar");

    actualizarPantalla();

    botonIniciar.addEventListener("click", function (e){
        let tipoCarta = document.getElementById("selectTipoCarta").value;
        switch (tipoCarta) {
            case "numero":{
                realArray = desordenar(numeros)
                break;
            }
            case "letra":{
                realArray = desordenar(letras)
                break
            }
        }
        iniciarTablero(realArray);
    })


})

function desordenar(array){
    return array.sort(() => Math.random() - 0.5)
}

function iniciarTablero(realArray){
    let contenedorTablero = document.getElementById("contenedorTablero");
    contenedorTablero.innerHTML = ""; // Limpiar tablero anterior si existía
    celdaAnterior = null;
    intentosTurno = 0;


    let tablero = document.createElement("div");
    tablero.setAttribute("id", "tablero");
    tablero.style.display = "grid";
    tablero.style.gridTemplateColumns = "repeat(4, 100px)";  // 4 columnas
    tablero.style.gridTemplateRows = "repeat(4, 100px)"; // 4 filas
    tablero.style.gap = "10px";

    realArray.forEach(element => {
        let celda = document.createElement("div");
        celda.classList.add("celda");
        celda.textContent = "*"; // ocultamos el contenido al inicio
        celda.dataset.valor = element; // guardamos el valor real

        celda.style.backgroundColor = "#ddd";
        celda.style.display = "flex";
        celda.style.alignItems = "center";
        celda.style.justifyContent = "center";
        celda.style.border = "1px solid #999";
        celda.style.fontSize = "24px";
        celda.style.cursor = "pointer";

        // Hacemos que la celda sea clickeable
        celda.addEventListener("click", function () {
            // Mostrar carta al hacer clic
            celda.textContent = celda.dataset.valor;
            celda.style.backgroundColor = "#fff";

            if (!celdaAnterior) {
                celdaAnterior = celda;
            } else {
                intentosTurno = 0;

                if (verificarCorrecto(celda.dataset.valor)) {
                    aciertos++;
                    intentos++;
                    celdasMarcadas = celdasMarcadas + 2;
                    //celdaAnterior.removeEventListener("click",function () {})
                    //celda.removeEventListener("click",function (){})
                    actualizarPantalla();
                    celdaAnterior = null;
                } else {
                    setTimeout(() => {
                        celda.textContent = "*";
                        celdaAnterior.textContent = "*";
                        celda.style.backgroundColor = "#ddd";
                        celdaAnterior.style.backgroundColor = "#ddd";
                        intentos++;
                        actualizarPantalla();
                        celdaAnterior = null;
                    }, 1000);
                }
            }
            if(verificarFinal()){
                alert("Ganaste!");
            }
            console.log("celdas marcadas: "+celdasMarcadas)
            intentosTurno++;
        });


        tablero.appendChild(celda);
    });

    contenedorTablero.appendChild(tablero);
}


function actualizarPantalla(){
    let spanIntentos = document.getElementById("intentos");
    let spanAciertos = document.getElementById("aciertos");
    let spanCantPartidas = document.getElementById("cantPartidas");

    spanIntentos.innerHTML = intentos.toString();
    spanAciertos.innerHTML = aciertos.toString();
    //spanCantPartidas.innerHTML = cantPartidas.toString();
}

function verificarCorrecto(valorActual){
    return celdaAnterior.dataset.valor === valorActual;
}

function verificarFinal(){
    return celdasMarcadas === 12;

}
