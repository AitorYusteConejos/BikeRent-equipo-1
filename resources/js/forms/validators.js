import { parseLocalDateTime } from './dates.js';

const EMAIL_PATTERN = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

export const required = (message = 'Este campo es obligatorio.') =>
    (value) => (value.trim() === '' ? message : '');

export const email = (message = 'Escribe un email válido, por ejemplo nombre@dominio.com.') =>
    (value) => (value.trim() !== '' && !EMAIL_PATTERN.test(value.trim()) ? message : '');

export const minLength = (min, message = `Debe tener al menos ${min} caracteres.`) =>
    (value) => (value !== '' && value.length < min ? message : '');

export const maxLength = (max, message = `No puede tener más de ${max} caracteres.`) =>
    (value) => (value.length > max ? message : '');

export const sameAs = (otherFieldName, message = 'Los valores no coinciden.') =>
    (value, form) => (value !== '' && value !== form.elements[otherFieldName].value ? message : '');

export const notInPast = (message = 'La fecha no puede ser anterior a ahora.', now = () => new Date()) =>
    (value) => {
        const date = parseLocalDateTime(value);
        if (!date) return '';
        return date < now() ? message : '';
    };

export const after = (otherFieldName, message = 'La fecha tiene que ser posterior.') =>
    (value, form) => {
        const date = parseLocalDateTime(value);
        const otherDate = parseLocalDateTime(form.elements[otherFieldName].value);
        if (!date || !otherDate) return '';
        return date <= otherDate ? message : '';
    };

export function runRules(rules, value, form) {
    for (const rule of rules) {
        const message = rule(value, form);
        if (message) return message;
    }
    return '';
}