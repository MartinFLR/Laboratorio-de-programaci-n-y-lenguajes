
function init(){
}

function onSelect(){
    let opcionElegida = document.getElementById("opciones").value
    let alto = document.getElementById("inputAlto")
    let ancho = document.getElementById("inputAncho")
    let peces = document.getElementById("inputPeces")
    let cantidad = document.getElementById("inputCantidad")
    let raza = document.getElementById("inputRaza")
    let peso = document.getElementById("inputPeso")

    console.log(opcionElegida)
    if (opcionElegida === "limpiezaAcuario"){
        let opcionesContainer = document.getElementById("opcionesContainer")
        let opcionesPadre = document.getElementById("opcionesPadre")
        if(document.getElementById("opcionesContainer")){
            limpiezaNodoPadre(document.getElementById("opcionesContainer"))
        }
        opcionesContainer = document.createElement("div")
        opcionesContainer.setAttribute("id", "opcionesContainer")

        let anchoPeceraContainer = document.getElementById("anchoPecera")
        let altoPeceraContainer = document.getElementById("altoPecera")
        let cantidadPecesContainer = document.getElementById("cantidadPeces")
        //limpiezaNodoPadre(opcionesContainer)
        limpiezaNodoPadre(alto)
            alto = document.createElement("input")
            alto.setAttribute("id", "inputAlto")

            limpiezaNodoPadre(ancho)
            ancho = document.createElement("input")
            ancho.setAttribute("id", "inputAncho")

            limpiezaNodoPadre(peces)
            peces = document.createElement("input")
            peces.setAttribute("id", "inputPeces")


        altoPeceraContainer.append(alto)
        anchoPeceraContainer.append(ancho)
        cantidadPecesContainer.append(peces)

        opcionesContainer.append(altoPeceraContainer)
        opcionesContainer.append(anchoPeceraContainer)
        opcionesContainer.append(cantidadPecesContainer)

        opcionesPadre.append(opcionesContainer);

    }else if(document.getElementById("inputAlto")&& document.getElementById("inputAncho")){
        limpiezaNodoPadre(alto)
        limpiezaNodoPadre(ancho)
        limpiezaNodoPadre(peces)
    }else{
        cantidad = document.createElement("input")
        cantidad.setAttribute("id", "inputAlto")

    }
}

function limpiezaNodoPadre(old){
    if(old){
        let padre = old.parentNode
        padre.removeChild(old)
    }
}