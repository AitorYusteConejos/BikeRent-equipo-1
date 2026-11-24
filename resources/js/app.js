import Alpine from 'alpinejs';
import { initForms } from './forms/index.js';

window.Alpine = Alpine;

Alpine.start();

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initForms);
} else {
    initForms();
}