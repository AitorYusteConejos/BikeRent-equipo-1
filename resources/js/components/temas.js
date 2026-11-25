let boton = document.getElementById('theme-toggle');

if (localStorage.getItem('oscuro') == 'true') {
    document.body.classList.add('dark');
}

if (boton != null) {
    boton.addEventListener('click', function () {
        document.body.classList.toggle('dark');
        localStorage.setItem('oscuro', document.body.classList.contains('dark'));
    });
}