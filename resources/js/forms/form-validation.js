import { runRules } from './validators.js';

export function setupFormValidation(form, rules, dependents = {}) {
    form.noValidate = true;

    const fieldNames = Object.keys(rules);
    const edited = new Set();
    const touched = new Set();

    const validateField = (name) => {
        const input = form.elements[name];
        const message = runRules(rules[name], input.value, form);
        showFieldError(input, message);
        return message === '';
    };

    for (const name of fieldNames) {
        const input = form.elements[name];

        input.addEventListener('blur', (event) => {
            const goesToSubmitButton = event.relatedTarget?.type === 'submit'
                && event.relatedTarget.form === form;

            if (!edited.has(name) || goesToSubmitButton) return;

            touched.add(name);
            validateField(name);
        });

        input.addEventListener('input', () => {
            edited.add(name);
            if (touched.has(name)) validateField(name);

            for (const dependentName of dependents[name] ?? []) {
                if (touched.has(dependentName)) validateField(dependentName);
            }
        });
    }

    form.addEventListener('submit', (event) => {
        let firstInvalidField = null;

        for (const name of fieldNames) {
            touched.add(name);
            const isValid = validateField(name);
            if (!isValid && !firstInvalidField) firstInvalidField = form.elements[name];
        }

        if (firstInvalidField) {
            event.preventDefault();
            firstInvalidField.focus();
        }
    });
}

export function showFieldError(input, message) {
    const errorElement = getErrorElement(input);
    const hasError = message !== '';

    errorElement.textContent = message;
    errorElement.hidden = !hasError;
    input.classList.toggle('is-invalid', hasError);
    input.setAttribute('aria-invalid', String(hasError));
}

function getErrorElement(input) {
    const errorId = `${input.id}-client-error`;
    let errorElement = document.getElementById(errorId);

    if (!errorElement) {
        errorElement = document.createElement('p');
        errorElement.id = errorId;
        errorElement.className = 'field-error';
        errorElement.setAttribute('aria-live', 'polite');
        errorElement.hidden = true;
        input.insertAdjacentElement('afterend', errorElement);

        const describedBy = input.getAttribute('aria-describedby');
        input.setAttribute('aria-describedby', describedBy ? `${describedBy} ${errorId}` : errorId);
    }

    return errorElement;
}