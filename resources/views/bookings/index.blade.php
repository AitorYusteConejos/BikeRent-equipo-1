@extends('layouts.app')

@section('content')
<div class="bookings-container">
    <div class="bookings-header">
        <h1>Mis Reservas</h1>
        <a href="{{ route('home') }}" class="bookings-back-link">Volver al Inicio</a>
    </div>

    <div class="bookings-list">
        @forelse ($bookings as $booking)
            <div class="booking-card">
                <!-- Información de la reserva -->
                <div class="booking-info">
                    <p class="booking-user">Usuario: <span>{{ $booking->user->name }}</span></p>
                    <p class="booking-bike">🚲 Bicicleta: {{ $booking->bike->model }}</p>
                </div>

                <!-- Botón de acción -->
                <div>
                    <a href="{{ route('booking.show', $booking) }}" class="booking-btn">
                        Ver detalles
                    </a>
                </div>
            </div>
        @empty
            <div class="bookings-empty-state">
                <p>No hay reservas registradas.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
