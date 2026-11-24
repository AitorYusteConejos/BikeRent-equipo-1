const MS_PER_HOUR = 60 * 60 * 1000;

export function estimateBookingCost(start, end, pricePerHour) {
    if (!start || !end || !Number.isFinite(pricePerHour)) return null;
    if (end <= start) return null;

    const hours = (end - start) / MS_PER_HOUR;
    const total = Math.round(hours * pricePerHour * 100) / 100;
    return { hours, total };
}

const currencyFormatter = new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' });

export function formatCurrency(amount) {
    return currencyFormatter.format(amount);
}

export function formatDuration(hours) {
    const totalMinutes = Math.round(hours * 60);
    const wholeHours = Math.floor(totalMinutes / 60);
    const minutes = totalMinutes % 60;

    const parts = [];
    if (wholeHours > 0) parts.push(`${wholeHours} h`);
    if (minutes > 0) parts.push(`${minutes} min`);
    return parts.join(' ') || '0 min';
}