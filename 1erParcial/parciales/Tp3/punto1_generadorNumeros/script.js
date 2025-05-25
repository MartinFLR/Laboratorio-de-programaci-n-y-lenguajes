let arregloRandomNum = [];
let arregloContainer;
let botonGenerar, botonesContainer, resultadoContainer;
let botonNum, botonPrimeroYUltimo,
    botonMenorYMayor, botonEsta5, botonOrdenamientoMayorYMenor,
    botonPromedio;
let numResultado = 0;
let resultadoParrafo;

function generar(){
    botonGenerar = document.getElementById("botonGenerar");
    botonesContainer = document.getElementById("botonesContainer")
    resultadoContainer = document.getElementById("resultadoContainer");
    arregloContainer = document.getElementById("arregloContainer");

    for(let i = 0; i < 5; i++){
        let randomNum = Math.floor(Math.random() * 10);
        arregloRandomNum.push(randomNum);
    }
    arregloContainer.innerHTML = arregloRandomNum;

    botonNum = document.createElement("input");
    botonNum.setAttribute("type", "button")
    botonNum.setAttribute("id","botonSumaDeTodosLosElementos");
    botonNum.setAttribute("value", "Suma de todos los elementos");
    botonNum.addEventListener("click", sumaDeTodosLosElementos)
    botonesContainer.appendChild(botonNum);

    botonPrimeroYUltimo = document.createElement("input");
    botonPrimeroYUltimo.setAttribute("type", "button")
    botonPrimeroYUltimo.setAttribute("id","botonPrimeroYUltimo");
    botonPrimeroYUltimo.setAttribute("value", "Primero y ultimo");
    botonPrimeroYUltimo.addEventListener("click", primeroYUltimo)
    botonesContainer.appendChild(botonPrimeroYUltimo);

    botonMenorYMayor = document.createElement("input");
    botonMenorYMayor.setAttribute("type", "button")
    botonMenorYMayor.setAttribute("id","Menor y mayor");
    botonMenorYMayor.setAttribute("value", "Menor y mayor");
    botonMenorYMayor.addEventListener("click", menorYMayor)
    botonesContainer.appendChild(botonMenorYMayor);

    botonEsta5 = document.createElement("input");
    botonEsta5.setAttribute("type", "button")
    botonEsta5.setAttribute("id","botonSumaDeTodosLosElementos");
    botonEsta5.setAttribute("value", "Existe el 5?");
    botonEsta5.addEventListener("click", esta5)
    botonesContainer.appendChild(botonEsta5);

    botonOrdenamientoMayorYMenor = document.createElement("input");
    botonOrdenamientoMayorYMenor.setAttribute("type", "button")
    botonOrdenamientoMayorYMenor.setAttribute("id","botonOrdenamientoMayorYMenor");
    botonOrdenamientoMayorYMenor.setAttribute("value", "Ordenamiento mayor a menor")
    botonOrdenamientoMayorYMenor.addEventListener("click", ordenamientoMayorMenor)
    botonesContainer.appendChild(botonOrdenamientoMayorYMenor);

    botonPromedio = document.createElement("input");
    botonPromedio.setAttribute("type", "button")
    botonPromedio.setAttribute("id","botonPromedio");
    botonPromedio.setAttribute("value", "Promedio de todos los elementos")
    botonPromedio.addEventListener("click", promedio)
    botonesContainer.appendChild(botonPromedio);

    botonGenerar.remove();
}

function sumaDeTodosLosElementos(){
    console.log(arregloRandomNum);
    if(numResultado !== 0){
        numResultado=0;
    }

    arregloRandomNum.forEach(num => {
        numResultado += num;
    })

    eliminarAnterior(resultadoParrafo)

    resultadoParrafo = document.createElement("p");
    resultadoParrafo.setAttribute("id","resultado");
    resultadoParrafo.innerHTML = numResultado;
    resultadoContainer.appendChild(resultadoParrafo)

}

function primeroYUltimo(){
    let primero,ultimo = 0;

    primero = arregloRandomNum[0];
    ultimo = arregloRandomNum[arregloRandomNum.length-1];

    console.log(primero)

    eliminarAnterior(resultadoParrafo)

    resultadoParrafo = document.createElement("p");
    resultadoParrafo.setAttribute("id","resultado");
    resultadoParrafo.innerHTML = "El primero es: "+ primero + " y El ultimo es: "+ ultimo;
    resultadoContainer.appendChild(resultadoParrafo)

}

function menorYMayor(){
    let menor,mayor;
    menor = Math.min(...arregloRandomNum);
    mayor = Math.max(...arregloRandomNum)

    eliminarAnterior(resultadoParrafo)

    resultadoParrafo = document.createElement("p");
    resultadoParrafo.setAttribute("id","resultado");
    resultadoParrafo.innerHTML = "El mayor es: "+ mayor + " y El menor es: "+ menor;
    resultadoContainer.appendChild(resultadoParrafo)
}

function esta5(){
    if(arregloRandomNum.includes(5)){
        eliminarAnterior(resultadoParrafo)

        resultadoParrafo = document.createElement("p");
        resultadoParrafo.setAttribute("id","resultado");
        resultadoParrafo.innerHTML = "Existe el 5 en el arreglo!";
        resultadoContainer.appendChild(resultadoParrafo)
    }else{
        eliminarAnterior(resultadoParrafo)

        resultadoParrafo = document.createElement("p");
        resultadoParrafo.setAttribute("id","resultado");
        resultadoParrafo.innerHTML = "No existe el 5 en el arreglo!";
        resultadoContainer.appendChild(resultadoParrafo)
    }
}

function promedio(){
    let suma = arregloRandomNum.reduce((acum,n)=> acum + n,0)
    let promedio = suma/arregloRandomNum.length;
    eliminarAnterior(resultadoParrafo)

    resultadoParrafo = document.createElement("p");
    resultadoParrafo.setAttribute("id","resultado");
    resultadoParrafo.innerHTML = "El promedio del arreglo es: "+ promedio;
    resultadoContainer.appendChild(resultadoParrafo)
}

function ordenamientoMayorMenor(){
    let arregloAOrdenar = arregloRandomNum;

    //Ordenamiento Menor a mayor
    arregloAOrdenar.sort((a,b)=> a-b);

    //Ordenamiento de Mayor a menor
    //arregloAOrdenar.sort((a,b)=> b-a);

    eliminarAnterior(resultadoParrafo)

    resultadoParrafo = document.createElement("p");
    resultadoParrafo.setAttribute("id","resultado");
    resultadoParrafo.innerHTML = arregloAOrdenar;
    resultadoContainer.appendChild(resultadoParrafo)

}

function eliminarAnterior(old){
    if(old){
        let padre = old.parentNode
        padre.removeChild(old)
    }
}