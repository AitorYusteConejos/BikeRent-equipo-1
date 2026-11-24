import { estimateBookingCost, formatCurrency, formatDuration } from './booking-cost.js';
import { nextMinute, parseLocalDateTime, toDateTimeLocalValue } from './dates.js';
import { setupFormValidation } from './form-validation.js';
import { after, notInPast, required } from './validators.js';

export function initBookingForm() {
    const form = document.getElementById('booking-form');
    if (!form) return;

    const startInput = form.elements.start_date;
    const endInput = form.elements.end_date;
    const costOutput = document.getElementById('cost-estimate');
    const pricePerHour = Number.parseFloat(form.dataset.pricePerHour);

    setupFormValidation(
        form,
        {
            start_date: [
                required('Elige la fecha de inicio.'),
                notInPast('La fecha de inicio no puede ser anterior a ahora.'),
            ],
            end_date: [
                required('Elige la fecha de fin.'),
                after('start_date', 'La fecha de fin tiene que ser posterior a la de inicio.'),
            ],
        },
        { start_date: ['end_date'] },
    );

    startInput.min = toDateTimeLocalValue(nextMinute(new Date()));

    const updateEndMin = () => {
        endInput.min = startInput.value || startInput.min;
    };

    const updateCostEstimate = () => {
        const estimate = estimateBookingCost(
            parseLocalDateTime(startInput.value),
            parseLocalDateTime(endInput.value),
            pricePerHour,
        );

        costOutput.textContent = estimate
            ? `${formatCurrency(estimate.total)} (${formatDuration(estimate.hours)})`
            : 'Elige unas fechas válidas para ver el coste';
    };

    for (const input of [startInput, endInput]) {
        input.addEventListener('input', () => {
            updateEndMin();
            updateCostEstimate();
        });
    }

    updateEndMin();
    updateCostEstimate();
}