import { initBookingForm } from './booking-form.js';
import { initLoginForm } from './login-form.js';
import { initRegisterForm } from './register-form.js';

export function initForms() {
    initLoginForm();
    initRegisterForm();
    initBookingForm();
}