export function initLoginForm() {
    let form = document.getElementById('login-form');
    if (!form) return;

    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let error = document.getElementById('login-error');
    let enviado = false;

    function validar() {
        let mensaje = '';

        if (!email.value.includes('@')) mensaje = 'Escribe un email válido.';
        else if (password.value == '') mensaje = 'Escribe tu contraseña.';

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