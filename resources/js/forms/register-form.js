export function initRegisterForm() {
    let form = document.getElementById('register-form');
    if (!form) return;

    let nombre = document.getElementById('name');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let repetir = document.getElementById('password_confirmation');
    let error = document.getElementById('register-error');
    let enviado = false;

    function validar() {
        let mensaje = '';

        if (nombre.value == '') mensaje = 'Escribe tu nombre.';
        else if (!email.value.includes('@')) mensaje = 'Escribe un email válido.';
        else if (password.value.length < 8) mensaje = 'La contraseña debe tener al menos 8 caracteres.';
        else if (repetir.value != password.value) mensaje = 'Las contraseñas no coinciden.';

        error.textContent = mensaje;
        return mensaje == '';
    }

    form.addEventListener('submit', function (e) {
        enviado = true;
        if (!validar()) e.preventDefault();
    });

    form.addEventListener('input', function () {
        if (enviado) validar();
    });
}