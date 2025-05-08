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
    let precioTotal = 0;

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
            const ancho = parseFloat(document.getElementById("anchoPecera").value);
            const alto = parseFloat(document.getElementById("altoPecera").value);
            const cantidadPeces = parseInt(document.getElementById("cantidadPeces").value);
            const domicilio = document.getElementById("domicilioPeces").value;

            datos.anchoPecera = ancho;
            datos.altoPecera = alto;
            datos.cantidadPeces = cantidadPeces;
            datos.domicilio = domicilio;

            const area = ancho * alto;
            precioTotal = area * precioLimpliezaAcuarioPorMetroCuadrado;


        }  else {
            const cantidad = parseInt(document.getElementById("cantidad").value);
            const raza = document.getElementById("raza").value;
            const peso = parseFloat(document.getElementById("peso").value);

            datos.cantidad = cantidad;
            datos.raza = raza;
            datos.peso = peso;

            if (opcion === "peluqueria") {
                if (peso <= 25) {
                    precioTotal = precioPeluqueriaPorMascota25kg;
                } else {
                    const extraKg = peso - 25;
                    precioTotal = precioPeluqueriaPorMascota25kg + (extraKg * precioPeluqueriaPorKgAdicional);
                }

            } else if (opcion === "banio") {
                if (peso <= 35) {
                    precioTotal = precioBanioPorMascota35kg * cantidad;
                } else {
                    const extraKg = peso - 35;
                    precioTotal = precioBanioPorMascota35kg + (extraKg * precioBanioPorKgAdicional);
                }

            } else if (opcion === "consultaMedica") {
                console.log("entre consulta medica");
                precioTotal = cantidad * precioConsultaMedicaPorMascota;

            } else if (opcion === "vacunacion") {
                console.log("entre consulta vacunacion");
                    precioTotal = (precioVacunacionPorMascota + precioVacunacionAdicionalVacuna) * cantidad ;

            }
        }

        // Mostrar resultado
        resultadoTexto.textContent = `El costo estimado del servicio es: $${precioTotal.toFixed(2)}`;
        resultadoContainer.style.display = "block";

        console.log("Datos a enviar:", datos);



    });
});
