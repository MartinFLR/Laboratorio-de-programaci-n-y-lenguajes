document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registroForm");
    const email = form.email;
    const clave = form.clave;
    const comentarios = form.comentarios;

    const errorEmail = document.getElementById("errorEmail");
    const errorClave = document.getElementById("errorClave");
    const errorComentarios = document.getElementById("errorComentarios");
    const errorPreferencias = document.getElementById("errorPreferencias");

    const contadorComentarios = document.getElementById("contadorComentarios");

    // Muestra caracteres restantes
    comentarios.addEventListener("input", () => {
        const restante = 100 - comentarios.value.length;
        contadorComentarios.textContent = `Quedan ${restante} caracteres`;
    });

    // Validaciones al blur
    email.addEventListener("blur", () => {
        errorEmail.textContent = validarEmail(email.value) ? "" : "El email no es válido.";
    });

    clave.addEventListener("blur", () => {
        errorClave.textContent = validarClave(clave.value)
            ? ""
            : "Debe tener al menos 6 caracteres, una mayúscula, una minúscula y un número.";
    });

    comentarios.addEventListener("blur", () => {
        if (!comentarios.value.trim()) {
            errorComentarios.textContent = "El comentario es obligatorio.";
        } else if (!validarComentarios(comentarios.value)) {
            errorComentarios.textContent = "El comentario excede los 100 caracteres.";
        } else {
            errorComentarios.textContent = "";
        }
    });

    // Validación al enviar
    form.addEventListener("submit", (e) => {
        let valido = true;

        if (!validarEmail(email.value)) {
            errorEmail.textContent = "El email no es válido.";
            valido = false;
        } else {
            errorEmail.textContent = "";
        }

        if (!clave.value || !validarClave(clave.value)) {
            errorClave.textContent = "La clave no cumple los requisitos.";
            valido = false;
        } else {
            errorClave.textContent = "";
        }

        if (!comentarios.value.trim()) {
            errorComentarios.textContent = "El comentario es obligatorio.";
            valido = false;
        } else if (!validarComentarios(comentarios.value)) {
            errorComentarios.textContent = "El comentario es demasiado largo.";
            valido = false;
        } else {
            errorComentarios.textContent = "";
        }

        if (!validarPreferencias()) {
            errorPreferencias.textContent = "Debe seleccionar al menos una preferencia.";
            valido = false;
        } else {
            errorPreferencias.textContent = "";
        }

        if (!valido) e.preventDefault();
    });
});
