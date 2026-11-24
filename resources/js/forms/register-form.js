import { setupFormValidation } from './form-validation.js';
import { email, maxLength, minLength, required, sameAs } from './validators.js';

export function initRegisterForm() {
    const form = document.getElementById('register-form');
    if (!form) return;

    setupFormValidation(
        form,
        {
            name: [required('Escribe tu nombre.'), maxLength(255)],
            email: [required('Escribe tu email.'), email(), maxLength(255)],
            password: [
                required('Escribe una contraseña.'),
                minLength(8, 'La contraseña debe tener al menos 8 caracteres.'),
            ],
            password_confirmation: [
                required('Repite la contraseña.'),
                sameAs('password', 'Las contraseñas no coinciden.'),
            ],
        },
        { password: ['password_confirmation'] },
    );
}