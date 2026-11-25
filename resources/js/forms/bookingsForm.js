document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('booking-form');
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');
    const output = document.getElementById('cost-estimate');

    if (!form || !startInput || !endInput || !output) return;

    const pricePerHour = parseFloat(form.dataset.pricePerHour);

    const updateCost = () => {
        if (!startInput.value || !endInput.value) {
            output.textContent = 'Elige las fechas para ver el coste';
            return;
        }

        const start = new Date(startInput.value);
        const end = new Date(endInput.value);
        const diffMs = end - start;

        if (isNaN(diffMs) || diffMs <= 0) {
            output.textContent = 'La fecha de fin debe ser posterior a la de inicio';
            return;
        }

        const hours = diffMs / (1000 * 60 * 60);
        const total = hours * pricePerHour;

        output.textContent = new Intl.NumberFormat('es-ES', {
            style: 'currency',
            currency: 'EUR'
        }).format(total);
    };

    startInput.addEventListener('change', updateCost);
    endInput.addEventListener('change', updateCost);

    // Por si el formulario recarga con valores previos (old())
    updateCost();
});