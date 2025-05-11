function mostrarPopup(){
    const esMayor = confirm("¿Sos mayor de edad?");
    if (!esMayor) {
        alert("No podés acceder al contenido del sitio. Redirigiendo...");
        document.body.innerHTML = "<h2>Acceso denegado. Debés ser mayor de edad.</h2>";
        throw new Error("Menor de edad - acceso bloqueado.");
    }

    // b. Reloj digital
    function actualizarReloj() {
        const ahora = new Date();
        //padStart rellena del lado izquierdo con '0' hasta llegar a '2';
        const horas = ahora.getHours().toString().padStart(2, '0');
        const minutos = ahora.getMinutes().toString().padStart(2, '0');
        const segundos = ahora.getSeconds().toString().padStart(2, '0');
        document.getElementById("reloj").textContent = `${horas}:${minutos}:${segundos}`;
    }
    setInterval(actualizarReloj, 1000); // Actualiza cada segundo
    actualizarReloj(); // Inicializa

    // c. Función para mostrar el popup
    function mostrarPopup() {
        window.open(
            "", // URL vacía, se genera contenido dentro
            "popupMensaje",
            "width=400,height=200"
        ).document.write("<h2 style='text-align:center'>¡Hola visitante!</h2><p style='text-align:center'>Gracias por visitar nuestro sitio 😄</p>");
    }

    // d. Mostrar popup automático cada cierto tiempo (ej: cada 20 segundos)
    setInterval(() => {
        mostrarPopup();
    }, 20000);
}