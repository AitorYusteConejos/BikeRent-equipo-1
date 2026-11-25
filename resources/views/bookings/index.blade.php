@extends('layouts.app')

@section('content')
<div class="bookings-container">
    <div class="bookings-header">
        <h1>Mis Reservas</h1>
        <a href="{{ route('home') }}" class="bookings-back-link">Volver al Inicio</a>
    </div>
    <div class="bookings-filter-form">
            <div class="filter-group">
                <input 
                    type="text" 
                    id="filterModel" 
                    placeholder="Filtrar por modelo..." 
                    class="filter-input"
                >
            </div>

            <div class="filter-group">
                <select id="filterStatus" class="filter-select">
                    <option value="">Todos los estados</option>
                    <option value="completed">Confirmada</option>
                    <option value="pending">Pendiente</option>
                    <option value="active">Activa</option>
                    <option value="canceled">Cancelada</option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="button" id="clearFilters" class="filter-reset">Limpiar</button>
            </div>
        </div>
    <div class="bookings-list">
        @forelse ($bookings as $booking)
            <div class="booking-card" data-model="{{ strtolower($booking->bike->model) }}" data-status="{{ strtolower($booking->status ?? '') }}">
                <!-- Información de la reserva -->
                <div class="booking-info">
                    <p class="booking-user">Usuario: <span>{{ $booking->user->name }}</span></p>
                    <p class="booking-bike">🚲 Bicicleta: {{ $booking->bike->model }}</p>
                    <p class ="booking-status">Estado: {{$booking->status}}</p>
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
