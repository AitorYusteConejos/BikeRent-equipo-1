@extends('layouts.app')

@section('content')


<div class="detail-body">
    @php
    $status = $bike->status;


    $statusLabel = match ($status) {
        'available' => 'Disponible',
        'retired' => 'Retirada',
        'maintenance' => 'En mantenimiento',
        'pending' => 'Pendiente',
        default => 'Estado desconocido',
    };
@endphp
      <main class="bike-detail">
        <nav aria-label="Navegación del catálogo">
            <a class="bike-detail__back" href="{{ route('bikes.index') }}">
                ← Volver al listado
            </a>
        </nav>


        <h1 class="bike-detail__title">{{ $bike->model }}</h1>


        <table class="bike-detail__table">
            <caption>Detalles de la bicicleta</caption>
            <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{ $bike->id }}</td>
                </tr>
                <tr>
                    <th scope="row">Número de serie</th>
                    <td>{{ $bike->serial_number }}</td>
                </tr>
                <tr>
                    <th scope="row">Precio por hora</th>
                    <td>${{ number_format($bike->price_per_hour, 2) }}</td>
                </tr>
                <tr>
                    <th scope="row">Estado</th>
                    <td>
                        <span class="bike-card__status bike-card__status--{{ $status }}">
                            {{ $statusLabel }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Registrada el</th>
                    <td>{{ $bike->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th scope="row">Última actualización</th>
                    <td>{{ $bike->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </tbody>
        </table>


        <div class="bike-detail__actions">
            @if ($status === 'available')
                <a class="bike-detail__booking bike-card__button"
                   href="{{ route('booking.create', ['bike' => $bike->id]) }}">
                    Registrar préstamo
                </a>
            @else
                <button class="bike-detail__booking bike-card__button bike-card__button--disabled"
                        type="button" disabled>
                    Registrar préstamo
                </button>
            @endif
        </div>
    </main>

</div>
@endsection