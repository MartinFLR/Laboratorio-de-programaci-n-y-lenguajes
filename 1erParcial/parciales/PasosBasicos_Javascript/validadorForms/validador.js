function validarEmail(valor) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(valor);
}

function validarClave(valor) {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
    return regex.test(valor);
}

function validarComentarios(valor) {
    return valor.length <= 100;
}

function validarPreferencias() {
    const checkboxes = document.querySelectorAll('input[name="preferencias"]:checked');
    return checkboxes.length > 0;
}
