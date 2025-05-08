const precioPeluqueriaPorMascota25kg = 300;
const precioPeluqueriaPorKgAdicional = 28;

const precioBanioPorMascota35kg = 250;
const precioBanioPorKgAdicional = 15;

const precioLimpliezaAcuarioPorMetroCuadrado = 125;

const precioVacunacionPorMascota = 150;
const precioVacunacionAdicionalVacuna = 55;

const precioConsultaMedicaPorMascota = 180;

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("cotizadorForm");
    const selectOpciones = document.getElementById("selectOpciones");
    const datosAcuario = document.getElementById("opcionesAcuario");
    const datosAnimal = document.getElementById("opcionesAnimal");
    const resultadoContainer = document.getElementById("resultadoContainer");
    const resultadoTexto = document.getElementById("resultadoTexto");


    function actualizarVisibilidad() {
        const opcionSeleccionada = selectOpciones.value;

        if (opcionSeleccionada === "limpiezaAcuario") {
            datosAcuario.style.display = "block";
            datosAnimal.style.display = "none";
        } else {
            datosAcuario.style.display = "none";
            datosAnimal.style.display = "block";
        }

    }
    // Llamar una vez al iniciar (por si hay un valor ya seleccionado)
    actualizarVisibilidad();

    // Escucho los cambios en el select
    selectOpciones.addEventListener("change", actualizarVisibilidad);

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const opcion = selectOpciones.value;
        const consideraciones = document.getElementById("consideraciones").value;

        const datos = {
            servicio:opcion,
            consideraciones: consideraciones,
        };

        if (opcion === "limpiezaAcuario") {
            datos.anchoPecera = document.getElementById("anchoPecera").value;
            datos.altoPecera = document.getElementById("altoPecera").value;
            datos.cantidadPeces = document.getElementById("cantidadPeces").value;
        } else {
            datos.cantidad = document.getElementById("cantidad").value;
            datos.raza = document.getElementById("raza").value;
            datos.peso = document.getElementById("peso").value;
        }

        console.log("Datos a enviar:", datos);

    });
});
