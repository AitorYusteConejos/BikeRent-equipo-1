@props(['bike'])

<article class='bike-card'>
    <div class='bike-card__image'>
        <img src="{{ asset('images/bicicleta.png') }}" alt="Bicicleta" class="bike-card__img">
    </div>

    <div class="bike-card__content">
        <div>
            <span class="bike-card__label">Modelo:</span>
            <h2 class="bike-card__model">{{ $bike->model }}</h2>
        </div>

        <div>
            <span class="bike-card__label">Estado:</span>

            @if (auth()->check() && ($bike->has_pending_booking ?? false))
                <span class="bike-card__status bike-card__status--pending">Pendiente</span>
            @elseif ($bike->status === 'available')
                <span class="bike-card__status bike-card__status--available">Disponible</span>
            @elseif ($bike->status === 'maintenance')
                <span class="bike-card__status bike-card__status--maintenance">Mantenimiento</span>
            @else
                <span class="bike-card__status bike-card__status--retired">No disponible</span>
            @endif
        </div>

        <div>
            <span class="bike-card__label">Precio:</span>
            <span class="bike-card__price">
                {{number_format($bike->price_per_hour, 2)}} €/hora
            </span>
        </div>

        <a class="bike-card__button" href="{{ route('bikes.show', $bike) }}">
            Ver bicicleta
        </a>
    </div>
</article>