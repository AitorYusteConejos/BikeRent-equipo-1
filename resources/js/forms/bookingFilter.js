document.addEventListener('DOMContentLoaded', function () {
    const modelInput = document.getElementById('filterModel');
    const statusSelect = document.getElementById('filterStatus');
    const clearBtn = document.getElementById('clearFilters');
    const cards = document.querySelectorAll('.booking-card');
    const noResultsMsg = document.getElementById('noResultsMessage');

    function filterBookings() {
        const modelText = modelInput.value.toLowerCase().trim();
        const statusValue = statusSelect.value.toLowerCase();
        let visibleCount = 0;

        cards.forEach(card => {
            const cardModel = card.getAttribute('data-model');
            const cardStatus = card.getAttribute('data-status');

            // Comprueba si coincide tanto el modelo como el estado
            const matchesModel = cardModel.includes(modelText);
            const matchesStatus = statusValue === '' || cardStatus === statusValue;

            if (matchesModel && matchesStatus) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Muestra el aviso si hay tarjetas en la BD pero ninguna coincide con el filtro
        if (cards.length > 0 && visibleCount === 0) {
            noResultsMsg.style.display = 'block';
        } else {
            noResultsMsg.style.display = 'none';
        }
    }

    // Escuchar eventos mientras el usuario escribe o cambia el select
    modelInput.addEventListener('input', filterBookings);
    statusSelect.addEventListener('change', filterBookings);

    // Botón para limpiar los filtros
    clearBtn.addEventListener('click', function () {
        modelInput.value = '';
        statusSelect.value = '';
        filterBookings();
    });
});