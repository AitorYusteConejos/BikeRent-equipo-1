import { setupFormValidation } from './form-validation.js';
import { email, required } from './validators.js';

export function initLoginForm() {
    const form = document.getElementById('login-form');
    if (!form) return;

    setupFormValidation(form, {
        email: [required('Escribe tu email.'), email()],
        password: [required('Escribe tu contraseña.')],
    });
}