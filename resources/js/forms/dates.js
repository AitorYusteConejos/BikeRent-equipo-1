export function parseLocalDateTime(value) {
    if (!value) return null;
    const date = new Date(value);
    return Number.isNaN(date.getTime()) ? null : date;
}

export function toDateTimeLocalValue(date) {
    const pad = (number) => String(number).padStart(2, '0');
    return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}`
        + `T${pad(date.getHours())}:${pad(date.getMinutes())}`;
}

export function nextMinute(date) {
    const result = new Date(date);
    result.setSeconds(0, 0);
    result.setMinutes(result.getMinutes() + 1);
    return result;
}