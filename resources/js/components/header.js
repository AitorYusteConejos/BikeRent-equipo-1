document.addEventListener('DOMContentLoaded', () => {
    const userMenu = document.getElementById('user-menu');
    const trigger = document.getElementById('user-trigger');
    const dropdown = document.getElementById('user-dropdown');

    if (!userMenu || !trigger || !dropdown) return;

    const toggleMenu = (open) => {
        const isOpen = open ?? dropdown.hidden;
        dropdown.hidden = !isOpen;
        trigger.setAttribute('aria-expanded', String(isOpen));
    };

    // Abrir / cerrar al pulsar el botón
    trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleMenu();
    });

    // Cerrar al hacer clic fuera del menú
    document.addEventListener('click', (e) => {
        if (!userMenu.contains(e.target) && !dropdown.hidden) {
            toggleMenu(false);
        }
    });

    // Cerrar con la tecla Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !dropdown.hidden) {
            toggleMenu(false);
            trigger.focus();
        }
    });
});