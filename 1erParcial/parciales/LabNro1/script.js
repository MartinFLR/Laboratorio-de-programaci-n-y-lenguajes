let nombre = getDato("nombre");
let contrasenia = getDato("contrasenia")
let visitas = getDato("visitas")
let ultimoIngreso = getDato("ultimoIngreso")
let todosUsuarios = getDato("todosUsuarios")
let idTarea = 0;
let tareas = [];

document.addEventListener("DOMContentLoaded",function(){
    let botonIngresarPagina = $id("botonIngresarPagina");

    botonIngresarPagina.addEventListener("click", function(e){
        e.preventDefault;
        visitas++
        ultimoIngreso = new Date().toLocaleString();

        let inputNombreValue = $id("nombre").value;
        let inputContraValue = $id("contrasenia").value
        let spanSaludoNombre = $id("spanSaludoNombre");
        let spanVisitas = $id("spanVisitas");
        let spanUltimoIngreso = $id("spanUltimoIngreso");
        

        setDato("nombre",inputNombreValue);
        setDato("contrasenia",inputContraValue)
        setDato("visitas",visitas)
        setDato("ultimoIngreso",ultimoIngreso)

        spanSaludoNombre.textContent = inputNombreValue;
        spanUltimoIngreso.textContent = ultimoIngreso
        spanVisitas.textContent = visitas;

        let formDatosPersonales = $id("formDatosPersonales");
        let gestorTareas = $id("gestorTareas");
        let saludo = $id("saludo")
        mostrarElemento(saludo);
        mostrarElemento(gestorTareas)
        
        ocultarElemento(botonIngresarPagina)
        ocultarElemento(formDatosPersonales)
    })

    if(!nombre && !contrasenia){
        pantallaLogin();
    }else{
        yaExiste()
    }

})


function yaExiste(){
    visitas++
    let formDatosPersonales = $id("formDatosPersonales");
    let gestorTareas = $id("gestorTareas");
    let saludo = $id("saludo")
    let botonIngresarPagina = $id("botonIngresarPagina")
    
    let spanSaludoNombre = $id("spanSaludoNombre");
    let spanVisitas = $id("spanVisitas");
    let spanUltimoIngreso = $id("spanUltimoIngreso");
    setDato("visitas",visitas)

    spanSaludoNombre.textContent = nombre;
    spanUltimoIngreso.textContent = ultimoIngreso
    spanVisitas.textContent = visitas;


    mostrarElemento(saludo)
    mostrarElemento(gestorTareas)
    ocultarElemento(botonIngresarPagina)
    ocultarElemento(formDatosPersonales)

    iniciaGestor()
}

function cargarTareasPendientes(){
    let todosUsuarios = getDato("usuarios");
    
    todosUsuarios.forEach(usuario =>{
        if(usuario.nombre === nombre){
            
        }
    })
}


function subirTareaPendiente(tareaPendiente){
    let nombre = getDato("nombre");
    let todosUsuarios = getDato("usuarios");
    let nuevaTareaPendiente = [
        {
            nombre: nombre,
            pendientes: [],
            terminadas: []
        },
    ]



    todosUsuarios.forEach(usuario =>{
        if(usuario.nombre === nombre){
            usuario.pendientes.push(tareaPendiente)
        }
    })


}

function subirTareaTerminada(){

}

function pantallaLogin(){
    let formDatosPersonales = $id("formDatosPersonales");
    let gestorTareas = $id("gestorTareas");
    let saludo = $id("saludo")
    let botonIngresarPagina = $id("botonIngresarPagina")

    mostrarElemento(botonIngresarPagina)
    mostrarElemento(formDatosPersonales)
    
    ocultarElemento(saludo)
    ocultarElemento(gestorTareas)

    iniciaGestor()
}


function iniciaGestor(){
    let botonIngresarTarea = $id("botonIngresarTarea");
    let botonFinalizarTarea = $id("finalizarTarea");
    let botonEliminarTodas = $id("botonEliminarTodas");

    botonEliminarTodas.addEventListener("click", function(){
        eliminarTodasLasTareas()
    })

    botonFinalizarTarea.addEventListener("click",function(){
        finalizarTareas()
    })

    botonIngresarTarea.addEventListener("click",function(){
        let inputTareaValue = $id("tarea").value;
        let inputDescripcionValue = $id("descripcion").value;
        let formDatosPersonales = $id("formDatosPersonales")

        crearTarea(inputTareaValue,inputDescripcionValue)
        
        let inputTarea = $id("tarea")
        let inputDescripcion = $id("descripcion");

        inputTarea.value = "";
        inputDescripcion.value = "";
    })

}

function eliminarTodasLasTareas(){
    let tareas = $all(".tarea")
    tareas.forEach(tarea =>{
        tarea.remove();
    })
}   

function finalizarTareas(){
    let checkboxSeleccionadas = Array.from(document.querySelectorAll('input[name="checkboxes"]:checked'));

    checkboxSeleccionadas.forEach(checkboxSeleccionada =>{
        let idTareaSeleccionada = checkboxSeleccionada.id;
        console.log(idTareaSeleccionada)
        let tareaABorrar = $id("tarea"+idTareaSeleccionada);
        pasarTareaATerminadas(idTareaSeleccionada);
        tareaABorrar.remove()
    })
}   

function crearTarea(tarea,descripcion){
    if(tarea === "" || descripcion ===""){
        alert("No puede haber ningún campo vacio!")
        return
    }

    idTarea++;
    let tareasPendientes = $id("tareasPendientes");
    
    let nuevaTarea = document.createElement("div");
    nuevaTarea.classList.add("tarea");
    nuevaTarea.setAttribute("id","tarea"+idTarea)

    let checkbox = document.createElement("input")
    checkbox.setAttribute("type", "checkbox");
    checkbox.setAttribute("name","checkboxes");
    checkbox.setAttribute("id",idTarea)
    let parrafoTarea = document.createElement("p");
    parrafoTarea.setAttribute("id","parrafoTarea"+idTarea)
    let parrafoDescripcion = document.createElement("p");
    parrafoDescripcion.setAttribute("id","parrafoDescripcion"+idTarea)

    parrafoTarea.textContent = tarea;
    parrafoDescripcion.textContent = descripcion;

    
    nuevaTarea.appendChild(checkbox)
    nuevaTarea.appendChild(parrafoTarea)
    nuevaTarea.appendChild(parrafoDescripcion)

    tareasPendientes.appendChild(nuevaTarea)
}

function pasarTareaATerminadas(tareaId){
    let tareasTerminadas = $id("tareasTerminadas");
    let parrafoDescripcion = $id("parrafoDescripcion"+tareaId).textContent
    let parrafoTareas = $id("parrafoTarea"+tareaId).textContent

    let nuevaTareaTerminada = document.createElement("div");
    nuevaTareaTerminada.classList.add("tarea");
    let parrafoTareaTerminada = document.createElement("p");
    let parrafoDescripcionTerminada = document.createElement("p");

    parrafoTareaTerminada.textContent = parrafoTareas;
    parrafoDescripcionTerminada.textContent = parrafoDescripcion;


    nuevaTareaTerminada.appendChild(parrafoTareaTerminada);
    nuevaTareaTerminada.appendChild(parrafoDescripcionTerminada)
    
    tareasTerminadas.appendChild(nuevaTareaTerminada);
}

//Utils
function ocultarElemento(elem) {
    elem.classList.add('oculto');
}

function mostrarElemento(elem) {
    elem.classList.remove('oculto');
}


function setDato(nombre, valor) {
    localStorage.setItem(nombre, JSON.stringify(valor));
}

function getDato(nombre) {
    const item = localStorage.getItem(nombre);
    return item ? JSON.parse(item) : null;
}

function $id(id) {
    return document.getElementById(id);
}

function $all(selector) {
    return document.querySelectorAll(selector);
}


